<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Dosen extends MY_Controller
{
	protected $_roles = [ROLE_DOSEN];
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('dosen/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		$data['title'] = 'Profil Saya';
		$this->view('dosen/index', $data);
	}

	public function profil()
	{
		$data['title'] = 'Dashboard';
		$this->view('auth/profilsaya', $data);
	}
}
