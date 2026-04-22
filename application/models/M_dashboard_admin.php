<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class m_dashboard_admin extends CI_Model {

    public function __construct() {
        parent::__construct();
        // Pastikan selalu menggunakan zona waktu yang tepat (WIB)
        date_default_timezone_set('Asia/Jakarta');
    }

    // ==========================================
    // DATA BULAN INI (REAL-TIME SEJATI)
    // ==========================================

    public function getDataPembayaran(){
        $this->db->select('*');
        $this->db->from('pembayaran');
        // Cocokkan bulan dan tahun di database dengan waktu saat ini
        $this->db->where('MONTH(tanggal_pembayaran)', date('m'));
        $this->db->where('YEAR(tanggal_pembayaran)', date('Y'));
        return $this->db->get()->result();
    }

    public function getDataPembayaranLunas(){
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->where('MONTH(tanggal_pembayaran)', date('m'));
        $this->db->where('YEAR(tanggal_pembayaran)', date('Y'));
        $this->db->where('status', 'Lunas');
        return $this->db->get()->result();
    }

    public function getDataPembayaranBelumLunas(){
        $this->db->select('*');
        $this->db->from('pembayaran');
        $this->db->where('MONTH(tanggal_pembayaran)', date('m'));
        $this->db->where('YEAR(tanggal_pembayaran)', date('Y'));
        $this->db->where('status !=', 'Lunas');
        return $this->db->get()->result();
    }

    // ==========================================
    // DATA KESELURUHAN (ALL TIME)
    // ==========================================

    public function getDataPembayaranSemua(){
        $this->db->select('*');
        $this->db->from('pembayaran');
        return $this->db->get()->result();
    }

    public function getDataPembayaranSemuaLunas(){
        $this->db->select('*');
        $this->db->where('status', 'Lunas');
        $this->db->from('pembayaran');
        return $this->db->get()->result();
    }

    public function getDataPembayaranSemuaBelumLunas(){
        $this->db->select('*');
        $this->db->where('status !=', 'Lunas');
        $this->db->from('pembayaran');
        return $this->db->get()->result();
    }

}
?>