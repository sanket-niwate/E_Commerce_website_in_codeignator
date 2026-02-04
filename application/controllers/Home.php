<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require APPPATH.'views/razorpay-php/razorpay-php/Razorpay.php';
use Razorpay\Api\Api;

class Home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model(['Product_Model', 'Order_Model']);
        $this->load->library('session');
        $this->config->load('razorpay');

        // 🔒 ONLY require login for checkout/payment methods (NOT cart actions)
        $protected_methods = ['checkout', 'payment_success', 'thank_you'];
        $current_method = $this->router->fetch_method();
        
        if (in_array($current_method, $protected_methods) && !$this->session->userdata('user_id')) {
            redirect('auth/login');
        }
    }

    public function index() {
        $this->load->view('home');
    }

    // ✅ Product listing (only active products)
    public function products() {
        $data['products'] = $this->Product_Model->get_active_products();
        $this->load->view('product', $data);
    }

    // ✅ Single product page
    public function shop($id) {
        $data['product'] = $this->Product_Model->get_product_by_id($id);
        if (!$data['product']) show_404();
        $this->load->view('shop', $data);
    }

    // ✅ FIXED: Add to cart (NO login required)
    public function add() {
        if ($this->input->method() !== 'post') {
            show_error('Invalid request', 405);
        }

        $id  = (int)$this->input->post('id');
        $qty = max(1, (int)$this->input->post('qty'));

        $product = $this->Product_Model->get_product_by_id($id);
        
        // Validate product
        if (!$product || $product->status !== 'active') {
            $this->session->set_flashdata('error', 'Product is unavailable');
            redirect($_SERVER['HTTP_REFERER'] ?? 'home/products');
        }

        // Validate stock
        if ($qty > $product->stock) {
            $this->session->set_flashdata('error', "Only {$product->stock} items available in stock");
            redirect($_SERVER['HTTP_REFERER'] ?? "home/shop/{$id}");
        }

        // Get or initialize cart
        $cart = $this->session->userdata('cart');
        if (!is_array($cart)) {
            $cart = [];
        }

        // Update existing item or add new
        $found = false;
        foreach ($cart as &$item) {
            if ((int)$item['id'] === $id) {
                $new_qty = $item['qty'] + $qty;
                // Prevent exceeding stock
                $item['qty'] = min($new_qty, $product->stock);
                $found = true;
                break;
            }
        }
        unset($item);

        if (!$found) {
            $cart[] = [
                'id'    => $product->id,
                'name'  => $product->name,
                'price' => (float)$product->price,
                'qty'   => $qty,
                'image' => $product->image
            ];
        }

        // Save cart to session
        $this->session->set_userdata('cart', $cart);
        $this->session->set_flashdata('success', "'{$product->name}' added to cart!");
        redirect('home/cart');
    }

    // ✅ Cart page
    public function cart() {
        $data['cart'] = $this->session->userdata('cart') ?: [];
        $this->load->view('cart', $data);
    }

    // ✅ Remove item from cart
    public function remove($id) {
        $cart = $this->session->userdata('cart') ?: [];
        $cart = array_filter($cart, function($item) use ($id) {
            return (int)$item['id'] !== (int)$id;
        });
        $this->session->set_userdata('cart', array_values($cart));
        $this->session->set_flashdata('success', 'Item removed from cart');
        redirect('home/cart');
    }

    // ✅ CRITICAL FIX: Added missing 'update' method for cart quantity changes
    public function update() {
        if ($this->input->method() !== 'post') {
            show_error('Invalid request', 405);
        }

        $id  = (int)$this->input->post('id');
        $qty = max(1, (int)$this->input->post('qty'));

        $product = $this->Product_Model->get_product_by_id($id);
        
        if (!$product || $product->status !== 'active') {
            $this->session->set_flashdata('error', 'Product unavailable');
            redirect('home/cart');
        }

        // Cap at available stock
        if ($qty > $product->stock) {
            $qty = $product->stock;
            $this->session->set_flashdata('warning', "Quantity updated to available stock ({$qty})");
        }

        $cart = $this->session->userdata('cart') ?: [];
        foreach ($cart as &$item) {
            if ((int)$item['id'] === $id) {
                $item['qty'] = $qty;
                break;
            }
        }
        unset($item);

        $this->session->set_userdata('cart', $cart);
        redirect('home/cart');
    }

    // ✅ Checkout (requires login - handled in constructor)
    public function checkout() {
        $cart = $this->session->userdata('cart');
        if (empty($cart)) {
            $this->session->set_flashdata('error', 'Your cart is empty');
            redirect('home/cart');
        }

        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['qty'];
        }

        $user_id = $this->session->userdata('user_id');
        $order_id = $this->Order_Model->create_order($user_id, $total);
        
        if (!$order_id) {
            show_error('Order creation failed. Please try again.');
        }

        $this->session->set_userdata('order_id', $order_id);

        // Create Razorpay order
        try {
            $api = new Api(
                $this->config->item('razorpay_key_id'),
                $this->config->item('razorpay_key_secret')
            );

            $rzpOrder = $api->order->create([
                'receipt'  => 'order_' . $order_id,
                'amount'   => (int)round($total * 100), // Convert to paise
                'currency' => 'INR'
            ]);

            $this->load->view('checkout', [
                'cart'      => $cart,
                'amount'    => $total,
                'key'       => $this->config->item('razorpay_key_id'),
                'rzp_order' => $rzpOrder['id']
            ]);
        } catch (Exception $e) {
            log_message('error', 'Razorpay order creation failed: ' . $e->getMessage());
            show_error('Payment gateway error. Please try again later.');
        }
    }

    // ✅ Payment verification (requires login)
    public function payment_success() {
        $input = json_decode(file_get_contents("php://input"), true);
        
        $order_id = $this->session->userdata('order_id');
        $cart     = $this->session->userdata('cart');

        if (!$order_id || empty($cart)) {
            echo json_encode(['status' => 'failed', 'message' => 'Invalid session']);
            return;
        }

        try {
            $api = new Api(
                $this->config->item('razorpay_key_id'),
                $this->config->item('razorpay_key_secret')
            );

            $api->utility->verifyPaymentSignature([
                'razorpay_order_id'   => $input['razorpay_order_id'],
                'razorpay_payment_id' => $input['razorpay_payment_id'],
                'razorpay_signature'  => $input['razorpay_signature']
            ]);

            // Update order status
            $this->Order_Model->mark_paid($order_id);
            
            // Save order items
            $this->Order_Model->save_items($order_id, $cart);
            
            // Save payment record
            $this->db->insert('payments', [
                'order_id'       => $order_id,
                'payment_method' => 'Razorpay',
                'payment_status' => 'success',
                'transaction_id' => $input['razorpay_payment_id'],
                'amount'         => $input['amount'] / 100,
                'paid_at'        => date('Y-m-d H:i:s')
            ]);

            // Clear cart and order session
            $this->session->unset_userdata(['cart', 'order_id']);
            
            echo json_encode(['status' => 'success']);
            
        } catch (Exception $e) {
            log_message('error', 'Payment verification failed: ' . $e->getMessage());
            echo json_encode(['status' => 'failed', 'message' => 'Payment verification failed']);
        }
    }

    public function thank_you() {
        $this->load->view('thank_you');
    }
}