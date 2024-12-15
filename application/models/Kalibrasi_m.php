<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Kalibrasi_m extends CI_Model
{
    private $_table = "kalibrasi";

    public $id;
    public $id_mesin;
    public $jadwal;
    public $masa_laku;
    public $status;

    public function rules()
    {
        return [

            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'status',
            'label' => 'Status',
            'rules' => 'required'],

            ['field' => 'masa_laku',
            'label' => 'Masa Laku Kalibrasi',
            'rules' => 'required'],

            ['field' => 'jadwal',
            'label' => 'Jadwal Kalibrasi',
            'rules' => 'required']
        ];
    }

    public function getAll() {
        // Build the query using CI_DB_query_builderbefore getting data
        $query = "SELECT a.id, a.jadwal, a.masa_laku, a.status, b.id as id_mesin, b.id_eng, b.name FROM kalibrasi A join machine B on a.id_mesin = b.id where a.flag=1;";
           $hasil = $this->db->query($query);
           // return $hasil->num_rows();
    
        // Check if query was successful
        if ($hasil) {
            return $hasil->result(); // Return result set as an array of objects
        } else {
            return array(); // Return an empty array if no results or error
        }
    }
    public function getAllbyFilter($month) {
        $start = $month.'-01';
        $end = $month.'-31';
        // Build the query using CI_DB_query_builderbefore getting data
        $query = "SELECT a.id, a.jadwal, a.masa_laku, a.status, b.id_eng, b.name, b.brand, b.type,b.lokasi, b.rangeCapacity, b.remark FROM kalibrasi A join machine B on a.id_mesin = b.id where a.flag=1 and a.jadwal BETWEEN '".$start."' AND '". $end."';";
           $hasil = $this->db->query($query);
           // return $hasil->num_rows();
    
        // Check if query was successful
        if ($hasil) {
            return $hasil->result(); // Return result set as an array of objects
        } else {
            return array(); // Return an empty array if no results or error
        }
    }

    public function getTersertifikasi() {
        $query = $this->db->where('status', 'Tersertifikasi')->get('kalibrasi'); 
    
        if ($query) {
            return $query->result(); 
        } else {
            return array();
        }
    }

    public function getPending()
    {
        $today = date('Y-m-d');
    
        $this->db->where('status', 'Belum Tersertifikasi');
        $this->db->where('jadwal <', $today);
        $query = $this->db->get('kalibrasi');
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    
    public function getTidak()
    {
        $today = date('Y-m-d');
    
        $this->db->where('status', 'Belum Tersertifikasi');
        $this->db->where('jadwal >=', $today);
        $query = $this->db->get('kalibrasi');
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    

    public function getHampirHariIni()
    {
        // Ambil tanggal hari ini
        $today = date('Y-m-d');
    
        // Buat query untuk mendapatkan data yang tanggalnya mendekati hari ini
        $this->db->from('kalibrasi');
        $this->db->where('jadwal <=', $today);
        $this->db->order_by('jadwal', 'ASC');
        $this->db->limit(4);
    
        $query = $this->db->get();
    
        if ($query->num_rows() > 0) {
            return $query->result();
        } else {
            return array();
        }
    }
    

    public function getAllTotal() {
        $query = $this->db->get('kalibrasi'); 
    
        if ($query) {
            return $query->result(); 
        } else {
            return array();
        }
    }

    public function getAllMachines()
    {
        $query = $this->db->get('machine'); // Sesuaikan nama tabel dengan nama tabel mesin di database
        return $query->result();
    }
    
    public function getById($id)
    {
        return $this->db->get_where($this->_table, ["id" => $id])->row();
    }
    public function getByIdMesin($id)
    {
        return $this->db->get_where($this->_table, ["id_mesin" => $id, "flag" => '1'])->row();
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->id = uniqid();
        $this->id_mesin = $post["name"];
        $this->jadwal = $post["jadwal"];
        $this->masa_laku = $post["masa_laku"];
        $this->status = "Tersertifikasi";
     //   $this->flag = $post["flag"];
        return $this->db->insert($this->_table, $this);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kalibrasi', $data); 
    }
    public function sertifikasi($id,$data)
    {
        $this->db->where('id', $id);
        return $this->db->update('kalibrasi', $data); 
    }

    public function delete($id,$data)
    {
        $this->db->where('id', $id);
       
        return $this->db->delete('kalibrasi', $data);
    }

    
    public function save_upload($data)
    {
        $this->db->insert('kalibrasi', $data);

        // Check if the data has been successfully inserted
        return $this->db->affected_rows() > 0;
    }
    public function update_pdf($id, $file_name)
    {
        $data = array(
            'sertifikasi' => $file_name
        );

        $this->db->where('id', $id);
        return $this->db->update('kalibrasi', $data);
    }
}