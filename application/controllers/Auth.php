<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('User_Model');
        $this->load->library(['session', 'form_validation', 'email']);
    }

    // ---------------- Login ----------------
    public function login() {
        if ($this->input->post()) {
            $email    = $this->input->post('email');
            $password = $this->input->post('password');

            if (empty($email) || empty($password)) {
                $this->session->set_flashdata('error', 'Email and password are required.');
                redirect('auth/login');
            }

            $user = $this->User_Model->get_user_by_email($email);
            if (!$user) {
                $this->session->set_flashdata('error', 'Email not registered.');
                redirect('auth/login');
            }

            if (!password_verify($password, $user->password)) {
                $this->session->set_flashdata('error', 'Incorrect password.');
                redirect('auth/login');
            }

            // Login success
            $this->session->set_userdata('user_id', $user->id);
            redirect('home/index');
        }

        $this->load->view('login');
    }

    // ---------------- Register ----------------
    public function register() {
        if ($this->input->post()) {
            $data = [
                'name'     => $this->input->post('name'),
                'email'    => $this->input->post('email'),
                'phone'    => $this->input->post('phone'),
                'address'  => $this->input->post('address'),
                'password' => password_hash($this->input->post('password'), PASSWORD_BCRYPT)
            ];

            $this->User_Model->insert_user($data);
            redirect('auth/login');
        }
        $this->load->view('registration');
    }

    // ---------------- Forgot Password Form ----------------
    public function forgot_password() {
        $this->load->view('forgot_password');
    }

    // ---------------- Send Reset Link ----------------
    public function send_reset_link() {
        $email = $this->input->post('email');
        $user  = $this->User_Model->get_user_by_email($email);

        if (!$user) {
            $this->session->set_flashdata('error', 'Email not registered.');
            redirect('auth/forgot_password');
        }

        $token  = bin2hex(random_bytes(32));
        $expiry = date('Y-m-d H:i:s', strtotime('+10 minutes'));

        $this->User_Model->save_reset_token($email, $token, $expiry);

        $resetLink = base_url("auth/reset_password/$token");

        // ---------------- Email ----------------
        $config = [
            'protocol'  => 'smtp',
            'smtp_host' => 'ssl://smtp.gmail.com',
            'smtp_port' => 465,
            'smtp_user' => 'sanketnivate2k18@gmail.com',
            'smtp_pass' => 'rmid iuuu ezko uovb',
            'mailtype'  => 'html',
            'charset'   => 'utf-8',
            'newline'   => "\r\n",
            'crlf'      => "\r\n"
        ];

        $this->email->initialize($config);
        $this->email->from('youremail@gmail.com', 'The Tack Shop');
        $this->email->to($email);
        $this->email->subject('Reset Your Password');

        $message = "Click here to reset your password: <a href='$resetLink'>$resetLink</a>
                    <br>This link expires in 10 minutes.";

        $this->email->message($message);
        $this->email->send();

        $this->session->set_flashdata('success', 'Reset link sent. Check your email.');
        redirect('auth/forgot_password');
    }

    // ---------------- Reset Password Form ----------------
    public function reset_password($token) {
        $user = $this->User_Model->get_user_by_token($token);
        if (!$user) {
            $this->load->view('token_expired');
            return;
        }
        $this->load->view('reset_password', ['token' => $token]);
    }

    // ---------------- Update Password ----------------
    public function update_password() {
        $token    = $this->input->post('token');
        $password = $this->input->post('password');
        $confirm  = $this->input->post('confirm_password');

        if ($password !== $confirm) {
            $this->session->set_flashdata('error', 'Passwords do not match.');
            redirect('auth/reset_password/'.$token);
        }

        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $updated = $this->User_Model->update_password($token, $hashedPassword);

        if ($updated) {
            $this->session->set_flashdata('success', 'Password updated successfully. Please login.');
            redirect('auth/login');
        } else {
            $this->load->view('token_expired');
        }
    }

    // ---------------- Logout ----------------
    public function logout() {
        $this->session->unset_userdata('user_id');
        redirect('auth/login');
    }
}