<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pencarian extends CI_Controller {

    public function __construct() {
        parent::__construct();
        // Pastikan user atau admin sudah login
        if($this->session->userdata('id_level') == NULL && $this->session->userdata('id_pelanggan') == NULL) {
            redirect('login');
        }
        $this->load->model('M_pencarian');
    }

    public function index() {
        $keyword = $this->input->get('keyword', TRUE);

        if (empty($keyword)) {
            redirect('dashboard');
        }

        $data['keyword'] = htmlspecialchars($keyword);
        $data['judul']   = 'Hasil Pencarian: ' . htmlspecialchars($keyword);

        // --- CEK ROLE LOGIN ---
        if ($this->session->userdata('id_level') != NULL) {
            // 1. JIKA ADMIN (Level 1 atau 2)
            $data['hasil_pelanggan'] = $this->M_pencarian->cari_pelanggan($keyword);
            $data['konten']  = 'v_pencarian'; // Menggunakan view admin yang kita buat sebelumnya
            
        } else {
            // 2. JIKA PELANGGAN / USER
            $id_pelanggan = $this->session->userdata('id_pelanggan');
            $data['hasil_tagihan'] = $this->M_pencarian->cari_tagihan_saya($keyword, $id_pelanggan);
            $data['konten']  = 'v_pencarian_user'; // Menggunakan view khusus pelanggan
        }
        
        // Sesuaikan 'v_template' dengan nama file template utama Anda
        $this->load->view('v_template', $data); 
    }
}