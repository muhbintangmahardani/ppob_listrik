<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login') != TRUE) {
            $this->session->set_flashdata('pesan_gagal','Anda Harus Login Dahulu');
            redirect('user/login','refresh');
        }
        elseif ($this->session->userdata('id_level') == TRUE) {
            redirect('dashboard_admin','refresh');
        }

        $this->load->model('m_tagihan','tagihan');
    }

    public function index()
    {
        $data['DataTagihan'] = $this->tagihan->getDataTagihan();
        $data['judul'] = 'PPOB | Halaman Tagihan Pelanggan';
        $data['konten'] = 'user/v_tagihan';
        $this->load->view('v_template', $data);
    }

    // ==============================================================
    // TOKEN MIDTRANS (Hitung Harga Otomatis)
    // ==============================================================
    public function token_midtrans()
    {
        // Setup Midtrans
        require_once APPPATH . 'third_party/midtrans/Midtrans.php';
        
        // GANTI ServerKey DENGAN KEY ANDA
        \Midtrans\Config::$serverKey = 'ISI_SERVER_KEY_ANDA_DISINI'; 
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $id_tagihan = $this->input->post('id_tagihan');

        // 1. Ambil Data Tagihan & Tarif dari Model
        $detail = $this->tagihan->get_detail_tagihan($id_tagihan);

        if($detail) {
            // 2. Hitung Total Bayar (Rumus samakan dengan model update_bayar)
            $biaya_admin = 2500;
            $total_bayar = ($detail->jumlah_meter * $detail->terperkwh) + $biaya_admin;

            // Rules Midtrans: Minimal Rp 1.000 (jika hasil hitung 0/minus, set 1000 buat testing)
            if($total_bayar < 1000) $total_bayar = 1000;

            $transaction_details = array(
                'order_id' => 'PLN-' . $id_tagihan . '-' . time(), // Order ID Unik
                'gross_amount' => (int)$total_bayar, // Harus Integer
            );

            $customer_details = array(
                'first_name' => $this->session->userdata('nama_pelanggan'),
                'email'      => 'user@listrik.com', // Opsional
            );

            $params = array(
                'transaction_details' => $transaction_details,
                'customer_details'    => $customer_details
            );

            try {
                $snapToken = \Midtrans\Snap::getSnapToken($params);
                echo json_encode(['status' => 'sukses', 'token' => $snapToken]);
            } catch (Exception $e) {
                echo json_encode(['status' => 'gagal', 'pesan' => $e->getMessage()]);
            }
        } else {
            echo json_encode(['status' => 'gagal', 'pesan' => 'Data tagihan tidak ditemukan']);
        }
    }

    // ==============================================================
    // FINISH MIDTRANS (Update Database Otomatis)
    // ==============================================================
    public function finish_midtrans()
    {
        $id_tagihan = $this->input->post('id_tagihan');
        
        if ($id_tagihan) {
            // Panggil fungsi model baru untuk update LUNAS
            $this->tagihan->bayar_via_midtrans($id_tagihan);
            
            $this->session->set_flashdata('pesan_sukses', 'Pembayaran Berhasil! Tagihan Anda telah Lunas.');
        } else {
            $this->session->set_flashdata('pesan_gagal', 'Gagal memproses pembayaran.');
        }
        
        redirect('tagihan', 'refresh');
    }

    // --- FUNGSI UPLOAD BUKTI MANUAL (Biarkan saja untuk opsi cadangan) ---
    public function upload_bukti()
    {
        $config['upload_path']   = './assets/bukti/';
        $config['allowed_types'] = 'gif|jpg|png|jpeg';
        $config['max_size']      = '20000';
        $config['file_name']     = 'Bukti-' . date('YmdHis');

        $this->load->library('upload', $config);

        if ( ! $this->upload->do_upload('bukti')){
            $this->session->set_flashdata('pesan_gagal', $this->upload->display_errors());
            redirect('tagihan','refresh');
        } else {
            $update = $this->tagihan->update_bayar(); // Ini pakai fungsi lama
            if($update == TRUE){
                $this->session->set_flashdata('pesan_sukses', 'Berhasil Mengupload Bukti Bayar');
            } else {
                $this->session->set_flashdata('pesan_gagal', 'Gagal Mengupload Bukti');
            }
            redirect('tagihan','refresh');
        }
    }
}