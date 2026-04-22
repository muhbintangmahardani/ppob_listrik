<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {

  public function __construct() {
       parent::__construct();
       // Load Model m_admin dengan alias 'admin'
       $this->load->model('m_admin','admin');
  }

  // ==============================================================
  // 1. FUNGSI LOGIN (KODE LAMA - TETAP ADA)
  // ==============================================================

  public function login()
  {
    if ($this->session->userdata('login')==TRUE) {
        redirect('dashboard_admin','refresh');
    }
    else{
       $this->load->view('admin/v_login');
    }
  }

  public function proses_login(){
          $this->form_validation->set_rules('username','username', 'trim|required');
          $this->form_validation->set_rules('password','password', 'trim|required');
          if($this->form_validation->run() ==TRUE){
             if($this->admin->get_login()->num_rows()>0){
                 $data=$this->admin->get_login()->row();
                  $array=array(
                      'login'=> TRUE,
                      'nama_admin'=>$data->nama_admin,
                      'id_admin'=>$data->id_admin,
                      'id_level'=>$data->id_level
                  );
                  $this->session->set_userdata($array);
                  $this->session->set_flashdata('pesan_sukses', 'Sukses Masuk Ke Akun');
                  redirect('dashboard_admin','refresh');
              }else{
                  $this->session->set_flashdata('pesan_gagal','Username Atau Password Salah');
                  redirect('admin/login','refresh');
              }
          }else{
              $this->session->set_flashdata('pesan_gagal',validation_errors());
               redirect('admin/login','refresh');
          }
  }

  public function logout()
  {
    $this->session->sess_destroy();
    $this->session->set_flashdata('pesan_sukses', 'Sukses Keluar Akun');
    redirect('admin/login');
  }

  // ==============================================================
  // 2. FUNGSI MONITORING PEMBAYARAN (AGAR ADMIN TIDAK KOSONG)
  // ==============================================================

  public function konfirmasi_pembayaran()
  {
    // Cek Login
    if ($this->session->userdata('login') != TRUE) {
        redirect('admin/login','refresh');
    }

    // Ambil data dari model yang sudah di-fix (LEFT JOIN)
    $data['pembayaran'] = $this->admin->get_semua_pembayaran();
    
    $data['judul'] = 'Monitoring & Validasi Pembayaran';
    
    // Pastikan file view ini ada di folder application/views/admin/
    $data['konten'] = 'admin/v_konfirmasi_pembayaran';
    $this->load->view('v_template', $data); 
  }

  public function proses_konfirmasi($id_pembayaran)
  {
    if ($this->session->userdata('login') != TRUE) { redirect('admin/login','refresh'); }

    $this->admin->konfirmasi_pembayaran($id_pembayaran);
    $this->session->set_flashdata('pesan_sukses', 'Pembayaran berhasil dikonfirmasi Lunas.');
    redirect('admin/konfirmasi_pembayaran');
  }

  public function tolak_pembayaran($id_pembayaran)
  {
    if ($this->session->userdata('login') != TRUE) { redirect('admin/login','refresh'); }

    $this->admin->tolak_pembayaran($id_pembayaran);
    $this->session->set_flashdata('pesan_gagal', 'Pembayaran ditolak.');
    redirect('admin/konfirmasi_pembayaran');
  }
}