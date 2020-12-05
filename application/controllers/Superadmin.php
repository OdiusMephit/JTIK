<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Superadmin extends MY_Controller
{
	protected $_roles = [ROLE_SUPERADMIN];
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('superadmin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		$data['title'] = 'Profil Saya';
		$this->view('superadmin/index', $data);
	}

	public function profil()
	{
		$data['title'] = 'Dashboard';
		$this->view('auth/profilsaya', $data);
	}

	public function role_user()
	{
		$data['title'] = 'Role User';
		//get user selain superadmin
		$data['users_pengajar'] = $this->db->get_where('tb_user', [
			'role_id !=' => ROLE_SUPERADMIN,
			'role_id !=' => ROLE_ADMIN,
			'role_id !=' => ROLE_MAHASISWA,
		])->result_array();
		$data['users_mahasiswa'] = $this->db->get_where('tb_user', [
			'role_id =' => ROLE_MAHASISWA,
		])->result_array();
		//set role sbg string, misal 2 = Admin
		foreach ($data['users_pengajar'] as &$user) {
			switch ($user['role_id']) {
				case ROLE_SUPERADMIN:	$user['role'] = 'Superadmin'; break;
				case ROLE_ADMIN:		$user['role'] = 'Admin'; break;
				case ROLE_KAJUR:		$user['role'] = 'Kajur'; break;
				case ROLE_SEKJUR:		$user['role'] = 'Sekjur'; break;
				case ROLE_KPSTI:		$user['role'] = 'KPSTI'; break;
				case ROLE_KPSTMD:		$user['role'] = 'KPSTMD'; break;
				case ROLE_KPSTMJ:		$user['role'] = 'KPSTMJ'; break;
				case ROLE_KPSTKJ:		$user['role'] = 'KPSTKJ'; break;
				case ROLE_DOSEN:		$user['role'] = 'Dosen'; break;
				case ROLE_MAHASISWA:	$user['role'] = 'Mahasiswa'; break;
				default:				$user['role'] = '(unknown)'; break;
			}
		}
		//get roles
		$data['roles'] = $this->db->get_where('tb_role', [
			'id !=' => ROLE_SUPERADMIN 
		])->result_array();
		$this->view('superadmin/role_user', $data);
	}

	public function set_role_user()
	{
		if (empty($this->input->post())) {
			redirect('superadmin/role_user');
			return;
		}
		$this->load->model('Crud_m', 'crud');
		$max_role1 = [
			ROLE_KAJUR,
			ROLE_SEKJUR,
			ROLE_KPSTI,
			ROLE_KPSTMD,
			ROLE_KPSTMJ,
			ROLE_KPSTKJ,
		];
		// cek apakah max 1 role
		$id_user = $this->input->post('id_user');
		$role_id = $this->input->post('role_id');
		if (in_array($role_id, $max_role1)) {
			$existing = $this->crud->get('tb_user', '*', "role_id=$role_id", 10);
			if (!empty($existing)) {
				$valid = false;
				// cek apakah id_user sama? jika sama berarti aman
				foreach ($existing as $user) {
					if ($user['id_user'] == $id_user) {
						$valid = true;
						break;
					}
				}
				if (!$valid) {
					$this->flash_danger("Role ini hanya boleh ada 1!");
					redirect('superadmin/role_user');
					return;
				}
			}
		}
		$result = $this->crud->edit(
			'tb_user', ['role_id' => $this->input->post('role_id')],
			'id_user', $this->input->post('id_user'));
		if ($result) {
			$this->flash_success('Role berhasil disimpan');
		} else {
			$this->flash_danger('Gagal menyimpan role');
		}
		redirect('superadmin/role_user');
	}

	public function set_status_user()
	{
		if (empty($this->input->post())) {
			redirect('superadmin/role_user');
			return;
		}
		$this->load->model('Crud_m', 'crud');
		$result = $this->crud->edit(
			'tb_user', ['status' => $this->input->post('status')],
			'id_user', $this->input->post('id_user'));
		if ($result) {
			$this->flash_success('Status berhasil disimpan');
		} else {
			$this->flash_danger('Gagal menyimpan status');
		}
		redirect('superadmin/role_user');
	}
}
