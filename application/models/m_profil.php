<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_profil extends CI_Model {

    public function get_profil_saya()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        
        // Pastikan mengambil kolom foto_profil dan data tarif
        $this->db->select('pelanggan.*, tarif.daya, tarif.terperkwh'); 
        $this->db->from('pelanggan');
        $this->db->join('tarif', 'tarif.id_tarif = pelanggan.id_tarif', 'left');
        $this->db->where('id_pelanggan', $id_pelanggan);
        
        return $this->db->get()->row();
    }

    public function update_profil()
    {
        $id_pelanggan = $this->session->userdata('id_pelanggan');
        
        // 1. Data Standar
        $data = [
            'nama_pelanggan' => $this->input->post('nama_pelanggan'),
            'username'       => $this->input->post('username'),
            'alamat'         => $this->input->post('alamat')
        ];

        // 2. LOGIKA PASSWORD (PENTING: Gunakan Crypt 'garam')
        // Agar sesuai dengan Controller Login Anda, password harus dienkripsi.
        $password_baru = $this->input->post('password');
        if(!empty($password_baru)) {
            $data['password'] = crypt($password_baru, 'garam'); 
        }

        // 3. LOGIKA UPLOAD FOTO
        $foto_baru_name = NULL;

        if (!empty($_FILES['foto_profil']['name'])) {
            
            // Pastikan folder assets/img/profil/ sudah dibuat!
            $config['upload_path']   = './assets/img/profil/';
            $config['allowed_types'] = 'jpg|jpeg|png'; 
            $config['max_size']      = 2048; // 2MB
            $config['file_name']     = 'profil-' . $id_pelanggan . '-' . date('YmdHis');
            $config['overwrite']     = true;

            $this->load->library('upload', $config);

            if ($this->upload->do_upload('foto_profil')) {
                $upload_data = $this->upload->data();
                $data['foto_profil'] = $upload_data['file_name'];
                $foto_baru_name = $upload_data['file_name'];
                
                // Hapus foto lama untuk hemat storage
                $foto_lama = $this->db->get_where('pelanggan', ['id_pelanggan'=>$id_pelanggan])->row()->foto_profil;
                if($foto_lama && file_exists('./assets/img/profil/'.$foto_lama)){
                    unlink('./assets/img/profil/'.$foto_lama);
                }
            }
        }

        $this->db->where('id_pelanggan', $id_pelanggan);
        $this->db->update('pelanggan', $data);
        
        // Kembalikan nama foto baru (jika ada) untuk update session
        return $foto_baru_name; 
    }
}