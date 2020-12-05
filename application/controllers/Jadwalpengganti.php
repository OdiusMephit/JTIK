<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Jadwalpengganti extends MY_Controller 
{
	private $_table = 'kelas_pengganti';
    private $_pk = 'id_pengganti';

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Perkuliahan Pengganti';
		// $this->load->load('user/index');
        if ($this->session->userdata['role_id'] == 1) {
            $data['title'] = 'SuperAdmin';
            $this->template->load('superadmin/index', 'perkuliahan/datapengganti', $data);
        }
        if ($this->session->userdata['role_id'] == 3) {
            $data['title'] = 'Kajur';
            $this->template->load('kajur/index', 'perkuliahan/datapengganti', $data);
        }
        if ($this->session->userdata['role_id'] == 4) {
            $data['title'] = 'Sekjur';
            $this->template->load('sekjur/index', 'perkuliahan/datapengganti', $data);
        }
        if ($this->session->userdata['role_id'] == 5) {
        	$data['title'] = 'KPS TI';
            $this->template->load('kps/index', 'perkuliahan/datapengganti', $data);
        }
        if ($this->session->userdata['role_id'] == 6) {
        	$data['title'] = 'KPS TMD';
            $this->template->load('kps/index', 'perkuliahan/datapengganti', $data);
        }
        if ($this->session->userdata['role_id'] == 7) {
        	$data['title'] = 'KPS TMJ';
            $this->template->load('kps/index', 'perkuliahan/datapengganti', $data);
        }
        if ($this->session->userdata['role_id'] == 8) {
        	$data['title'] = 'KPS TKJ';
            $this->template->load('kps/index', 'perkuliahan/datapengganti', $data);
        }
        if ($this->session->userdata['role_id'] == 9) {
        	$data['title'] = 'Dosen';
            $this->load->view('templates/header', $data);
            $this->load->view('dosen/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('perkuliahan/datapengganti', $data);
            $this->load->view('templates/footer', $data);
        }
        if ($this->session->userdata['role_id'] == 10) {
            $data['title'] = 'Mahasiswa';
            $this->load->view('templates/header', $data);
            $this->load->view('mahasiswa/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('perkuliahan/datapengganti', $data);
            $this->load->view('templates/footer', $data);
        }

        //administrasi filter
        elseif ($this->session->userdata['role_id'] == 2) {
            $data['title'] = 'Admin';
            $this->template->load('admin/index', 'perkuliahan/datapengganti', $data);
        }
	}

	public function load_table() {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Riwayat Perkuliahan Pengganti';
        $data['list'] = $this->Crud_m->tampil_status_setuju();
        $this->load->view('templates/header', $data);
        $this->load->view('dosen/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('perkuliahan/kelaspenggantitable', $data);
        $this->load->view('templates/footer');
    }
    public function add() {
        $data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Ajukan Perkuliahan Pengganti';
        $this->load->view('templates/header', $data);
        $this->load->view('dosen/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('perkuliahan/pengajuankelaspengganti', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit() {
        $id = $this->input->post('id');
        $this->add($id);
    }
    
    public function save()
    {
        $this->form_validation->set_rules('hari', 'hari', 'required|trim|max_length[15]');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required|trim|max_length[15]');
        $this->form_validation->set_rules('kelas_kode_kelas', 'Kelas', 'required|trim');
        $this->form_validation->set_rules('matakuliah_kode_mtk', 'Bagian', 'required|trim');
        $this->form_validation->set_rules('jam_mulai', 'Tempat Lahir', 'required|trim');
        $this->form_validation->set_rules('jam_selesai', 'Tanggal Lahir', 'required|trim');
        $this->form_validation->set_rules('ruang_kelas', 'Jenis Kelamin', 'required|trim');

        $hari                 = $this->input->post('hari');
        $tanggal              = $this->input->post('tanggal');
        $kelas_kode_kelas     = $this->input->post('kelas_kode_kelas');
        $matakuliah_kode_mtk  = $this->input->post('matakuliah_kode_mtk');
        $jam_mulai            = $this->input->post('jam_mulai');
        $jam_selesai          = $this->input->post('jam_selesai');
        $ruang_kelas          = $this->input->post('ruang_kelas');
        $Dibuat_Oleh          = $this->input->post('Dibuat_Oleh');
        $status               = $this->input->post('status');


        $data = array(
            'hari'                =>  $hari,
            'tanggal'             =>  $tanggal,
            'kelas_kode_kelas'    =>  $kelas_kode_kelas,
            'matakuliah_kode_mtk' =>  $matakuliah_kode_mtk,
            'jam_mulai'           =>  $jam_mulai,
            'jam_selesai'         =>  $jam_selesai,
            'ruang_kelas'         =>  $ruang_kelas,
            'Dibuat_Oleh'         =>  $Dibuat_Oleh,
            'status'              =>  $status
        );

        $this->db->insert('kelas_pengganti', $data);
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil mengajukan kelas pengganti!</div>');

        redirect('JadwalPengganti');
    }

    public function delete() {
        $id = $this->input->post('id');
        $delete = $this->Crud_m->delete($this->_table, $this->_pk, $id);
        if ($delete) {
            $message = array(TRUE, 'Berhasil', 'Data Berhasil Dihapus !');
        }
        else {
            $message = array(FALSE, 'Gagal', 'Data Gagal Dihapus !');
        }
        echo json_encode($message);
    }
}