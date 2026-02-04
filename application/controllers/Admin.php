<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Product_Model');
        $this->load->library('pagination');
    }

    // Show add product + product list
    public function add_product()
    {
        // Pagination config
        $config['base_url']       = site_url('admin/add_product');
        $config['total_rows']     = $this->Product_Model->count_products();
        $config['per_page']       = 5;
        $config['uri_segment']    = 3;

        $config['full_tag_open']  = '<ul class="pagination">';
        $config['full_tag_close'] = '</ul>';

        $config['first_tag_open']  = '<li class="page-item">';
        $config['first_tag_close'] = '</li>';

        $config['last_tag_open']  = '<li class="page-item">';
        $config['last_tag_close'] = '</li>';

        $config['next_tag_open']  = '<li class="page-item">';
        $config['next_tag_close'] = '</li>';

        $config['prev_tag_open']  = '<li class="page-item">';
        $config['prev_tag_close'] = '</li>';

        $config['num_tag_open']   = '<li class="page-item">';
        $config['num_tag_close']  = '</li>';

        $config['cur_tag_open']   = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']  = '</span></li>';

        $config['attributes']     = ['class' => 'page-link'];

        $this->pagination->initialize($config);

        $page = $this->uri->segment(3);
        if (!$page) $page = 0;

     $data['products'] = $this->Product_Model->get_products($config['per_page'], $page);

        $data['links']    = $this->pagination->create_links();

        $this->load->view('add_product', $data);
    }

    // Insert product
   public function insert_product()
{
    if (empty($_FILES['image']['name'])) {
        $this->session->set_flashdata('error', 'No image selected');
        redirect('admin/add_product');
    }

    $config['upload_path']   = FCPATH . 'assets/images/products/';
    $config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
    $config['max_size']      = 5120;
    $config['encrypt_name']  = TRUE;

    $this->load->library('upload', $config);

    if (!$this->upload->do_upload('image')) {
        $this->session->set_flashdata('error', $this->upload->display_errors());
        redirect('admin/add_product');
    }

    $uploadData = $this->upload->data();

    $data = [
        'name'        => $this->input->post('name'),
        'stock'       =>$this->input->post('stock'),
        'status'      =>$this->input->post('status'),
        'price'       => $this->input->post('price'),
        'image'       => $uploadData['file_name'],
        'description' => $this->input->post('description'),
    ];

    $this->Product_Model->insert_product($data);
    $this->session->set_flashdata('success', 'Product added successfully!');
    redirect('admin/add_product');
}

    // Delete product
    public function delete_product($id)
    {
        $this->Product_Model->delete_product($id);
        redirect('admin/add_product');
    }

    // Show all orders
    public function orders()
    {
        $this->load->model('Order_Model');

        $orders = $this->Order_Model->get_all_orders();

        foreach ($orders as &$order) {
            $order['items'] = $this->Order_Model->get_order_items($order['id']);
        }

        $data['orders'] = $orders;

        $this->load->view('orders_list', $data);
    }

}