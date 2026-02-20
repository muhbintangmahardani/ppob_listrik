<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Tagihan extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // --- TAMBAHKAN BARIS INI UNTUK SINKRONISASI WAKTU (WIB) ---
        date_default_timezone_set('Asia/Jakarta'); 
        // ----------------------------------------------------------

        // Cek login user
        if ($this->session->userdata('login') != TRUE) {
            $this->session->set_flashdata('pesan_gagal','Anda Harus Login Dahulu');
            redirect('user/login','refresh');
        }
        // Jika yang login ternyata admin, lempar ke dashboard admin
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
    // 1. TOKEN MIDTRANS (Hitung Harga & Insert Data "Pending")
    // ==============================================================
    public function token_midtrans()
    {
        // Setup Midtrans
        require_once APPPATH . 'third_party/midtrans/Midtrans.php';
        
        // GANTI ServerKey DENGAN KEY ANDA
        \Midtrans\Config::$serverKey = 'GANTI SERVER KEY INI DENGAN MILIK ANDA'; 
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $id_tagihan = $this->input->post('id_tagihan');

        // Ambil Data Tagihan & Tarif dari Model
        $detail = $this->tagihan->get_detail_tagihan($id_tagihan);

        if($detail) {
            // Hitung Total Bayar
            $biaya_admin = 2500;
            $total_bayar = ($detail->jumlah_meter * $detail->terperkwh) + $biaya_admin;

            // Rules Midtrans: Minimal Rp 1.000
            if($total_bayar < 1000) $total_bayar = 1000;

            // ====================================================================
            // CEK & HAPUS DATA PENDING LAMA (Mencegah Error "Order ID already taken")
            // ====================================================================
            $this->db->where('id_tagihan', $id_tagihan);
            $this->db->where('status_bayar', 'Pending'); 
            $cek_pending = $this->db->get('pembayaran')->row();

            if ($cek_pending) {
                // Jika user pernah klik bayar tapi batal, hapus data pending yang lama
                $this->db->where('id_pembayaran', $cek_pending->id_pembayaran);
                $this->db->delete('pembayaran');
            }

            // BUAT RECORD BARU agar selalu mendapat id_pembayaran yang fresh!
            $data_bayar = array(
                'id_tagihan'         => $id_tagihan,
                'tanggal_pembayaran' => date('Y-m-d H:i:s'),
                'total_bayar'        => $total_bayar,
                'status_bayar'       => 'Pending', 
                'bukti'              => 'MIDTRANS-OTOMATIS'
            );
            
            $this->db->insert('pembayaran', $data_bayar);
            $id_pembayaran = $this->db->insert_id(); // Ambil ID yang baru saja dibuat

            // ====================================================================

            $transaction_details = array(
                // Order ID menggunakan id_pembayaran asli yang dijamin selalu baru
                'order_id'     => $id_pembayaran, 
                'gross_amount' => (int)$total_bayar,
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
    // 2. FINISH MIDTRANS (Ketika User kembali dari pop-up Midtrans)
    // ==============================================================
    public function finish_midtrans()
    {
        $id_tagihan = $this->input->post('id_tagihan');
        
        if ($id_tagihan) {
            $this->tagihan->bayar_via_midtrans($id_tagihan);
            $this->session->set_flashdata('pesan_sukses', 'Pembayaran sedang diproses / Berhasil! Tagihan Anda telah Lunas.');
        } else {
            $this->session->set_flashdata('pesan_gagal', 'Gagal memproses pembayaran.');
        }
        
        redirect('tagihan', 'refresh');
    }

    // ==============================================================
    // 3. FUNGSI UPLOAD BUKTI MANUAL (Opsi Cadangan)
    // ==============================================================
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
            $update = $this->tagihan->update_bayar(); 
            if($update == TRUE){
                $this->session->set_flashdata('pesan_sukses', 'Berhasil Mengupload Bukti Bayar');
            } else {
                $this->session->set_flashdata('pesan_gagal', 'Gagal Mengupload Bukti');
            }
            redirect('tagihan','refresh');
        }
    }

// ==============================================================
    // 4. CETAK INVOICE / STRUK PEMBAYARAN
    // ==============================================================
    public function cetak_invoice($id_tagihan)
    {
        // Ambil data detail tagihan dari model (menggunakan fungsi yang sama seperti di midtrans)
        $data['detail'] = $this->tagihan->get_detail_tagihan($id_tagihan);

        // Pastikan datanya ada
        if (!$data['detail']) {
            $this->session->set_flashdata('pesan_gagal', 'Data tagihan tidak ditemukan.');
            redirect('tagihan', 'refresh');
        }

        // Ambil data pembayaran untuk menampilkan tanggal lunas dan total bayar
        // Asumsi tabel bernama 'pembayaran' dan ada kolom status_bayar
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->where('status_bayar', 'Lunas'); // Ubah jika status lunas Anda berbeda
        $data['pembayaran'] = $this->db->get('pembayaran')->row();

        $data['judul'] = 'Struk Pembayaran Listrik';
        
        // Load view cetak secara terpisah (tanpa template dashboard agar bersih)
        $this->load->view('user/v_cetak_invoice', $data);
    }
}
