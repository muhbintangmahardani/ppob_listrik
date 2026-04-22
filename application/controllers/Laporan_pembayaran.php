<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Laporan_pembayaran extends CI_Controller {

  public function __construct() {
       parent::__construct();
       // Cek Login
       if ($this->session->userdata('login') != TRUE) {
           redirect('admin/login','refresh');
       }
       // Load Model
       $this->load->model('M_laporan_pembayaran', 'laporan');
  }

  public function index()
  {
        $data['DataPembayaran'] = $this->laporan->getDataPembayaran();
        
        $data['judul'] = "Laporan Transaksi";
        $data['konten'] = "admin/v_laporan";
        $this->load->view('v_template', $data);
  }

}