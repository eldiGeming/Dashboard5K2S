<?php defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_m extends CI_Model
{
    public function Getalldata()
    {
        return $this->db->get('tb_kelas');
    }

    public function GetalldataArray()
    {
        $query = $this->db->get('tb_kelas');
        return $query->result();
    }

    public function GetDataByUserId($user_id)
    {
        // Menggunakan query untuk mengambil data berdasarkan ID pengguna
        $this->db->where('id_user', $user_id);  // Asumsikan ada kolom 'user_id' di tabel 'tb_kelas'
        $query = $this->db->get('tb_kelas');
        return $query->result(); // Mengembalikan hasil sebagai array
    }

    public function getAllKelas() {
        // Mengambil data seluruh kelas dari tabel kelas
        $this->db->select('*'); // Memilih semua kolom
        $this->db->from('tb_kelas'); // Ganti dengan nama tabel kelas Anda
        $query = $this->db->get();
        
        return $query->result(); // Mengembalikan hasil query sebagai array objek
    }


    // Fungsi untuk mengambil kelas yang belum dimasukkan oleh pengguna
    public function GetAvailableClassesForUser($user_id)
    {
        // Mengambil semua id_kelas yang sudah dimasukkan oleh pengguna
        $this->db->select('id_kelas');
        $this->db->from('tb_aspek');
        $this->db->where('id_user', $user_id); // Asumsi 'user_id' adalah kolom untuk identifikasi pengguna
        $query = $this->db->get();
        $entered_classes = $query->result_array();

        // Mengambil id_kelas yang sudah dimasukkan oleh pengguna
        $entered_class_ids = array_map(function ($row) {
            return $row['id_kelas'];
        }, $entered_classes);

        // Mengambil kelas-kelas yang belum dimasukkan oleh pengguna
        $this->db->select('id_kelas, nama_kelas');
        $this->db->from('tb_kelas');  // Asumsi 'kelas' adalah tabel yang berisi daftar kelas
        if (!empty($entered_class_ids)) {
            $this->db->where_not_in('id_kelas', $entered_class_ids); // Mengeluarkan kelas yang sudah dimasukkan
        }
        $query = $this->db->get();
        return $query->result(); // Mengembalikan kelas yang tersedia
    }
}
