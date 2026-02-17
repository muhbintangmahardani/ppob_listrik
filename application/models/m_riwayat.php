<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_riwayat extends CI_Model {

    public function getDataRiwayat()
    {
        // PERBAIKAN: Menambahkan CONCAT bulan dan tahun sebagai bulan_bayar
        // Parameter FALSE ditambahkan agar CodeIgniter tidak error membaca fungsi CONCAT
        $this->db->select("
            p.id_pembayaran,
            p.tanggal_pembayaran,
            p.total_bayar,
            p.status_bayar,
            p.status,
            p.bukti,
            pl.nama_pelanggan,
            pl.nomor_kwh,
            CONCAT(t.bulan, ' ', t.tahun) AS bulan_bayar
        ", FALSE); 
        
        $this->db->from('pembayaran p');
        $this->db->join('tagihan t', 't.id_tagihan = p.id_tagihan', 'left');
        $this->db->join('penggunaan pn', 'pn.id_penggunaan = t.id_penggunaan', 'left');
        $this->db->join('pelanggan pl', 'pl.id_pelanggan = pn.id_pelanggan', 'left');
        
        // Urutkan dari yang terbaru
        $this->db->order_by('p.id_pembayaran', 'DESC');
        
        return $this->db->get()->result();
    }

    public function getDetailRiwayat($id)
    {
        // PERBAIKAN: Menambahkan CONCAT bulan dan tahun sebagai bulan_bayar
        $this->db->select("
            p.*,
            pl.nama_pelanggan,
            pl.nomor_kwh,
            t.bulan,
            t.tahun,
            t.jumlah_meter,
            pn.meter_awal,
            pn.meter_akhir,
            a.nama_admin,
            CONCAT(t.bulan, ' ', t.tahun) AS bulan_bayar
        ", FALSE);
        
        $this->db->from('pembayaran p');
        $this->db->join('admin a', 'a.id_admin = p.id_admin', 'left');
        $this->db->join('tagihan t', 't.id_tagihan = p.id_tagihan', 'left');
        $this->db->join('penggunaan pn', 'pn.id_penggunaan = t.id_penggunaan', 'left');
        $this->db->join('pelanggan pl', 'pl.id_pelanggan = pn.id_pelanggan', 'left');
        
        $this->db->where('p.id_pembayaran', $id);
        
        return $this->db->get()->row();
    }

    // --- FUNGSI UPDATE STATUS DARI WEBHOOK MIDTRANS ---
    public function update_status($order_id, $status_baru)
    {
        // Sesuaikan nama kolom status. Saya asumsikan kolomnya bernama 'status'
        $data = array('status' => $status_baru);
        
        // Mengubah data di tabel 'pembayaran' berdasarkan 'id_pembayaran' (Order ID)
        $this->db->where('id_pembayaran', $order_id);
        $this->db->update('pembayaran', $data);
    }
}