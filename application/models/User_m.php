<?php defined('BASEPATH') OR exit('No direct script access allowed');

class User_m extends CI_Model
{
    // Fungsi untuk memeriksa user dan password
    public function check_user($username, $password)
    {
        // Memeriksa user dan password di database (tanpa hashing)
        $this->db->where('username', $username);
        $this->db->where('password', $password);  // Cek password tanpa hashing
        $query = $this->db->get('tb_user');

        // Jika ada hasil, kembalikan data user
        if ($query->num_rows() == 1) {
            return $query->row();
        } else {
            return FALSE;  // Jika tidak ditemukan
        }
    }

    // Fungsi untuk menambahkan user baru
    public function add_user($username, $password, $role) {
        // Hash password sebelum menyimpannya
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        $data = array(
            'username' => $username,
            'password' => $hashed_password,
            'role' => $role
        );
        
        return $this->db->insert('tb_user', $data);
    }
}
