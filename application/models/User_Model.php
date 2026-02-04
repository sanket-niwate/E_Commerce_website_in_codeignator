<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_Model extends CI_Model {

    protected $table = 'users';

    // ---------------- Get user by email ----------------
    public function get_user_by_email($email) {
        return $this->db->get_where($this->table, ['email' => $email])->row();
    }

    // ---------------- Get user by ID ----------------
    public function get_user_by_id($id) {
        return $this->db->get_where($this->table, ['id' => $id])->row();
    }

    // ---------------- Insert new user ----------------
    public function insert_user($data) {
        return $this->db->insert($this->table, $data);
    }

    // ---------------- Update user profile ----------------
    public function update_profile($id, $data) {
        $this->db->where('id', $id);
        return $this->db->update($this->table, $data);
    }

    // ---------------- Save reset token ----------------
    public function save_reset_token($email, $token, $expiry) {
        $data = [
            'reset_token'        => $token,
            'reset_token_expiry' => $expiry
        ];
        $this->db->where('email', $email);
        return $this->db->update($this->table, $data);
    }

    // ---------------- Get user by reset token ----------------
    public function get_user_by_token($token) {
        $now = date('Y-m-d H:i:s');
        $this->db->where('reset_token', $token);
        $this->db->where('reset_token_expiry >=', $now);
        return $this->db->get($this->table)->row();
    }

    // ---------------- Update password ----------------
    public function update_password($token, $hashedPassword) {
        $this->db->where('reset_token', $token);
        $this->db->where('reset_token_expiry >=', date('Y-m-d H:i:s'));
        $update = [
            'password'           => $hashedPassword,
            'reset_token'        => null,
            'reset_token_expiry' => null
        ];
        $this->db->update($this->table, $update);
        return $this->db->affected_rows() > 0;
    }
}
?>