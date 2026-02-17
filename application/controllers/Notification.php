<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Notification extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        // Load Model jika diperlukan, tapi kita bisa pakai query builder standar
        // Pastikan Library Midtrans sudah terbaca
    }

    public function index()
    {
        // 1. Konfigurasi Midtrans (SAMA PERSIS dengan di Controller User)
        // GANTI SERVER KEY INI DENGAN MILIK ANDA
        \Midtrans\Config::$serverKey = 'ISI_DENGAN_SERVER_KEY_MIDTRANS'; 
        \Midtrans\Config::$isProduction = false; // Sandbox
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 2. Terima Input JSON dari Midtrans
        // Midtrans mengirim data lewat "php://input", bukan $_POST biasa
        $json_result = file_get_contents('php://input');
        $result = json_decode($json_result);

        if($result) {
            $notif = new \Midtrans\Notification();

            $transaction = $notif->transaction_status;
            $type = $notif->payment_type;
            $order_id = $notif->order_id;
            $fraud = $notif->fraud_status;

            // 3. Logika Update Status Berdasarkan Respon Midtrans
            
            // KASUS 1: PEMBAYARAN SUKSES (Settlement)
            if ($transaction == 'capture') {
                // Untuk Kartu Kredit
                if ($fraud == 'challenge') {
                    $this->update_status($order_id, 'Pending');
                } else {
                    $this->update_status($order_id, 'Lunas');
                }
            } else if ($transaction == 'settlement') {
                // Untuk Transfer Bank, GoPay, ShopeePay, dll
                $this->update_status($order_id, 'Lunas');

            // KASUS 2: MASIH PENDING (Menunggu Bayar)
            } else if ($transaction == 'pending') {
                $this->update_status($order_id, 'Pending');

            // KASUS 3: GAGAL / KADALUARSA / DIBATALKAN
            } else if ($transaction == 'deny') {
                $this->update_status($order_id, 'Ditolak');
            } else if ($transaction == 'expire') {
                $this->update_status($order_id, 'Ditolak'); 
            } else if ($transaction == 'cancel') {
                $this->update_status($order_id, 'Ditolak');
            }
        }
    }

    // Fungsi Private untuk Update Database
    private function update_status($order_id, $status_baru)
    {
        // 1. Update Tabel Pembayaran (Status Pembayaran)
        $data_update = ['status_bayar' => $status_baru];
        
        // Jika status Lunas, kita set id_admin = 0 (Sistem) atau id admin tertentu
        if($status_baru == 'Lunas'){
             // Opsional: Catat waktu lunas jika ada kolomnya
             // $data_update['tanggal_lunas'] = date('Y-m-d H:i:s');
        }

        $this->db->where('order_id', $order_id);
        $this->db->update('pembayaran', $data_update);

        // 2. Update Tabel Tagihan (PENTING!)
        // Jika pembayaran LUNAS, maka tagihan listrik bulan itu juga harus LUNAS
        if($status_baru == 'Lunas'){
            
            // Cari dulu id_tagihan berdasarkan order_id di tabel pembayaran
            $cek_pembayaran = $this->db->get_where('pembayaran', ['order_id' => $order_id])->row();
            
            if($cek_pembayaran){
                // Update tabel tagihan jadi 'Lunas' (sesuaikan nama kolom status di tabel tagihan Anda)
                // Jika di tabel tagihan kolomnya 'status', dan isinya 'Lunas' / 'Belum Bayar'
                $this->db->set('status', 'Lunas'); 
                $this->db->where('id_tagihan', $cek_pembayaran->id_tagihan);
                $this->db->update('tagihan');
            }
        }
    }
}