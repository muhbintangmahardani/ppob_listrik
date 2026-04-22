<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Riwayat extends CI_Controller {

    public function __construct() {
        parent::__construct();
        if ($this->session->userdata('login') != TRUE) {
            redirect('admin/login','refresh');
        } elseif ($this->session->userdata('id_level') == FALSE) {
            redirect('dashboard','refresh');
        }
        $this->load->model('m_riwayat','riwayat');
        
        // Memastikan seluruh fungsi di controller ini menggunakan waktu Indonesia (WIB)
        date_default_timezone_set('Asia/Jakarta');
    }

    // 1. HALAMAN UTAMA (WADAH UI)
    public function index()
    {
        $data['judul'] = "PPOB | Riwayat Transaksi Realtime";
        $data['konten'] = "admin/v_riwayat"; // Memuat view utama
        $this->load->view('v_template', $data);
    }

    // 2. FUNGSI AJAX REALTIME (LOAD TABEL PARTIAL)
    public function get_tabel_realtime()
    {
        $data['DataRiwayat'] = $this->riwayat->getDataRiwayat();
        $this->load->view('admin/tabel_riwayat_parsial', $data);
    }

    // 3. FUNGSI DETAIL (MODAL POPUP) - SUDAH DIPERBAIKI
    public function detail_riwayat($id)
    {
        $data = $this->riwayat->getDetailRiwayat($id);

        if ($data) {
            // --- A. PERBAIKAN FORMAT TANGGAL & JAM ---
            // Cek apakah tanggal valid dan bukan data kosong/default dari database
            if (!empty($data->tanggal_pembayaran) && $data->tanggal_pembayaran != '0000-00-00 00:00:00') {
                $waktu_db = strtotime($data->tanggal_pembayaran);
                // Format ulang agar rapi dibaca di Modal Detail
                $data->tanggal_pembayaran = date('d/m/Y H:i:s', $waktu_db) . ' WIB';
            } else {
                $data->tanggal_pembayaran = 'Menunggu Pembayaran';
            }

            // --- B. PERBAIKAN TEKS STATUS PENDING ---
            // Jika status di database masih kosong, '0', atau 'pending' huruf kecil
            if (empty($data->status) || $data->status == '0' || strtolower($data->status) == 'pending') {
                $data->status = 'Pending';
            } else {
                // Pastikan huruf depan besar (Lunas, Batal, dll)
                $data->status = ucfirst($data->status);
            }
        }

        echo json_encode($data);
    }

    // 4. FUNGSI WEBHOOK MIDTRANS (UPDATE STATUS OTOMATIS)
    public function midtrans_notif()
    {
        $json_result = file_get_contents('php://input');
        $notif = json_decode($json_result);

        if (!$notif) {
            http_response_code(400);
            echo "Bad Request";
            return;
        }

        $order_id = $notif->order_id;
        $transaction_status = $notif->transaction_status;

        // Logika Update Status
        if ($transaction_status == 'settlement' || $transaction_status == 'capture') {
            $this->riwayat->update_status($order_id, 'Lunas');
        } else if ($transaction_status == 'cancel' || $transaction_status == 'deny' || $transaction_status == 'expire') {
            $this->riwayat->update_status($order_id, 'Batal');
        } else if ($transaction_status == 'pending') {
            $this->riwayat->update_status($order_id, 'Pending');
        }

        http_response_code(200);
        echo "OK";
    }
}