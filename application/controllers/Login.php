<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('User_m');  // Memuat model User_m
    }

    public function index()
    {
        $this->load->view('login_view');
    }

    public function authenticate()
    {
        // Ambil data username dan password dari form login
        $username = $this->input->post('username');
        $password = $this->input->post('password');
        
        // Panggil model untuk memeriksa login
        $user = $this->User_m->check_user($username, $password);

        if ($user) {
            // Jika login berhasil, simpan data user dalam session
            $this->session->set_userdata([
                'user_id' => $user->id_user,
                'username' => $user->username,
                'role' => $user->role
            ]);
            redirect('dashboard'); 
        } else {
            // Jika gagal login, beri pesan error
            $this->session->set_flashdata('error', 'Invalid Username or Password');
            redirect('login');
        }
    }

    
}

