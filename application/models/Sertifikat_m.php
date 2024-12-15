<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Sertifikat_m extends CI_Model
{
    private $_table = "sertifikat";

    public $id;
    public $name;
    public $file;

    public function rules()
    {
        return [

            ['field' => 'name',
            'label' => 'Name',
            'rules' => 'required'],

            ['field' => 'file',
            'label' => 'file',
            'rules' => 'required'],

            ['field' => 'flag',
            'label' => 'flag',
            'rules' => 'required']
        ];
    }

    public function getAll() {
        $query = "SELECT a.id, a.file, a.tanggal, a.name, b.id as id_mesin, b.id_eng as id_eng, b.name as mesin FROM sertifikat A join machine B on a.mesin = b.id where a.flag=1 order by a.tanggal desc";
           $hasil = $this->db->query($query);
    
        if ($hasil) {
            return $hasil->result(); 
        } else {
            return array();
        }
    }

    public function getAllMachines()
    {
        // Build the query using CI_DB_query_builder
        $query = $this->db->where('flag', 1)->get('machine'); // Apply where condition before getting data
    
        // Check if query was successful
        if ($query) {
            return $query->result(); // Return result set as an array of objects
        } else {
            return array(); // Return an empty array if no results or error
        }
    }
    
    public function getById($id)
    {
        $query = "SELECT a.id, a.name, b.id as id_mesin, b.id_eng as id_eng, b.name as mesin FROM sertifikat A join machine B on a.mesin = b.id where a.flag=1 and b.id =".$id.";";
        $hasil = $this->db->query($query);
        if ($hasil) {
            return $hasil->result(); 
        } else {
            return array();
        }
    }

    public function save()
    {
        $post = $this->input->post();
        // $this->id = uniqid();
        $this->name = $post["name"];
        $this->file = $post["file"];
        $this->machine = $post["machine"];
        $this->tanggal = $post["tanggal"];
        $this->flag = $post["flag"];
        return $this->db->insert($this->_table, $this);
    }

    public function update($id, $data)
    {
        $this->db->where('id', $id);
        $this->db->update('sertifikat', $data); 
        //Get Id Mesi, Jadwal Sebelum, Tipe Sertifikat
        $query = "SELECT A.mesin, A.tanggal, A.tanggal_sebelum FROM sertifikat A WHERE A.id = '".$id."';";
        $hasil = $this->db->query($query);
        if ($hasil) {
            return $hasil->result(); 
        } else {
            return array();
        }
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        return $this->db->delete('sertifikat', $data);
    }
}