<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Order_Model extends CI_Model {

    // Create order (before payment)
    public function create_order($customer, $total)
    {
        $data = [
            'name'           => $customer['name'] ?? 'Guest',
            'email'          => $customer['email'] ?? '',
            'phone'          => $customer['phone'] ?? '',
            'address'        => $customer['address'] ?? '',
            'total'          => $total,
            'payment_status' => 'pending',
            'created_at'     => date('Y-m-d H:i:s')
        ];

        $this->db->trans_start();
        $this->db->insert('orders', $data);
        $order_id = $this->db->insert_id();
        $this->db->trans_complete();

        if ($this->db->trans_status() === FALSE) {
            log_message('error', 'Order insert failed: ' . $this->db->last_query());
            return false;
        }

        return $order_id;
    }

    // Mark order as paid
    public function mark_paid($order_id, $payment_id)
    {
        $this->db->where('id', $order_id);
        $this->db->update('orders', [
            'payment_id'     => $payment_id,
            'payment_status' => 'success'
        ]);
    }

    // Save order items (use correct table name: order_item)
    public function save_items($order_id, $cart)
    {
        if (empty($cart)) return false;

        $items = [];
        foreach ($cart as $item) {
            $items[] = [
                'order_id'     => $order_id,
                'product_id'   => $item['id'],
                'product_name' => $item['name'],
                'price'        => $item['price'],
                'qty'          => $item['qty']
            ];
        }

        $this->db->insert_batch('order_items', $items);
        if ($this->db->affected_rows() == 0) {
            log_message('error', 'Order items insert failed for order_id: ' . $order_id);
            return false;
        }

        return true;
    }

    public function get_all_orders()
{
    return $this->db
        ->order_by('id', 'DESC')
        ->get('orders')
        ->result_array();
}


public function get_order_items($order_id)
{
    return $this->db
        ->where('order_id', $order_id)
        ->get('order_items')
        ->result_array();
}

public function get_orders_with_items()
{
    return $this->db
        ->select('o.*, oi.product_name, oi.price, oi.qty')
        ->from('orders o')
        ->join('order_items oi', 'oi.order_id = o.id', 'left')
        ->order_by('o.id', 'DESC')
        ->get()
        ->result_array();
}


}