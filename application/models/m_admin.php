<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_admin extends CI_Model {

    // 1. FUNGSI LOGIN
    public function get_login(){
        $password = crypt($this->input->post('password'),'garam');
        $this->db->select('*');
        $this->db->from('admin');
        $this->db->where('username', $this->input->post('username'));
        $this->db->where('password', $password);
        return $this->db->get();
    }

    // 2. FUNGSI MONITORING PEMBAYARAN (DIPERBAIKI)
    public function get_semua_pembayaran()
    {
        // Ambil data pembayaran dan info tagihan/pelanggan terkait
        $this->db->select('
            pembayaran.id_pembayaran,
            pembayaran.tanggal_pembayaran,
            pembayaran.total_bayar,
            pembayaran.bukti,
            pembayaran.status as status_bayar, /* Kita alias jadi status_bayar */
            pembayaran.id_tagihan,
            tagihan.bulan,
            tagihan.tahun,
            pelanggan.nama_pelanggan,
            pelanggan.nomor_kwh
        ');
        $this->db->from('pembayaran');
        
        // GUNAKAN LEFT JOIN AGAR DATA TETAP MUNCUL WALAUPUN RELASI PUTUS
        $this->db->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan', 'left');
        $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan', 'left');
        
        // Urutkan dari yang terbaru (ID terbesar di atas)
        $this->db->order_by('pembayaran.id_pembayaran', 'DESC');
        
        return $this->db->get()->result();
    }

    // Konfirmasi Manual (DIPERBAIKI UNTUK REAL-TIME WAKTU)
    public function konfirmasi_pembayaran($id_pembayaran)
    {
        $bayar = $this->db->get_where('pembayaran', ['id_pembayaran' => $id_pembayaran])->row();
        
        if($bayar){
            // Atur zona waktu ke WIB agar jamnya sesuai (opsional tapi sangat disarankan)
            date_default_timezone_set('Asia/Jakarta'); 

            // Update Pembayaran (Status Lunas & Catat Waktu Saat Diklik)
            $this->db->where('id_pembayaran', $id_pembayaran);
            $this->db->update('pembayaran', [
                'status' => 'Lunas',
                'tanggal_pembayaran' => date('Y-m-d H:i:s') // MENYIMPAN JAM, MENIT, DETIK SAAT DIKLIK LUNAS
            ]);

            // Update Tagihan
            $this->db->where('id_tagihan', $bayar->id_tagihan);
            $this->db->update('tagihan', ['status' => 'Lunas']);
            
            return TRUE;
        }
        return FALSE;
    }

    // Tolak Pembayaran
    public function tolak_pembayaran($id_pembayaran)
    {
        $this->db->where('id_pembayaran', $id_pembayaran);
        return $this->db->update('pembayaran', ['status' => 'Ditolak']);
    }
}