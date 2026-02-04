<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends CI_Model {

    // ✅ CORRECTED: Uses ONLY columns that exist in your orders table
    public function create_order($user_id, $total_amount) {
        $data = [
            'user_id'        => (int)$user_id,
            'total_amount'   => (float)$total_amount, // NOT 'total' - matches your DB
            'status'         => 'pending',
            'payment_status' => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        $this->db->insert('orders', $data);
        return $this->db->insert_id();
    }

    // ✅ CORRECTED: Updates ONLY existing columns (no payment_id in orders table)
  public function mark_paid($order_id) {
    log_message('debug', 'Order_Model::mark_paid() called with order_id: ' . $order_id);
    
    $result = $this->db->where('id', $order_id)
                       ->update('orders', [
                           'status'         => 'processing',
                           'payment_status' => 'paid',
                           'updated_at'     => date('Y-m-d H:i:s')
                       ]);
    
    if (!$result) {
        log_message('error', 'Order_Model::mark_paid() FAILED. DB Error: ' . $this->db->error()['message']);
        log_message('error', 'Order_Model::mark_paid() Last Query: ' . $this->db->last_query());
    } else {
        log_message('info', 'Order_Model::mark_paid() SUCCESS for order_id: ' . $order_id);
    }
    
    return $result;
}



    // ✅ CORRECTED: Uses 'quantity' (not 'qty') and calculates line 'total'
   public function save_items($order_id, $cart) {
    log_message('debug', 'Order_Model::save_items() called with order_id: ' . $order_id . ', cart items: ' . count($cart));
    
    if (empty($cart)) {
        log_message('warning', 'Order_Model::save_items() cart is empty');
        return false;
    }

    $items = [];
    foreach ($cart as $item) {
        $items[] = [
            'order_id'   => $order_id,
            'product_id' => (int)$item['id'],
            'quantity'   => (int)$item['qty'],
            'price'      => (float)$item['price'],
            'total'      => (float)($item['price'] * $item['qty'])
        ];
    }

    log_message('debug', 'Order_Model::save_items() prepared items: ' . print_r($items, true));
    
    $result = $this->db->insert_batch('order_items', $items);
    
    if (!$result) {
        log_message('error', 'Order_Model::save_items() FAILED. DB Error: ' . $this->db->error()['message']);
        log_message('error', 'Order_Model::save_items() Last Query: ' . $this->db->last_query());
    } else {
        log_message('info', 'Order_Model::save_items() SUCCESS. Inserted ' . count($items) . ' items for order_id: ' . $order_id);
    }
    
    return $result;
}

    // Admin methods (fixed column names)
    public function get_all_orders() {
        return $this->db
            ->select('orders.*, users.name as customer_name, users.email')
            ->from('orders')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->order_by('orders.id', 'DESC')
            ->get()
            ->result_array();
    }

    public function get_order_items($order_id) {
        return $this->db
            ->where('order_id', $order_id)
            ->get('order_items')
            ->result_array();
    }
}