<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Kompetisi extends CI_Controller
{
    const ROLE_ADMIN = 1;
    const ROLE_PIC_KELAS = 2;

    public function __construct()
    {
        parent::__construct();
        $this->load->model("Kelas_m");
        $this->load->model("Aspek_m");
    }

    private function check_access()
    {
        // Cek apakah pengguna sudah login
        if (!$this->session->userdata('user_id')) {
            show_error('You must be logged in to access this page.', 403, 'Access Denied');
            exit;  // Menghentikan eksekusi jika tidak login
        }

        // Ambil role dari session
        $role = $this->session->userdata('role');
        $method = $this->router->fetch_method(); // Ambil nama metode yang diakses

        // Daftar metode yang diperbolehkan berdasarkan role
        $allowed_methods = [
            self::ROLE_ADMIN => [
                'index',
                'keamanan_lab',
                'kerapihan_lab',
                'ketertiban_lab',
                'kebersihan_lab',
                'kerapihan_lab_edit',
                'keamanan_lab_edit',
                'kebersihan_lab_edit',
                'ketertiban_lab_edit',
                'update_kerapihan_lab',
                'update_kebersihan_lab',
                'update_ketertiban_lab',
                'update_ketertiban_lab',
                'update_keamanan_lab'
            ],
            self::ROLE_PIC_KELAS => [
                'index',
                'keamanan_lab',
                'kerapihan_lab',
                'ketertiban_lab',
                'kebersihan_lab',
                'kerapihan_lab_edit',
                'keamanan_lab_edit',
                'kebersihan_lab_edit',
                'ketertiban_lab_edit',
                'update_kerapihan_lab',
                'update_kebersihan_lab',
                'update_ketertiban_lab',
                'update_ketertiban_lab',
                'update_keamanan_lab'
            ],
        ];

        // Periksa apakah metode yang diakses sesuai dengan role
        if (!in_array($method, $allowed_methods[$role])) {
            $this->session->set_flashdata('error', 'You do not have permission to access this page.');
            redirect('no_permission');
        }
    }
    public function index()
    {
        // Unset the session variable 'kerapihan_lab'
        $this->session->unset_userdata('kerapihan_lab');

        // Prepare user data
        $data = $this->prepare_user_data('Dashboard 5K2S');

        // Check access
        $this->check_access();

        // Load views
        $this->load->view("layout/header_dash", $data);
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/index");
        $this->load->view("layout/footer_dash");
    }


    public function kerapihan_lab()
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();

        // Ambil nilai id_kelas dari URL
        $id_kelas = $this->input->get('kelas');

        // Cek apakah id_kelas ada, jika tidak tampilkan error
        if (!$id_kelas) {
            show_error('Parameter kelas tidak ditemukan', 400);
        }

        if ($this->input->post()) {
            // Ambil nilai dari form POST
            $kerapihan_lab_1 = $this->input->post('kerapihan_lab_1', true);
            $kerapihan_lab_2 = $this->input->post('kerapihan_lab_2', true);
            $kerapihan_lab_3 = $this->input->post('kerapihan_lab_3', true);

            // Simpan nilai kerapihan_lab di session
            $kerapihan_lab_string = $kerapihan_lab_1 . ',' . $kerapihan_lab_2 . ',' . $kerapihan_lab_3;
            $this->session->set_userdata('kerapihan_lab', $kerapihan_lab_string);
            $this->session->set_userdata('id_kelas', $id_kelas);

            // Redirect ke halaman keamanan_lab
            redirect('competition/keamanan_lab?kelas=' . $id_kelas);
        } else {
            // Ambil nilai kerapihan_lab dari session jika ada
            $kerapihan_lab = $this->session->userdata('kerapihan_lab');
            if ($kerapihan_lab) {
                // Pisahkan nilai kerapihan_lab untuk dipisahkan ke 3 kategori
                list($kerapihan_lab_1, $kerapihan_lab_2, $kerapihan_lab_3) = explode(',', $kerapihan_lab);
                $data['kerapihan_lab_1'] = $kerapihan_lab_1;
                $data['kerapihan_lab_2'] = $kerapihan_lab_2;
                $data['kerapihan_lab_3'] = $kerapihan_lab_3;
            } else {
                // Jika tidak ada data kerapihan_lab di session, set default
                $data['kerapihan_lab_1'] = $data['kerapihan_lab_2'] = $data['kerapihan_lab_3'] = null;
            }

            // Tambahkan id_kelas ke data yang akan dipass ke view
            $data['id_kelas'] = $id_kelas;

            $this->load->view("layout/header_dash", $data);
            $this->load->view("layout/sidebar_admin", $data);
            $this->load->view("competition/kerapihan_lab", $data);
            $this->load->view("layout/footer_dash");
        }
    }


    public function keamanan_lab()
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();

        // Ambil id_kelas dari URL
        $id_kelas = $this->input->get('kelas');

        // Cek apakah id_kelas ada, jika tidak tampilkan error
        if (!$id_kelas) {
            show_error('Parameter kelas tidak ditemukan', 400);
        }

        if ($this->input->post()) {
            // Ambil nilai dari form POST
            $keamanan_lab_1 = $this->input->post('keamanan_lab_1', true);
            $keamanan_lab_2 = $this->input->post('keamanan_lab_2', true);

            // Simpan nilai keamanan_lab di session
            $keamanan_lab_string = $keamanan_lab_1 . ',' . $keamanan_lab_2;
            $this->session->set_userdata('keamanan_lab', $keamanan_lab_string);

            // Simpan id_kelas di session jika perlu
            $this->session->set_userdata('id_kelas', $id_kelas);

            // Redirect ke halaman ketertiban_lab
            redirect('competition/ketertiban_lab?kelas=' . $id_kelas);
        } else {
            // Ambil nilai keamanan_lab dari session jika ada
            $keamanan_lab = $this->session->userdata('keamanan_lab');
            if ($keamanan_lab) {
                // Pisahkan nilai keamanan_lab untuk dipisahkan ke 2 kategori
                list($keamanan_lab_1, $keamanan_lab_2) = explode(',', $keamanan_lab);
                $data['keamanan_lab_1'] = $keamanan_lab_1;
                $data['keamanan_lab_2'] = $keamanan_lab_2;
            } else {
                // Jika tidak ada data keamanan_lab di session, set default
                $data['keamanan_lab_1'] = $data['keamanan_lab_2'] = null;
            }

            // Tambahkan id_kelas ke data yang akan dipass ke view
            $data['id_kelas'] = $id_kelas;

            // Load views
            $this->load->view("layout/header_dash", $data);
            $this->load->view("layout/sidebar_admin", $data);
            $this->load->view("competition/keamanan_lab", $data);
            $this->load->view("layout/footer_dash");
        }
    }



    public function ketertiban_lab()
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();
        $id_kelas = $this->input->get('kelas');
        $role = $this->session->userdata('role');

        if ($this->input->post()) {
            $ketertiban_lab_1 = $this->input->post('ketertiban_lab_1', true);
            $ketertiban_lab_2 = $this->input->post('ketertiban_lab_2', true);
            $ketertiban_lab_3 = $this->input->post('ketertiban_lab_3', true);

            // If the role is 1, also capture ketertiban_lab_4
            if ($role == 1) {
                $ketertiban_lab_4 = $this->input->post('ketertiban_lab_4', true);
            } else {
                $ketertiban_lab_4 = null;
            }

            // Ensure all required inputs are provided
            if (isset($ketertiban_lab_1, $ketertiban_lab_2, $ketertiban_lab_3)) {
                // Concatenate ketertiban_lab_1, ketertiban_lab_2, and ketertiban_lab_3
                $ketertiban_lab_string = $ketertiban_lab_1 . ',' . $ketertiban_lab_2 . ',' . $ketertiban_lab_3;

                // Add ketertiban_lab_4 if available
                if ($ketertiban_lab_4 !== null) {
                    $ketertiban_lab_string .= ',' . $ketertiban_lab_4;
                }

                // Save ketertiban_lab in session
                $this->session->set_userdata('ketertiban_lab', $ketertiban_lab_string);

                // Save id_kelas in session if necessary
                $this->session->set_userdata('id_kelas', $id_kelas);
            }

            // Redirect to kebersihan_lab
            redirect('competition/kebersihan_lab?kelas=' . $id_kelas);
        } else {
            $data['title'] = 'Kompetisi 5K2S';

            // Retrieve ketertiban_lab from session if available
            $ketertiban_lab = $this->session->userdata('ketertiban_lab');
            if ($ketertiban_lab) {
                // Split ketertiban_lab into parts and handle missing elements gracefully
                $ketertiban_lab_parts = explode(',', $ketertiban_lab);
                $data['ketertiban_lab_1'] = $ketertiban_lab_parts[0] ?? null;
                $data['ketertiban_lab_2'] = $ketertiban_lab_parts[1] ?? null;
                $data['ketertiban_lab_3'] = $ketertiban_lab_parts[2] ?? null;
                $data['ketertiban_lab_4'] = $ketertiban_lab_parts[3] ?? null; // Only available if role = 1
            } else {
                // Set default values if ketertiban_lab is not set in session
                $data['ketertiban_lab_1'] = $data['ketertiban_lab_2'] = $data['ketertiban_lab_3'] = $data['ketertiban_lab_4'] = null;
            }

            // Add id_kelas to the data array for the view
            $data['id_kelas'] = $id_kelas;

            // Load views
            $this->load->view("layout/header_dash", $data);
            $this->load->view("layout/sidebar_admin", $data);
            $this->load->view("competition/ketertiban_lab", $data);
            $this->load->view("layout/footer_dash");
        }
    }


    public function kebersihan_lab()
    {
        // Ambil data user dan validasi akses
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();
        $id_kelas = $this->input->get('kelas');
        $id_user = $this->session->userdata('user_id'); // Ambil id_user dari session

        // Proses form jika ada post request
        if ($this->input->post()) {
            // Ambil kebersihan_lab dari POST dan simpan di session
            $kebersihan_lab = $this->input->post('kebersihan_lab');

            if (isset($kebersihan_lab)) {
                // Simpan kebersihan_lab ke session
                $this->session->set_userdata('kebersihan_lab', $kebersihan_lab);
            }

            // Data untuk diinsert ke tb_aspek
            $data_to_insert = array(
                'kerapihan_lab' => $this->session->userdata('kerapihan_lab'),
                'keamanan_lab' => $this->session->userdata('keamanan_lab'),
                'ketertiban_lab' => $this->session->userdata('ketertiban_lab'),
                'kebersihan_lab' => $this->session->userdata('kebersihan_lab'),
                'id_kelas' => $id_kelas, // Pastikan id_kelas ada dan valid
                'id_user' => $id_user  // Tambahkan id_user ke data
            );

            $this->db->insert('tb_aspek', $data_to_insert);
            $this->session->unset_userdata('kerapihan_lab');
            $this->session->unset_userdata('keamanan_lab');
            $this->session->unset_userdata('ketertiban_lab');
            $this->session->unset_userdata('kebersihan_lab');

            // Redirect ke halaman kompetisi setelah data berhasil disimpan
            redirect('competition');
        } else {
            // Load views
            $data['title'] = 'Kompetisi 5K2S';
            $data['id_kelas'] = $id_kelas;
            $this->load->view("layout/header_dash");
            $this->load->view("layout/sidebar_admin", $data);
            $this->load->view("competition/kebersihan_lab", $data); // Kirim data ke view
            $this->load->view("layout/footer_dash");
        }
    }


    public function kerapihan_lab_edit($id_aspek)
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();
        $data['title'] = 'Edit Kerapihan Lab';
        $kerapihan_lab = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($kerapihan_lab) {
            $kerapihan_lab_value = $kerapihan_lab['kerapihan_lab'] ?? '0,0,0';
            $kerapihan_lab_array = explode(',', $kerapihan_lab_value);

            $data['kerapihan_lab_1'] = $kerapihan_lab_array[0] ?? 0;
            $data['kerapihan_lab_2'] = $kerapihan_lab_array[1] ?? 0; // Atribut
            $data['kerapihan_lab_3'] = $kerapihan_lab_array[2] ?? 0; // Rambut dan Seragam
        } else {
            $data['kerapihan_lab_1'] = 0;
            $data['kerapihan_lab_2'] = 0;
            $data['kerapihan_lab_3'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/kerapihan_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }

    public function update_kerapihan_lab($id_aspek)
    {
        $this->check_access();
        $kerapihan_lab_1 = $this->input->post('kerapihan_lab_1');
        $kerapihan_lab_2 = $this->input->post('kerapihan_lab_2');
        $kerapihan_lab_3 = $this->input->post('kerapihan_lab_3');

        $kerapihan_lab_string = $kerapihan_lab_1 . ',' . $kerapihan_lab_2 . ',' . $kerapihan_lab_3;
        // Update database berdasarkan ID dari URL
        $data = [
            'kerapihan_lab' => $kerapihan_lab_string,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        // Redirect setelah berhasil update
        redirect('competition/keamanan_lab_edit/edit/' . $id_aspek);
    }

    public function keamanan_lab_edit($id_aspek)
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();
        $data['title'] = 'Edit keamanan Lab';
        $keamanan_lab = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($keamanan_lab) {
            $keamanan_lab_value = $keamanan_lab['keamanan_lab'] ?? '0,0';
            $keamanan_lab_array = explode(',', $keamanan_lab_value);

            $data['keamanan_lab_1'] = $keamanan_lab_array[0] ?? 0;
            $data['keamanan_lab_2'] = $keamanan_lab_array[1] ?? 0;
        } else {
            $data['keamanan_lab_1'] = 0;
            $data['keamanan_lab_2'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/keamanan_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }

    public function update_keamanan_lab($id_aspek)
    {
        $this->check_access();
        $keamanan_lab_1 = $this->input->post('keamanan_lab_1');
        $keamanan_lab_2 = $this->input->post('keamanan_lab_2');

        $keamanan_lab_string = $keamanan_lab_1 . ',' . $keamanan_lab_2;
        $data = [
            'keamanan_lab' => $keamanan_lab_string,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        redirect('competition/ketertiban_lab_edit/edit/' . $id_aspek);
    }

    public function ketertiban_lab_edit($id_aspek)
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();
        $data['title'] = 'Edit keteriban Lab';
        $ketertiban_lab = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($ketertiban_lab) {
            $ketertiban_lab_value = $ketertiban_lab['ketertiban_lab'] ?? '0,0,0';
            $ketertiban_lab_array = explode(',', $ketertiban_lab_value);

            $data['ketertiban_lab_1'] = $ketertiban_lab_array[0] ?? 0;
            $data['ketertiban_lab_2'] = $ketertiban_lab_array[1] ?? 0;
            $data['ketertiban_lab_3'] = $ketertiban_lab_array[2] ?? 0;
            $data['ketertiban_lab_4'] = $ketertiban_lab_array[3] ?? 0;
        } else {
            $data['ketertiban_lab_1'] = 0;
            $data['ketertiban_lab_2'] = 0;
            $data['ketertiban_lab_3'] = 0;
            $data['ketertiban_lab_4'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/ketertiban_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }


    public function update_ketertiban_lab($id_aspek)
    {
        // Ambil data role pengguna dari sesi
        $role = $this->session->userdata('role');

        // Ambil inputan dari form
        $ketertiban_lab_1 = $this->input->post('ketertiban_lab_1');
        $ketertiban_lab_2 = $this->input->post('ketertiban_lab_2');
        $ketertiban_lab_3 = $this->input->post('ketertiban_lab_3');
        $ketertiban_lab_4 = $this->input->post('ketertiban_lab_4');

        // Pengkondisian berdasarkan role
        if ($role == 1) {
            $ketertiban_lab_string = $ketertiban_lab_1 . ',' . $ketertiban_lab_2 . ',' . $ketertiban_lab_3 . ',' . $ketertiban_lab_4;
        } else {
            $ketertiban_lab_string = $ketertiban_lab_1 . ',' . $ketertiban_lab_2 . ',' . $ketertiban_lab_3;
        }

        // Siapkan data untuk update
        $data = [
            'ketertiban_lab' => $ketertiban_lab_string,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        redirect('competition/kebersihan_lab_edit/edit/' . $id_aspek);
    }

    public function kebersihan_lab_edit($id_aspek)
    {
        $data = $this->prepare_user_data('Dashboard 5K2S');
        $this->check_access();
        $data['title'] = 'Edit Kebersihan Lab';

        $aspek = $this->Aspek_m->get_kerapihan_lab_by_id($id_aspek);

        if ($aspek) {
            $data['kebersihan_lab'] = $aspek['kebersihan_lab'] ?? 0;
        } else {
            $data['kebersihan_lab'] = 0;
        }

        $data['id_aspek'] = $id_aspek;

        // Load view
        $this->load->view("layout/header_dash");
        $this->load->view("layout/sidebar_admin", $data);
        $this->load->view("competition/kebersihan_lab_edit", $data);
        $this->load->view("layout/footer_dash");
    }


    public function update_kebersihan_lab($id_aspek)
    {
        $this->check_access();
        $kebersihan_lab = (int) $this->input->post('kebersihan_lab');

        $data = [
            'kebersihan_lab' => $kebersihan_lab,
            'updated_at' => date('Y-m-d')
        ];

        $this->db->where('id_aspek', $id_aspek);
        $this->db->update('tb_aspek', $data);

        redirect('competition');
    }

    private function prepare_user_data($title)
    {
        // Ambil user_id dari session
        $user_id = $this->session->userdata('user_id');

        // Cek apakah user_id ada di session
        if (!$user_id) {
            show_error('Anda harus login terlebih dahulu.', 403);
        }

        // Load model kelas untuk mengambil data kelas
        $this->load->model('Kelas_m');

        // Ambil data kelas berdasarkan user_id
        $kelas_data = $this->Kelas_m->GetDataByUserId($user_id);

        // Pastikan data kelas tidak kosong
        if (empty($kelas_data)) {
            $kelas_data = [];
        }

        return [
            'title' => $title,
            'username' => $this->session->userdata('username'),
            'role' => $this->session->userdata('role'),
            'kelas' => $kelas_data, // Tambahkan data kelas ke array
        ];
    }
}
