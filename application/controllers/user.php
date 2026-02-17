<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('m_user','user');
        
        // Pastikan Anda sudah menginstall Midtrans via Composer atau Load Library manual
        // Jika error "Class 'Midtrans\Config' not found", pastikan autoloader sudah jalan
    }

    public function login()
    {
        if ($this->session->userdata('login')==TRUE){
            redirect('dashboard','refresh');
        }
        else{
             $data['DataTarif'] = $this->user->getDataTarif();
             $this->load->view('user/v_login',$data);
        }
    }

    public function proses_login(){
        $this->form_validation->set_rules('username','username', 'trim|required');
        $this->form_validation->set_rules('password','password', 'trim|required');
        
        if($this->form_validation->run() == TRUE){
           // Cek Login ke Model
           if($this->user->get_login()->num_rows() > 0){
               $data = $this->user->get_login()->row();
               
                $array = array(
                    'login' => TRUE,
                    'nama_pelanggan' => $data->nama_pelanggan,
                    'id_pelanggan' => $data->id_pelanggan,
                    'id_tarif' => $data->id_tarif,
                    'foto_profil' => $data->foto_profil 
                );
                
                $this->session->set_userdata($array);
                $this->session->set_flashdata('pesan_sukses', 'Sukses Masuk Ke Akun');
                redirect('dashboard','refresh');
            }else{
                $this->session->set_flashdata('pesan_gagal','Username Atau Password Salah');
                redirect('user/login','refresh');
            }
        }else{
            $this->session->set_flashdata('pesan_gagal',validation_errors());
             redirect('user/login','refresh');
        }
    }

    public function register()
    {
        $this->form_validation->set_rules('nama_pelanggan', 'nama_pelanggan', 'trim|required');
        $this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
        $this->form_validation->set_rules('nomor_kwh', 'nomor_kwh', 'trim|required');
        $this->form_validation->set_rules('username', 'username', 'trim|required');
        $this->form_validation->set_rules('password', 'password', 'trim|required');
        $this->form_validation->set_rules('id_tarif', 'id_tarif', 'trim|required');
        
        if ($this->form_validation->run() == TRUE) {
             if($this->user->registrasi_akun() == TRUE){
                 $this->session->set_flashdata('pesan_sukses', 'Sukses Mendaftarkan Akun, Silahkan Login');
                 redirect('user/login','refresh');
             }
             else{
                 $this->session->set_flashdata('pesan_gagal', 'Gagal Mendaftarkan Akun');
                 $this->load->view('user/register','refresh');
             }
         }
    }

    public function logout()
    {
        $this->session->sess_destroy();
        $this->session->set_flashdata('pesan_sukses', 'Sukses Keluar Akun');
        redirect('user/login','refresh');
    }

    /* ==========================================================
       TAMBAHAN: LOGIKA PEMBAYARAN MIDTRANS (REALTIME PENDING)
    ========================================================== */
    public function bayar_midtrans()
    {
        // 1. Konfigurasi Midtrans
        // GANTI 'SB-Mid-server-...' DENGAN SERVER KEY ANDA DARI DASHBOARD MIDTRANS
        \Midtrans\Config::$serverKey = 'Mid-server-6ZfrsLJynO8fdWw3OHbWAJBI'; 
        \Midtrans\Config::$isProduction = false;
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        // 2. Ambil Data Tagihan & Pelanggan
        $id_tagihan = $this->input->post('id_tagihan');
        
        // Query Manual (atau bisa buat fungsi di Model)
        $tagihan = $this->db->get_where('tagihan', ['id_tagihan' => $id_tagihan])->row();
        
        // Cek jika tagihan valid
        if(!$tagihan) {
            echo "Tagihan tidak ditemukan"; return;
        }

        $pelanggan = $this->db->get_where('pelanggan', ['id_pelanggan' => $tagihan->id_pelanggan])->row();
        $tarif = $this->db->get_where('tarif', ['id_tarif' => $pelanggan->id_tarif])->row();

        // 3. Hitung Total Bayar
        // Rumus: (Meter Pakai * Tarif per KWh) + Biaya Admin
        $biaya_admin = 2500; 
        $total_bayar = ($tagihan->jumlah_meter * $tarif->terperkwh) + $biaya_admin;

        // 4. Buat Order ID Unik (Format: TRX-Waktu-Acak)
        $order_id = 'TRX-' . time() . '-' . rand(100, 999);

        // 5. INPUT DATA KE DATABASE (PENTING: STATUS 'Pending')
        // Ini yang membuat Admin bisa melihat notifikasi realtime "Pending"
        $data_pembayaran = [
            'id_tagihan'         => $id_tagihan,
            'id_pelanggan'       => $pelanggan->id_pelanggan, // Optional, jika tabel pembayaran ada kolom ini
            'tanggal_pembayaran' => date('Y-m-d H:i:s'),
            'bulan_bayar'        => $tagihan->bulan . ' ' . $tagihan->tahun,
            'biaya_admin'        => $biaya_admin,
            'total_bayar'        => $total_bayar,
            'id_admin'           => 0, // 0 artinya user sendiri (bukan admin manual)
            'bukti'              => 'MIDTRANS-OTOMATIS',
            'status_bayar'       => 'Pending', // <--- STATUS AWAL
            'order_id'           => $order_id  // <--- KUNCI UTAMA CALLBACK
        ];

        // Simpan ke tabel pembayaran
        $this->db->insert('pembayaran', $data_pembayaran);

        // 6. Siapkan Parameter Midtrans Snap
        $params = [
            'transaction_details' => [
                'order_id' => $order_id,
                'gross_amount' => $total_bayar,
            ],
            'customer_details' => [
                'first_name' => $pelanggan->nama_pelanggan,
                // 'email' => 'email_pelanggan@example.com', // Jika ada kolom email
                'phone' => '08123456789', // Jika ada kolom no hp
            ],
            'item_details' => [
                [
                    'id' => $id_tagihan,
                    'price' => $total_bayar,
                    'quantity' => 1,
                    'name' => "Tagihan Listrik " . $tagihan->bulan . " " . $tagihan->tahun
                ]
            ]
        ];

        // 7. Minta Snap Token & Kirim ke View
        try {
            $snapToken = \Midtrans\Snap::getSnapToken($params);
            echo $snapToken; // Ini akan ditangkap oleh AJAX di View
        } catch (Exception $e) {
            echo "Error Midtrans: " . $e->getMessage();
        }
    }
}