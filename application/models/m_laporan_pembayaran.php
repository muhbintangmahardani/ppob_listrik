<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_laporan_pembayaran extends CI_Model {

   public function getDataPembayaran()
   {
       $this->db->select('
           pelanggan.nomor_kwh,
           pelanggan.nama_pelanggan,
           pembayaran.tanggal_pembayaran,
           pembayaran.bulan_bayar,
           pembayaran.biaya_admin,
           pembayaran.total_bayar,
           pembayaran.id_pembayaran,
           pembayaran.status,
           pembayaran.bukti,
           penggunaan.meter_awal,
           penggunaan.meter_akhir,
           tagihan.jumlah_meter,
           admin.nama_admin
       ');
       $this->db->from('pembayaran');
       
       // Mengambil semua data yang statusnya tidak kosong
       $this->db->where('pembayaran.status !=', '');
       
       // PERBAIKAN: Tambahkan 'pembayaran.' agar tidak error ambiguous
       $this->db->order_by('pembayaran.id_pembayaran', 'desc');

       // JOIN KE ADMIN (LEFT JOIN) agar data Midtrans tetap muncul
       $this->db->join('admin', 'admin.id_admin = pembayaran.id_admin', 'left');
       
       // JOIN KE DATA PELANGGAN (LEFT JOIN) agar tidak error jika pelanggan dihapus
       $this->db->join('tagihan', 'tagihan.id_tagihan = pembayaran.id_tagihan', 'left');
       $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan', 'left');
       $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan', 'left');
       
       return $this->db->get()->result();
   }
}