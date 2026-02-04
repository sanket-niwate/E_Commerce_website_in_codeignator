<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_Model extends CI_Model {

    /* =========================
       FRONTEND (ONLY ACTIVE)
    ========================= */
    public function get_active_products() {
        return $this->db
            ->where('status', 'active')
            ->get('products')
            ->result();
    }

    public function get_product_by_id($id) {
        return $this->db
            ->where('id', $id)
            ->get('products')
            ->row();
    }


    /* =========================
       ADMIN SIDE
    ========================= */
    public function insert_product($data)
    {
        return $this->db->insert('products', $data);
    }

    public function get_products($limit, $start)
    {
        return $this->db
            ->limit($limit, $start)
            ->order_by('id', 'DESC')
            ->get('products') // admin can see all
            ->result();
    }

    public function count_products()
    {
        return $this->db->count_all('products');
    }

    /* =========================
       DELETE PRODUCT
    ========================= */
    public function delete_product($id)
    {
        $product = $this->db->get_where('products', ['id' => $id])->row();

        if ($product && !empty($product->image)) {
            @unlink(FCPATH . 'assets/images/products/' . $product->image);
        }

        return $this->db->delete('products', ['id' => $id]);
    }

    /* =========================
       OPTIONAL: SOFT DELETE
    ========================= */
    public function deactivate_product($id)
    {
        return $this->db
            ->where('id', $id)
            ->update('products', ['status' => 'inactive']);
    }

}