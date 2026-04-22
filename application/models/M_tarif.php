<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_tarif extends CI_Model {

  public function getDataTarif(){
      $this->db->select('*');
      $this->db->from('tarif');
      return $this->db->get()->result();
  }

  public function tambah_tarif(){
      $nama_tarif = $this->input->post('nama_tarif');
      $daya       = $this->input->post('daya');
      $terperkwh  = $this->input->post('terperkwh');
      
      // Hapus variabel beban dan denda karena kolom tidak ada di DB
      $datasimpan = array(
          'nama_tarif' => $nama_tarif,
          'daya'       => $daya,
          'terperkwh'  => $terperkwh,
          'status'     => "Aktif"
      );
      
      $this->db->insert('tarif', $datasimpan);
      return ($this->db->affected_rows() > 0) ? TRUE : FALSE;
  }

  public function data_tarif($a)
  {
      return $this->db
                  ->where('id_tarif', $a)
                  ->get('tarif')
                  ->row();
  }

  public function hapus_tarif(){
      $this->db->where('id_tarif', $this->input->post('id_tarif'));
      return $this->db->delete('tarif');
  }

  public function aktif_tarif(){
      $data = array(
          'status' => "Aktif"
      );
      return $this->db->where('id_tarif', $this->input->post('id_tarif'))
                      ->update('tarif', $data);
  }

  public function nonaktif_tarif(){
      $data = array(
          'status' => "Non Aktif"
      );
      return $this->db->where('id_tarif', $this->input->post('id_tarif'))
                      ->update('tarif', $data);
  }

  public function edit_tarif()
  {
      // PERBAIKAN: Kolom 'beban' dan 'denda' dihapus agar tidak error 1054
      $data = array(
          'nama_tarif' => $this->input->post('nama_tarif'),
          'daya'       => $this->input->post('daya'),
          'terperkwh'  => $this->input->post('terperkwh')
      );

      return $this->db->where('id_tarif', $this->input->post('id_tarif'))
                      ->update('tarif', $data);
  }

}