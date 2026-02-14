<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_dashboard extends CI_Model {

    /*
    ============================================
    AMBIL ID PELANGGAN DARI SESSION
    ============================================
    */
    private function getIdPelanggan()
    {
        return $this->session->userdata('id_pelanggan');
    }

    /*
    ============================================
    DATA TAGIHAN TERBARU (REALTIME BERDASARKAN PENGGUNAAN)
    ============================================
    */
    public function getDataTagihan()
    {
        $this->db->select('
            penggunaan.id_penggunaan,
            penggunaan.bulan,
            penggunaan.tahun,
            penggunaan.meter_awal,
            penggunaan.meter_akhir,

            (penggunaan.meter_akhir - penggunaan.meter_awal) AS jumlah_meter,

            tagihan.id_tagihan,
            tagihan.status,

            pelanggan.id_pelanggan,
            pelanggan.nama_pelanggan,

            tarif.terperkwh
        ');

        // SUMBER DATA UTAMA DARI PENGGUNAAN (INI KUNCI REALTIME)
        $this->db->from('penggunaan');

        $this->db->join(
            'tagihan',
            'tagihan.id_penggunaan = penggunaan.id_penggunaan',
            'left'
        );

        $this->db->join(
            'pelanggan',
            'pelanggan.id_pelanggan = penggunaan.id_pelanggan'
        );

        $this->db->join(
            'tarif',
            'tarif.id_tarif = pelanggan.id_tarif'
        );

        $this->db->where(
            'penggunaan.id_pelanggan',
            $this->getIdPelanggan()
        );

        // URUTKAN BERDASARKAN ID TERBESAR AGAR DAPAT DATA PALING BARU
        $this->db->order_by('penggunaan.id_penggunaan', 'DESC');

        $this->db->limit(1);

        return $this->db->get()->result();
    }

    /*
    ============================================
    STATUS TAGIHAN BULAN TERBARU
    ============================================
    */
    public function getDataTagihanBulanan()
    {
        $this->db->select('
            penggunaan.bulan,
            penggunaan.tahun,
            tagihan.status
        ');

        $this->db->from('penggunaan');

        $this->db->join(
            'tagihan',
            'tagihan.id_penggunaan = penggunaan.id_penggunaan',
            'left'
        );

        $this->db->where(
            'penggunaan.id_pelanggan',
            $this->getIdPelanggan()
        );

        // URUTKAN BERDASARKAN ID TERBESAR AGAR DAPAT DATA PALING BARU
        $this->db->order_by('penggunaan.id_penggunaan', 'DESC');

        $this->db->limit(1);

        return $this->db->get()->result();
    }

    /*
    ============================================
    JUMLAH TAGIHAN LUNAS
    ============================================
    */
    public function getDataTagihanLunas()
    {
        $this->db->from('tagihan');

        $this->db->join(
            'penggunaan',
            'penggunaan.id_penggunaan = tagihan.id_penggunaan'
        );

        $this->db->where(
            'penggunaan.id_pelanggan',
            $this->getIdPelanggan()
        );

        $this->db->where(
            'tagihan.status',
            'Lunas'
        );

        return $this->db->get()->result();
    }

    /*
    ============================================
    JUMLAH TAGIHAN BELUM LUNAS
    ============================================
    */
    public function getDataTagihanBelumLunas()
    {
        $this->db->from('tagihan');

        $this->db->join(
            'penggunaan',
            'penggunaan.id_penggunaan = tagihan.id_penggunaan'
        );

        $this->db->where(
            'penggunaan.id_pelanggan',
            $this->getIdPelanggan()
        );

        $this->db->where(
            'tagihan.status !=',
            'Lunas'
        );

        return $this->db->get()->result();
    }

    /*
    ============================================
    TOTAL SEMUA TAGIHAN
    ============================================
    */
    public function getTotalTagihan()
    {
        $this->db->from('tagihan');

        $this->db->join(
            'penggunaan',
            'penggunaan.id_penggunaan = tagihan.id_penggunaan'
        );

        $this->db->where(
            'penggunaan.id_pelanggan',
            $this->getIdPelanggan()
        );

        return $this->db->count_all_results();
    }

}
?>