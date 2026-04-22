<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tagihan extends CI_Model {

    public function get_tarif(){
        $this->db->select('*');
        $this->db->from('tarif');
        return $this->db->get();
    }

    public function data_user($a)
    {
        return $this->db
                    ->where('id_pelanggan', $a)
                    ->join('tarif','tarif.id_tarif=pelanggan.id_tarif')
                    ->get('pelanggan')
                    ->result();
    }

    public function getDataTagihan()
    {
        $this->db->select('
                tagihan.id_tagihan,
                tagihan.bulan,
                tagihan.tahun,
                tagihan.jumlah_meter,
                tagihan.status,
                tarif.terperkwh
                ');
        $this->db->from('tagihan');
        $this->db->where('penggunaan.id_pelanggan',$this->session->userdata('id_pelanggan'));
        $this->db->join('penggunaan','penggunaan.id_penggunaan=tagihan.id_penggunaan');
        $this->db->join('pelanggan','pelanggan.id_pelanggan=penggunaan.id_pelanggan');
        $this->db->join('tarif','tarif.id_tarif=pelanggan.id_tarif');
        $this->db->order_by('id_tagihan','desc');

        return $this->db->get()->result();
    }

    public function getDataLaporanTagihan()
    {
        $this->db->select('
                tagihan.id_tagihan,
                tagihan.bulan,
                tagihan.tahun,
                tagihan.jumlah_meter,
                tagihan.status,
                tarif.terperkwh,
                penggunaan.meter_awal,
                penggunaan.meter_akhir
                ');
        $this->db->from('tagihan');
        $this->db->where('tagihan.status !=','Bukti Ditolak Silahkan Upload Lagi');
        $this->db->where('penggunaan.id_pelanggan',$this->session->userdata('id_pelanggan'));
        $this->db->join('penggunaan','penggunaan.id_penggunaan=tagihan.id_penggunaan');
        $this->db->join('pelanggan','pelanggan.id_pelanggan=penggunaan.id_pelanggan');
        $this->db->join('tarif','tarif.id_tarif=pelanggan.id_tarif');
        $this->db->order_by('id_tagihan','desc');

        return $this->db->get()->result();
    }

    public function cek_pembayaran($id_tagihan)
    {
        return $this->db
            ->where('id_tagihan',$id_tagihan)
            ->get('pembayaran')
            ->row();
    }

    // --- FUNGSI LAMA (MANUAL UPLOAD) ---
    public function update_bayar()
    {
        // Atur timezone agar akurat
        date_default_timezone_set('Asia/Jakarta');

        $cek_bayar=$this->db
            ->where('id_tagihan',$this->input->post('id_tagihan'))
            ->get('pembayaran');

        $dt_tagihan=$this->db
            ->where('id_tagihan',$this->input->post('id_tagihan'))
            ->get('tagihan')->row();

        $tarif_perkwh=$this->db->where('id_tarif',$this->session->userdata('id_tarif'))->get('tarif')->row();
        
        if($cek_bayar->num_rows()>0){
            $dt_bayar=$cek_bayar->row();
            $data=array(
                'bukti'=>$this->upload->data('file_name'),
                'status'=>'Belum Dikonfirmasi',
                'tanggal_pembayaran'=>date('Y-m-d H:i:s') // PERBAIKAN: Update waktu saat upload ulang
            );
            $this->db->where('id_pembayaran',$dt_bayar->id_pembayaran)
                     ->update('pembayaran',$data);

            $datatag=array(
                'status'=>'Belum Dikonfirmasi',
            );
            $this->db->where('id_tagihan', $this->input->post('id_tagihan'))
                     ->update('tagihan',$datatag);

            return TRUE;

        } else {
            $biaya_admin = 2500;
            $data=array(
                'id_tagihan'=>$this->input->post('id_tagihan'),
                'tanggal_pembayaran'=>date('Y-m-d H:i:s'), // PERBAIKAN: Tambah H:i:s
                'bulan_bayar'=>$dt_tagihan->bulan.' '.$dt_tagihan->tahun,
                'biaya_admin'=> $biaya_admin,
                'total_bayar'=>( $biaya_admin +($dt_tagihan->jumlah_meter*$tarif_perkwh->terperkwh)),
                'status'=>'Belum Dikonfirmasi',
                'bukti'=>$this->upload->data('file_name'),
            );
            $this->db->insert('pembayaran',$data);

            $datatag=array(
                'status'=>'Belum Dikonfirmasi',
            );
            $this->db->where('id_tagihan', $this->input->post('id_tagihan'))
                     ->update('tagihan',$datatag);

            return TRUE;
        }
    }

    // ==============================================================
    // [BARU] FUNGSI KHUSUS MIDTRANS
    // ==============================================================

    // 1. Ambil detail tagihan lengkap dengan Tarif untuk hitung harga di Controller
    public function get_detail_tagihan($id_tagihan)
    {
        $this->db->select('tagihan.*, tarif.terperkwh');
        $this->db->from('tagihan');
        $this->db->join('penggunaan', 'penggunaan.id_penggunaan = tagihan.id_penggunaan');
        $this->db->join('pelanggan', 'pelanggan.id_pelanggan = penggunaan.id_pelanggan');
        $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif');
        $this->db->where('tagihan.id_tagihan', $id_tagihan);
        return $this->db->get()->row();
    }

    // 2. Proses update database setelah pembayaran Midtrans sukses
    public function bayar_via_midtrans($id_tagihan)
    {
        // Atur timezone agar akurat
        date_default_timezone_set('Asia/Jakarta');

        // Ambil data tagihan & tarif untuk mengisi tabel pembayaran
        $info = $this->get_detail_tagihan($id_tagihan);
        $biaya_admin = 2500; 
        $total_bayar = ($info->jumlah_meter * $info->terperkwh) + $biaya_admin;

        // Cek apakah data pembayaran sudah ada (untuk menghindari duplikat jika user refresh)
        $cek = $this->db->where('id_tagihan', $id_tagihan)->get('pembayaran');

        if ($cek->num_rows() == 0) {
            // INSERT ke tabel pembayaran
            // Kolom 'bukti' kita isi string 'MIDTRANS-OTOMATIS' karena tidak ada file upload
            $data_pembayaran = array(
                'id_tagihan'        => $id_tagihan,
                'tanggal_pembayaran'=> date('Y-m-d H:i:s'), // PERBAIKAN: Tambah H:i:s
                'bulan_bayar'       => $info->bulan . ' ' . $info->tahun,
                'biaya_admin'       => $biaya_admin,
                'total_bayar'       => $total_bayar,
                'status'            => 'Lunas', // Otomatis Lunas karena payment gateway
                'bukti'             => 'MIDTRANS-OTOMATIS' 
            );
            $this->db->insert('pembayaran', $data_pembayaran);
        } else {
             // Jika entah kenapa data sudah ada tapi belum lunas, update saja (dan catat waktu lunasnya)
             $this->db->where('id_tagihan', $id_tagihan)
                      ->update('pembayaran', [
                          'status' => 'Lunas', 
                          'bukti' => 'MIDTRANS-OTOMATIS',
                          'tanggal_pembayaran' => date('Y-m-d H:i:s') // PERBAIKAN: Update waktu lunas
                      ]);
        }

        // UPDATE status di tabel tagihan
        $data_tagihan = array(
            'status' => 'Lunas'
        );
        $this->db->where('id_tagihan', $id_tagihan);
        $this->db->update('tagihan', $data_tagihan);
    }
}