<?php

class Options_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }
    public function options_kelas() {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $list = $this->db->get_where('jadwal', ['pegawai_nip' => $user['email']]->result_array());
        $option = array();
        $option[''] = '-- Pilih Kelas --';
        foreach ($list->result() as $row) {
            $option[$row->kelas_kode_kelas] = $row->kelas_kode_kelas;
        }
        $this->db->close();
        return $option;
    }

    public function options_matkul() {
        $list = $this->db->get_where('jadwal', ['pegawai_nip' => $this->session->userdata('email')]->result_array());
        $option = array();
        $option[''] = '-- Pilih Mata Kuliah --';
        foreach ($list->result() as $row) {
            $option[$row->matakuliah_kode_mtk] = $row->matakuliah_kode_mtk;
        }
        $this->db->close();
        return $option;
    }

    public function options_ruangkelas() {
        $list = $this->db->get('tb_ruang_kelas');
        $option = array();
        $option[''] = '-- Pilih Ruang Kelas --';
        foreach ($list->result() as $row) {
            $option[$row->Nama_Ruang_Kelas] = $row->Nama_Ruang_Kelas;
        }
        $this->db->close();
        return $option;
    }
}




