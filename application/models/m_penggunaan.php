<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_penggunaan extends CI_Model {

    /* =========================
       DATA MASTER
    ========================== */

    public function getDataPelanggan()
    {
        return $this->db
            ->join('tarif','tarif.id_tarif = pelanggan.id_tarif')
            ->get('pelanggan')
            ->result();
    }

    public function getDataTarif()
    {
        return $this->db->get('tarif')->result();
    }

    /* =========================
       CEK PENGGUNAAN BULAN & TAHUN
    ========================== */

    public function cek_penggunaan()
    {
        return $this->db
            ->where('bulan', $this->input->post('bulan'))
            ->where('tahun', $this->input->post('tahun'))
            ->where('id_pelanggan', $this->input->post('id_pelanggan'))
            ->get('penggunaan')
            ->num_rows() > 0;
    }

    /* =========================
       TAMBAH PENGGUNAAN & TAGIHAN
    ========================== */

    public function tambah_penggunaan()
    {
        $meter_awal  = (int)$this->input->post('meter_awal');
        $meter_akhir = (int)$this->input->post('meter_akhir');

        // VALIDASI
        if ($meter_akhir < $meter_awal) {
            return false;
        }

        $jumlah_meter = $meter_akhir - $meter_awal;

        // INSERT PENGGUNAAN
        $this->db->insert('penggunaan', [
            'id_pelanggan' => $this->input->post('id_pelanggan'),
            'bulan'        => $this->input->post('bulan'),
            'tahun'        => $this->input->post('tahun'),
            'meter_awal'   => $meter_awal,
            'meter_akhir'  => $meter_akhir
        ]);

        $id_penggunaan = $this->db->insert_id();

        // INSERT TAGIHAN (TANPA id_pelanggan)
        $this->db->insert('tagihan', [
            'id_penggunaan' => $id_penggunaan,
            'bulan'         => $this->input->post('bulan'),
            'tahun'         => $this->input->post('tahun'),
            'jumlah_meter'  => $jumlah_meter,
            'status'        => 'Belum Dibayar'
        ]);

        return $this->db->affected_rows() > 0;
    }

    /* =========================
       DATA PENGGUNAAN
    ========================== */

    public function getDataPenggunaan($id_pelanggan)
    {
        return $this->db
            ->join('pelanggan','pelanggan.id_pelanggan = penggunaan.id_pelanggan')
            ->where('penggunaan.id_pelanggan', $id_pelanggan)
            ->get('penggunaan')
            ->result();
    }

    public function data_penggunaan($id_penggunaan)
    {
        return $this->db
            ->join('pelanggan','pelanggan.id_pelanggan = penggunaan.id_pelanggan')
            ->where('id_penggunaan', $id_penggunaan)
            ->get('penggunaan')
            ->row();
    }

    /* =========================
       DATA TAGIHAN
    ========================== */

    public function getDataTagihan($id_pelanggan)
    {
        return $this->db
            ->join('penggunaan','penggunaan.id_penggunaan = tagihan.id_penggunaan')
            ->where('penggunaan.id_pelanggan', $id_pelanggan)
            ->get('tagihan')
            ->result();
    }

    public function data_tagihan($id_tagihan)
    {
        return $this->db
            ->join('penggunaan','penggunaan.id_penggunaan = tagihan.id_penggunaan')
            ->where('id_tagihan', $id_tagihan)
            ->get('tagihan')
            ->row();
    }

    public function data_tagihan_detail($id_penggunaan)
    {
        return $this->db
            ->where('id_penggunaan', $id_penggunaan)
            ->get('tagihan')
            ->row();
    }

    /* =========================
       DATA PELANGGAN (AJAX)
    ========================== */

    public function data_pelanggan($id)
    {
        return $this->db
            ->join('tarif','tarif.id_tarif = pelanggan.id_tarif')
            ->where('id_pelanggan', $id)
            ->get('pelanggan')
            ->row();
    }

    /* =========================
       EDIT PENGGUNAAN & TAGIHAN
    ========================== */

    public function edit_penggunaan()
    {
        $meter_awal  = (int)$this->input->post('meter_awal');
        $meter_akhir = (int)$this->input->post('meter_akhir');

        if ($meter_akhir < $meter_awal) {
            return false;
        }

        $jumlah_meter = $meter_akhir - $meter_awal;

        // UPDATE PENGGUNAAN
        $this->db->where('id_penggunaan', $this->input->post('id_penggunaan'))
                 ->update('penggunaan', [
                     'bulan'       => $this->input->post('bulan'),
                     'tahun'       => $this->input->post('tahun'),
                     'meter_awal'  => $meter_awal,
                     'meter_akhir' => $meter_akhir
                 ]);

        // UPDATE TAGIHAN
        $this->db->where('id_penggunaan', $this->input->post('id_penggunaan'))
                 ->update('tagihan', [
                     'jumlah_meter' => $jumlah_meter
                 ]);

        return true;
    }

}
