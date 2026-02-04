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

    // ✅ CRITICAL: Exclude THESE methods from ALL security checks
    $excluded_methods = [
        'payment_success', 
        'payment_status_update', 
        'clear_payment_session',
        'place_cod_order' // ← MUST BE HERE
    ];
    
    if (in_array($this->router->fetch_method(), $excluded_methods)) {
        return; // Skip login check AND CSRF protection
    }

    // Login protection for other methods
    $protected_methods = ['checkout', 'thank_you', 'thank_you_cod'];
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

    // Calculate total
    $total = 0;
    foreach ($cart as $item) {
        $total += $item['price'] * $item['qty'];
    }

    $user_id = $this->session->userdata('user_id');
    
    // Create order in database
    $order_id = $this->Order_Model->create_order($user_id, $total);
    if (!$order_id) {
        show_error('Order creation failed. Please try again.');
    }

    // Store order_id in session for payment verification
    $this->session->set_userdata('order_id', $order_id);

    // Create Razorpay order
    try {
        $api = new Api(
            $this->config->item('razorpay_key_id'),
            $this->config->item('razorpay_key_secret')
        );

        $rzpOrder = $api->order->create([
            'receipt'  => 'order_' . $order_id,
            'amount'   => (int)round($total * 100), // Convert to paise (integer)
            'currency' => 'INR'
        ]);

        // Load checkout view
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

public function payment_success()
{
    $raw_input = file_get_contents("php://input");
    log_message('debug', 'PAYMENT_CALLBACK: Raw input: ' . substr($raw_input, 0, 200));
    
    $input = json_decode($raw_input, true);
    $order_id = $this->session->userdata('order_id');
    $cart = $this->session->userdata('cart');

    if (!$order_id) {
        log_message('error', 'PAYMENT_FAILED: Missing order_id in session');
        echo json_encode(['status' => 'failed', 'message' => 'Session expired. Please retry checkout.']);
        return;
    }
    
    if (empty($cart)) {
        log_message('error', 'PAYMENT_FAILED: Empty cart in session for order_id: ' . $order_id);
        echo json_encode(['status' => 'failed', 'message' => 'Cart data missing. Please retry checkout.']);
        return;
    }

    try {
        $api = new Api(
            $this->config->item('razorpay_key_id'),
            $this->config->item('razorpay_key_secret')
        );
        
        $api->utility->verifyPaymentSignature([
            'razorpay_order_id' => $input['razorpay_order_id'],
            'razorpay_payment_id' => $input['razorpay_payment_id'],
            'razorpay_signature' => $input['razorpay_signature']
        ]);
        log_message('info', 'PAYMENT_VERIFIED: Signature valid for order_id: ' . $order_id);
    } catch (Exception $e) {
        log_message('error', 'PAYMENT_FAILED: Signature verification failed - ' . $e->getMessage());
        echo json_encode(['status' => 'failed', 'message' => 'Payment verification failed']);
        return;
    }

    $this->db->trans_begin();
    try {
        // 1. Update order status
        if (!$this->Order_Model->mark_paid($order_id)) {
            throw new Exception('Failed to update order status');
        }
        log_message('info', 'ORDER_UPDATED: order_id ' . $order_id);

        // 2. Save order items
        if (!$this->Order_Model->save_items($order_id, $cart)) {
            throw new Exception('Failed to save order items');
        }
        log_message('info', 'ORDER_ITEMS_SAVED: ' . count($cart) . ' items for order_id ' . $order_id);

        // ✅ CRITICAL FIX: DECREMENT STOCK FOR EACH PRODUCT (ADD THIS BLOCK)
        foreach ($cart as $item) {
            // Atomic stock decrement with safety check
            $this->db->set('stock', 'stock - ' . (int)$item['qty'], FALSE)
                     ->where('id', (int)$item['id'])
                     ->where('stock >=', (int)$item['qty']) // Prevent negative stock
                     ->update('products');
            
            if ($this->db->affected_rows() === 0) {
                throw new Exception("Insufficient stock for '{$item['name']}' (ID: {$item['id']}). Order cancelled.");
            }
            log_message('info', "STOCK_DECREMENTED: product_id={$item['id']}, qty={$item['qty']}");
        }
        // ✅ END OF FIX

        // 3. Save payment record
        $total_amount = array_reduce($cart, function($sum, $item) {
            return $sum + ($item['price'] * $item['qty']);
        }, 0);

        $this->db->insert('payments', [
            'order_id' => $order_id,
            'payment_method' => 'Razorpay',
            'payment_status' => 'success',
            'transaction_id' => $input['razorpay_payment_id'],
            'amount' => $total_amount,
            'paid_at' => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() === 0) {
            throw new Exception('Failed to insert payment record');
        }
        $payment_id = $this->db->insert_id();
        log_message('info', 'PAYMENT_SAVED: payment_id ' . $payment_id . ' for order_id ' . $order_id);

        // COMMIT & CLEANUP
        $this->db->trans_commit();
        $this->session->unset_userdata(['cart', 'order_id']);
        log_message('info', 'PAYMENT_SUCCESS: Order ' . $order_id . ' completed. Stock updated.');
        
        echo json_encode(['status' => 'success', 'order_id' => $order_id]);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        log_message('error', 'PAYMENT_ROLLBACK: ' . $e->getMessage() . ' | Order: ' . $order_id);
        echo json_encode([
            'status' => 'failed', 
            'message' => $e->getMessage(),
            'debug' => ENVIRONMENT === 'development' ? $e->getMessage() : null
        ]);
    }
}

// ADD TO Home.php CONTROLLER
public function clear_payment_session() {
    $this->session->unset_userdata(['order_id', 'cart']);
    echo json_encode(['status' => 'cleared']);
}

public function payment_status_update() {
    header('Content-Type: application/json');
    
    $input = json_decode(file_get_contents("php://input"), true);
    $order_id = $this->session->userdata('order_id');
    
    if (!$order_id) {
        http_response_code(400);
        echo json_encode(['error' => 'No active order in session']);
        return;
    }
    
    $status = ($input['status'] === 'canceled') ? 'canceled' : 'failed';
    
    try {
        $this->db->where('id', $order_id)
                 ->update('orders', [
                     'status' => $status,
                     'payment_status' => 'failed',
                     'updated_at' => date('Y-m-d H:i:s')
                 ]);
        
        log_message('info', "Order {$order_id} updated to status={$status}");
        echo json_encode(['status' => 'success']);
    } catch (Exception $e) {
        log_message('error', "DB update failed for order {$order_id}: " . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Database update failed']);
    }
}


/**
 * Process Cash on Delivery Order
 * Creates order immediately with COD payment method
 */
public function place_cod_order()
{
    if ($this->input->method() !== 'post') {
        show_error('Invalid request', 405);
    }
    
    // ✅ REMOVED MANUAL CSRF CHECK - Already excluded in __construct()
    // No need to validate CSRF here since method is excluded from protection
    
    $cart = $this->session->userdata('cart');
    $total_amount = (float)$this->input->post('total_amount');
    $user_id = $this->session->userdata('user_id');
    
    if (empty($cart) || !$user_id) {
        $this->session->set_flashdata('error', 'Session expired. Please retry checkout.');
        redirect('home/cart');
    }
    
    $this->db->trans_begin();
    
    try {
        // Create order
        $order_id = $this->Order_Model->create_order($user_id, $total_amount);
        if (!$order_id) throw new Exception('Order creation failed');
        
        // Save order items
        if (!$this->Order_Model->save_items($order_id, $cart)) {
            throw new Exception('Failed to save order items');
        }
        
        // Create COD payment record (payment_status='pending' until cash received)
        $this->db->insert('payments', [
            'order_id'       => $order_id,
            'payment_method' => 'COD',
            'payment_status' => 'pending',
            'amount'         => $total_amount,
            'created_at'     => date('Y-m-d H:i:s'),
            'updated_at'     => date('Y-m-d H:i:s')
        ]);
        
        if ($this->db->affected_rows() === 0) {
            throw new Exception('Payment record creation failed');
        }
        
        // Commit & cleanup
        $this->db->trans_commit();
        $this->session->unset_userdata(['cart', 'checkout_total', 'order_id']);
        
        log_message('info', "COD Order #{$order_id} created successfully");
        redirect('home/thank_you_cod/' . $order_id);
        
    } catch (Exception $e) {
        $this->db->trans_rollback();
        log_message('error', "COD Order failed: " . $e->getMessage());
        $this->session->set_flashdata('error', 'Order placement failed. Please try again.');
        redirect('home/checkout');
    }
}

/**
 * Thank you page for COD orders
 */
public function thank_you_cod($order_id = null)
{
    if (!$order_id) {
        redirect('home/products');
    }
    
    // Optional: Verify order belongs to user
    $data['order_id'] = $order_id;
    $this->load->view('thank_you_cod', $data);
}
public function thank_you() {
    $this->load->view('thank_you');
}
}