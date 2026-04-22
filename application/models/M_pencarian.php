<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_pencarian extends CI_Model {

    // 1. FUNGSI UNTUK ADMIN (Mencari semua data pelanggan)
    public function cari_pelanggan($keyword) {
        $this->db->select('*');
        $this->db->from('pelanggan'); 
        
        $this->db->like('nama_pelanggan', $keyword);
        $this->db->or_like('nomor_kwh', $keyword);
        
        return $this->db->get()->result();
    }

// 2. FUNGSI UNTUK PELANGGAN/USER (Hanya mencari tagihannya sendiri)
    public function cari_tagihan_saya($keyword, $id_pelanggan) {
        $this->db->select('*');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
        
        // PERBAIKAN DI SINI:
        // Kita gunakan penggunaan.id_pelanggan karena tabel tagihan tidak memiliki id_pelanggan
        $this->db->where('penggunaan.id_pelanggan', $id_pelanggan);
        
        // Pencarian dibatasi dalam grup
        $this->db->group_start();
        $this->db->like('penggunaan.bulan', $keyword);
        $this->db->or_like('penggunaan.tahun', $keyword);
        $this->db->or_like('tagihan.status', $keyword);
        $this->db->group_end();
        
        return $this->db->get()->result();
    }
}