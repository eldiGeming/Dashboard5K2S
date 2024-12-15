<?php defined('BASEPATH') or exit('No direct script access allowed');

class Aspek_m extends CI_Model
{
    public function Getalldata()
    {
        return $this->db->get('tb_aspek');
    }

    public function GetDataByKelasId($id_kelas)
    {
        $this->db->where('id_kelas', $id_kelas);
        $query = $this->db->get('tb_aspek');
        return $query->result();
    }

    public function tambah_data($data, $table)
    {
        $this->db->insert($table, $data);
    }

    public function update_data($data, $table, $id_aspek)
    {
        $this->db->where('id_aspek', $id_aspek);
        $this->db->update($table, $data);
    }

    public function get_kerapihan_lab_by_id($id_aspek)
    {
        $this->db->select('kerapihan_lab, keamanan_lab, ketertiban_lab, kebersihan_lab');
        $this->db->from('tb_aspek');
        $this->db->where('id_aspek', $id_aspek);
        $query = $this->db->get();
        return $query->row_array();
    }

    public function get_user_classes($userId)
    {
        // Select the class names where the logged-in user is the coordinator
        $this->db->select('nama_kelas');
        $this->db->from('tb_kelas');
        $this->db->where('id_user', $userId); // Link user to class via the id_user field
        $query = $this->db->get();
    
        // Return an array of class names
        return array_column($query->result_array(), 'nama_kelas');
    }
    

    public function get_total_score_per_class($month, $year)
    {
        $this->db->select('k.nama_kelas, 
                       GROUP_CONCAT(a.kerapihan_lab) AS kerapihan_lab, 
                       GROUP_CONCAT(a.keamanan_lab) AS keamanan_lab, 
                       GROUP_CONCAT(a.ketertiban_lab) AS ketertiban_lab, 
                       SUM(CAST(a.kebersihan_lab AS SIGNED)) AS total_kebersihan');
        $this->db->from('tb_aspek a');
        $this->db->join('tb_kelas k', 'k.id_kelas = a.id_kelas');
        $this->db->where('MONTH(a.create_at)', $month);
        $this->db->where('YEAR(a.create_at)', $year);
        $this->db->group_by('a.id_kelas');
        $query = $this->db->get();

        $rawData = $query->result_array();

        $result = [];
        foreach ($rawData as $row) {
            $kerapihan = array_sum(array_map('intval', explode(',', $row['kerapihan_lab'])));
            $keamanan = array_sum(array_map('intval', explode(',', $row['keamanan_lab'])));
            $ketertiban = array_sum(array_map('intval', explode(',', $row['ketertiban_lab'])));
            $kebersihan = $row['total_kebersihan'];

            $totalScore = $kerapihan + $keamanan + $ketertiban + $kebersihan;

            $result[] = [
                'nama_kelas' => $row['nama_kelas'],
                'total_score' => $totalScore,
            ];
        }

        // Sort the result by total_score in descending order
        usort($result, function ($a, $b) {
            return $b['total_score'] - $a['total_score'];
        });

        return $result;
    }

    public function get_total_score_by_class($id, $month, $year)
    {
        $this->db->select('k.nama_kelas, 
                       GROUP_CONCAT(a.kerapihan_lab) AS kerapihan_lab, 
                       GROUP_CONCAT(a.keamanan_lab) AS keamanan_lab, 
                       GROUP_CONCAT(a.ketertiban_lab) AS ketertiban_lab, 
                       SUM(CAST(a.kebersihan_lab AS SIGNED)) AS total_kebersihan');
        $this->db->from('tb_aspek a');
        $this->db->join('tb_kelas k', 'k.id_kelas = a.id_kelas');
        $this->db->where('MONTH(a.create_at)', $month);
        $this->db->where('YEAR(a.create_at)', $year);
        $this->db->where('a.id_kelas', $id);
        $this->db->group_by('a.id_kelas');
        $query = $this->db->get();

        $rawData = $query->result_array();

        $result = [];
        foreach ($rawData as $row) {
            $kerapihan = array_sum(array_map('intval', explode(',', $row['kerapihan_lab'])));
            $keamanan = array_sum(array_map('intval', explode(',', $row['keamanan_lab'])));
            $ketertiban = array_sum(array_map('intval', explode(',', $row['ketertiban_lab'])));
            $kebersihan = $row['total_kebersihan'];

            $totalScore = $kerapihan + $keamanan + $ketertiban + $kebersihan;

            $result[] = [
                'nama_kelas' => $row['nama_kelas'],
                'total_score' => $totalScore,
            ];
        }

        // Sort the result by total_score in descending order
        usort($result, function ($a, $b) {
            return $b['total_score'] - $a['total_score'];
        });

        return $result;
    }

    public function parse_aspek_data($data)
    {
        $data['kerapihan_lab'] = array_map('intval', explode(',', $data['kerapihan_lab']));
        $data['keamanan_lab'] = array_map('intval', explode(',', $data['keamanan_lab']));
        $data['ketertiban_lab'] = array_map('intval', explode(',', $data['ketertiban_lab']));
        $data['kebersihan_lab'] = intval($data['kebersihan_lab']);

        $data['total_score'] = array_sum($data['kerapihan_lab']) +
            array_sum($data['keamanan_lab']) +
            array_sum($data['ketertiban_lab']) +
            $data['kebersihan_lab'];
        return $data;
    }

    public function GetDataByUserId($user_id)
    {
        $this->db->where('id_user', $user_id);  // Asumsikan ada kolom 'user_id' di tabel 'tb_kelas'
        $query = $this->db->get('tb_aspek');
        return $query->result(); // Mengembalikan hasil sebagai array
    }
}
