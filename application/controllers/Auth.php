<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller 
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	protected function check_login()
	{
		$user['role_id'] = $this->session->userdata('role_id') ?: 0;
		$user['role_id'] = intval($user['role_id']);
		if($user['role_id'] == 1)
		{
			redirect('superadmin');
		}
		elseif($user['role_id'] == 2)
		{
			redirect('admin');
		}
		elseif($user['role_id'] == 3)
		{
			redirect('kajur');
		}
		elseif($user['role_id'] == 4)
		{
			redirect('sekjur');
		}
		elseif($user['role_id'] == 5)
		{
			redirect('kps');
		}
		elseif($user['role_id'] == 6)
		{
			redirect('kps');
		}
		elseif($user['role_id'] == 7)
		{
			redirect('kps');
		}
		elseif($user['role_id'] == 8)
		{
			redirect('kps');
		}
		elseif($user['role_id'] == 9)
		{
			redirect('dosen');
		}
		elseif($user['role_id'] == 10)
		{
			redirect('mahasiswa');
		}
	}

	public function index()
	{
		$this->check_login();
		$this->form_validation->set_rules('email', 'Email', 'trim|valid_email');
		$this->form_validation->set_rules('password', 'Password', 'trim');

		if($this->form_validation->run() == false) 
		{
			$data['title'] = 'JTIK | Login';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/login');
			$this->load->view('templates/auth_footer');
		}
		else
		{
			//validasi sukses
			$this->_login();
			//pake _ untuk menandakan akses specifier nya private
		}
	}

	public function registrasi_mahasiswa()
	{
		$this->form_validation->set_rules('NI', 'Nomor Induk', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir_mahasiswa', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir_mahasiswa', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('alamat_mahasiswa', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('kelurahan_mahasiswa', 'Kelurahan', 'required|trim');
		$this->form_validation->set_rules('kecamatan_mahasiswa', 'Kecamatan', 'required|trim');
		$this->form_validation->set_rules('kota_mahasiswa', 'Kota', 'required|trim');
		$this->form_validation->set_rules('tlp_mahasiswa', 'Nomor Telepon', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]');
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]');
		$this->form_validation->set_rules('password', 'Ulangi Password', 'required|trim|matches[password1]');
		if($this->form_validation->run() == false) 
		{
			$data['title'] = 'JTIK | Registrasi Mahasiswa';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registrasi_mahasiswa');
			$this->load->view('templates/auth_footer');
		}
		
		else
		{
			$datamahasiswa = [
				'NI' => htmlspecialchars($this->input->post('NI', true)),
				'tempat_lahir_mahasiswa' => htmlspecialchars($this->input->post('tempat_lahir_mahasiswa', true)),
				'tanggal_lahir_mahasiswa' => htmlspecialchars($this->input->post('tanggal_lahir_mahasiswa', true)),
				'jenis_kelamin_mahasiswa' => htmlspecialchars($this->input->post('jenis_kelamin_mahasiswa', true)),
				'agama_mahasiswa' => htmlspecialchars($this->input->post('agama_mahasiswa', true)),
				'agama_ayah' => htmlspecialchars($this->input->post('agama_ayah', true)),
				'agama_ibu' => htmlspecialchars($this->input->post('agama_ibu', true)),
				'nama_ayah_mahasiswa' => htmlspecialchars($this->input->post('nama_ayah_mahasiswa', true)),
				'nama_ibu_mahasiswa' => htmlspecialchars($this->input->post('nama_ibu_mahasiswa', true)),
				'profesi_ayah' => htmlspecialchars($this->input->post('profesi_ayah', true)),
				'profesi_ibu' => htmlspecialchars($this->input->post('profesi_ibu', true)),
				'id_kelas' => htmlspecialchars($this->input->post('id_kelas', true)),
				'id_prodi' => htmlspecialchars($this->input->post('id_prodi', true)),
				'alamat_mahasiswa' => htmlspecialchars($this->input->post('alamat_mahasiswa', true)),
				'kelurahan_mahasiswa' => htmlspecialchars($this->input->post('kelurahan_mahasiswa', true)),
				'kecamatan_mahasiswa' => htmlspecialchars($this->input->post('kecamatan_mahasiswa', true)),
				'kota_mahasiswa' => htmlspecialchars($this->input->post('kota_mahasiswa', true)),
				'alamat_ayah_mahasiswa' => htmlspecialchars($this->input->post('alamat_ayah_mahasiswa', true)),
				'kelurahan_ayah_mahasiswa' => htmlspecialchars($this->input->post('kelurahan_ayah_mahasiswa', true)),
				'kecamatan_ayah_mahasiswa' => htmlspecialchars($this->input->post('kecamatan_ayah_mahasiswa', true)),
				'kota_ayah_mahasiswa' => htmlspecialchars($this->input->post('kota_ayah_mahasiswa', true)),
				'alamat_ibu_mahasiswa' => htmlspecialchars($this->input->post('alamat_ibu_mahasiswa', true)),
				'kelurahan_ibu_mahasiswa' => htmlspecialchars($this->input->post('kelurahan_ibu_mahasiswa', true)),
				'kecamatan_ibu_mahasiswa' => htmlspecialchars($this->input->post('kecamatan_ibu_mahasiswa', true)),
				'kota_ibu_mahasiswa' => htmlspecialchars($this->input->post('kota_ibu_mahasiswa', true)),
				'tlp_mahasiswa' => htmlspecialchars($this->input->post('tlp_mahasiswa', true)),
				'tlp_ayah' => htmlspecialchars($this->input->post('tlp_ayah', true)),
				'tlp_ibu' => htmlspecialchars($this->input->post('tlp_ibu', true))
			];

			$dataakses = [
				'NI' => htmlspecialchars($this->input->post('NI', true)),
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'status' => 1, 
				'image' => 'default.jpg'
			];

			$this->db->insert('tb_mahasiswa', $datamahasiswa);
			$this->db->insert('tb_user', $dataakses);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil registrasi! Silahkan cek email untuk aktivasi akun.</div');
			redirect('auth');
			
		}	
	}

	public function registrasi_civitas()
	{
		$this->form_validation->set_rules('NI', 'Nomor Induk', 'required|trim');
		$this->form_validation->set_rules('nama', 'Nama', 'required|trim');
		$this->form_validation->set_rules('tempat_lahir_civitas', 'Tempat Lahir', 'required|trim');
		$this->form_validation->set_rules('tanggal_lahir_civitas', 'Tanggal Lahir', 'required|trim');
		$this->form_validation->set_rules('jenis_kelamin_civitas', 'Jenis Kelamin', 'required|trim');
		$this->form_validation->set_rules('alamat_civitas', 'Alamat', 'required|trim');
		$this->form_validation->set_rules('kelurahan_civitas', 'Kelurahan', 'required|trim');
		$this->form_validation->set_rules('kecamatan_civitas', 'Kecamatan', 'required|trim');
		$this->form_validation->set_rules('agama', 'Agama', 'required|trim');
		$this->form_validation->set_rules('kota_civitas', 'Kota', 'required|trim');
		$this->form_validation->set_rules('tlp_civitas', 'Nomor Telepon', 'required|trim');
		$this->form_validation->set_rules('email', 'Email', 'required|trim|valid_email|is_unique[tb_user.email]', [
			'is_unique' => 'Email sudah ada!'
		]);
		$this->form_validation->set_rules('password1', 'Password', 'required|trim|min_length[6]|matches[password2]', [
			'matches' => 'Password tidak sama!',
			'min_length' => 'Password terlalu pendek!'
		]);
		$this->form_validation->set_rules('password2', 'Ulangi Password', 'required|trim|matches[password1]');
		if($this->form_validation->run() == false) 
		{
			$data['title'] = 'JTIK | Registrasi Civitas';
			$this->load->view('templates/auth_header', $data);
			$this->load->view('auth/registrasi_civitas');
			$this->load->view('templates/auth_footer');
		}
		else
		{
			$datacivitas = [
				'NI' => htmlspecialchars($this->input->post('NI', true)),
				'tempat_lahir_civitas' => htmlspecialchars($this->input->post('tempat_lahir_civitas', true)),
				'tanggal_lahir_civitas' => htmlspecialchars($this->input->post('tanggal_lahir_civitas', true)),
				'jenis_kelamin_civitas' => htmlspecialchars($this->input->post('jenis_kelamin_civitas', true)),
				'agama' => htmlspecialchars($this->input->post('agama', true)),'alamat_civitas' => htmlspecialchars($this->input->post('alamat_civitas', true)),
				'kelurahan_civitas' => htmlspecialchars($this->input->post('kelurahan_civitas', true)),
				'kecamatan_civitas' => htmlspecialchars($this->input->post('kecamatan_civitas', true)),
				'kota_civitas' => htmlspecialchars($this->input->post('kota_civitas', true)),
				'tlp_civitas' => htmlspecialchars($this->input->post('tlp_civitas', true))
			];

			$dataakses = [
				'NI' => htmlspecialchars($this->input->post('NI', true)),
				'nama' => htmlspecialchars($this->input->post('nama', true)),
				'email' => htmlspecialchars($this->input->post('email', true)),
				'password' => password_hash($this->input->post('password1'), PASSWORD_DEFAULT),
				'role_id' => htmlspecialchars($this->input->post('role_id', true)),
				'status' => 1, 
				'image'  => 'default.jpg'
			];

			$this->db->insert('tb_civitas', $datacivitas);
			$this->db->insert('tb_user', $dataakses);
			$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil registrasi! Silahkan cek email untuk aktivasi akun.</div');
			redirect('auth');
			
		}	
	}

	private function _login()
	{
		$email = $this->input->post('email');
		$password = $this->input->post('password');

		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();

		//user ada
		if($user){
			//jika user aktif
			if($user['status'] == 1)
			{
				//cek password
				if(password_verify($password, $user['password']))
				{
					$data = [
						'email' => $user['email'],
						'role_id' => $user['role_id'],
						'NI' => $user['NI'],
						'nama' => $user['nama'],
					];

					$this->session->set_userdata($data);

					//cek role
					$this->user_log();

					if($user['role_id'] == 1)
					{
						redirect('superadmin');
					}
					if($user['role_id'] == 2)
					{
						redirect('admin');
					}
					if($user['role_id'] == 3)
					{
						redirect('kajur');
					}
					if($user['role_id'] == 4)
					{
						redirect('sekjur');
					}
					if($user['role_id'] == 5)
					{
						redirect('kps');
					}
					if($user['role_id'] == 6)
					{
						redirect('kps');
					}
					if($user['role_id'] == 7)
					{
						redirect('kps');
					}
					if($user['role_id'] == 8)
					{
						redirect('kps');
					}
					if($user['role_id'] == 9)
					{
						redirect('dosen');
					}
					elseif($user['role_id'] == 10)
					{
						redirect('mahasiswa');
					}
					
				}
				else
				{
					//password salah
					$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Password tidak sesuai!</div');
					redirect('auth');
				}
			}
			else
			{
				//jika tdk aktif
				$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email ini belum diaktivasi!</div');
				redirect('auth');
			}
		}
		else
		{
			//tidak ada
			$this->session->set_flashdata('message', '<div class="alert alert-danger" role="alert">Email belum terdaftar!</div');
			redirect('auth');
		}

	}

	public function user_log()
    {
        date_default_timezone_set('Asia/Jakarta'); //set timezone

        $data = [
            'email' => $this->input->post('email', true),
            'waktu' => date('Y-m-d H:i:s')
        ];
        
        $this->db->insert('user_log', $data);
	}

	public function logout()
	{
		$this->session->unset_userdata('email');
		$this->session->unset_userdata('role_id');
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Anda telah keluar dari sistem!</div');
		redirect('auth');
	}

	public function profilsaya()
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        if ($this->session->userdata['role_id'] == 1)
		{
			redirect('superadmin/profil');
		}
		if($this->session->userdata['role_id'] == 2)
		{
			redirect('admin/profil');
		}
		if($this->session->userdata['role_id'] == 3)
		{
			redirect('kajur/profil');
		}
		if($this->session->userdata['role_id'] == 4)
		{
			redirect('sekjur/profil');
		}
		if($this->session->userdata['role_id'] == 5)
		{
			redirect('kps/profil');
		}
		if($this->session->userdata['role_id'] == 6)
		{
			redirect('kps/profil');
		}
		if($this->session->userdata['role_id'] == 7)
		{
			redirect('kps/profil');
		}
		if($this->session->userdata['role_id'] == 8)
		{
			redirect('kps/profil');
		}
		if($this->session->userdata['role_id'] == 9)
		{
			redirect('dosen/profil');
		}
		elseif($this->session->userdata['role_id'] == 10)
		{
			redirect('mahasiswa/profil');
		}
		
	}

}