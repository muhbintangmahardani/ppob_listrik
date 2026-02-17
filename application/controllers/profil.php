<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Profil extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        if ($this->session->userdata('login') != TRUE) {
            redirect('welcome','refresh');
        }
        $this->load->model('m_profil');
    }

    public function index()
    {
        $data['profil'] = $this->m_profil->get_profil_saya();
        
        $data['judul'] = 'Profil Saya';
        $data['konten'] = 'user/v_profil';
        $this->load->view('v_template', $data);
    }

    public function update()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'Nama Lengkap', 'required');
        $this->form_validation->set_rules('username', 'Username', 'required');
        
        if ($this->form_validation->run() == TRUE) {
            
            // 1. Update Database & Upload
            // Fungsi ini me-return nama file foto baru jika ada upload
            $foto_baru = $this->m_profil->update_profil();
            
            // 2. UPDATE SESSION (Agar Navbar langsung berubah)
            // Update nama
            $this->session->set_userdata('nama_pelanggan', $this->input->post('nama_pelanggan'));
            
            // Update foto (Hanya jika user upload foto baru)
            if($foto_baru != NULL){
                $this->session->set_userdata('foto_profil', $foto_baru);
            }
            
            $this->session->set_flashdata('pesan_sukses', 'Profil berhasil diperbarui.');
        } else {
            $this->session->set_flashdata('pesan_gagal', validation_errors());
        }
        
        redirect('profil', 'refresh');
    }
}