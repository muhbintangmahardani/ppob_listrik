<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class pembayaran extends CI_Controller {
public function notification() {
    // 1. Tangkap paket data dari Midtrans
    $json_result = file_get_contents('php://input');
    $notif = json_decode($json_result);

    // Jika kosong, langsung tolak agar Vercel tidak bingung
    if (!$notif) {
        http_response_code(400);
        exit('Data tidak valid');
    }

    // 2. Ambil Order ID (Ingat, potong buntut waktu/timestamp seperti yang kita bahas sebelumnya)
    $order_id_midtrans = $notif->order_id;
    $pecah_id = explode('-', $order_id_midtrans);
    // Sesuaikan ini dengan bentuk ID kamu (Misal: TRX-123)
    $id_transaksi_asli = $pecah_id[0] . '-' . $pecah_id[1]; 
    
    $status_bayar = $notif->transaction_status;

    // 3. Proses Update ke Database Railway (Bungkus pakai Try-Catch agar tidak crash)
    try {
        // Contoh update status (Sesuaikan dengan nama Model-mu sendiri)
        // $this->load->model('M_transaksi');
        // $this->M_transaksi->update_status($id_transaksi_asli, $status_bayar);

        // ========================================================
        // 4. SUPER PENTING: Wajib panggil 200 OK di paling bawah!
        // ========================================================
        http_response_code(200);
        echo "Notifikasi sukses diproses ke database";

    } catch (Exception $e) {
        // Jika database Railway ngadat, Vercel tidak akan layar putih, 
        // tapi mencatat pesan error ini untuk kita baca nanti.
        http_response_code(500);
        echo "Gagal konek database: " . $e->getMessage();
    }
}

  public function __construct() {
       parent::__construct();
       if ($this->session->userdata('login')!=TRUE) {
           redirect('admin/login','refresh');
       }elseif ($this->session->userdata('id_level')==FALSE) {
           redirect('dashboard','refresh');
       }
       $this->load->model('m_pembayaran','pembayaran');
  }

  public function index()
  {
      $data['DataPembayaran'] = $this->pembayaran->getDataPembayaran();
      $data['judul'] = "PPOB | Halaman Data Pembayaran";
      $data['konten'] = "admin/v_pembayaran";
      $this->load->view('v_template', $data);
  }

  public function data_pembayaran($id){
    $data=$this->pembayaran->data_pembayaran($id);
    echo json_encode($data);
  }

  public function konfirmasi_pembayaran(){
      $data=$this->pembayaran->konfirmasi_pembayaran();
      $this->session->set_flashdata('pesan_sukses', 'Sukses Mengonfirmasi Pembayaran');
      redirect('pembayaran');
  }

  public function tolak_pembayaran(){
    $data=$this->pembayaran->tolak_pembayaran();
    $this->session->set_flashdata('pesan_sukses', 'Sukses Menolak Pembayaran');
    redirect('pembayaran');
  }

}
