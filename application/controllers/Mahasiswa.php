<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mahasiswa extends MY_Controller
{
	protected $_roles = [ROLE_MAHASISWA];
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('mahasiswa/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		$data['title'] = 'Profil Saya';
		$this->view('mahasiswa/index', $data);
	}

	public function profil()
	{
		$data['title'] = 'Dashboard';
		$this->view('auth/profilsaya', $data);
	}

	public function perizinan()
	{
		$data['title'] = 'Perizinan';
		$nim = $this->session->userdata('NI');
		$data['nim'] = $nim;
		// get semua perizinan miliknya menggunakan nim
		$data['surat'] = $this->db
			->query("SELECT
					ajukan_surat.*,
					tb_matakuliah.Nama_Matakuliah as makul
				FROM ajukan_surat
					LEFT JOIN tb_matakuliah ON tb_matakuliah.Kode_MK = ajukan_surat.matakuliah_kode_mtk
				WHERE ajukan_surat.NIPNIM = '$nim'
				ORDER BY ajukan_surat.tanggal_matkul DESC")
			->result_array();
		// get semua mata kuliah
		$data['makul'] = $this->db
			->order_by('Nama_Matakuliah')
			->get('tb_matakuliah')
			->result_array();
		$this->view('mahasiswa/perizinan', $data);
	}

	public function add_perizinan()
	{
		if (empty($this->input->post())) {
			redirect('mahasiswa/perizinan');
			return;
		}
		// upload file & masukkan ke post_data
		$config['upload_path']          = './uploads/surat/';
		$config['allowed_types']        = [
			'doc','docx','pdf',
			'jpg','jpeg','png',
		];
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('userfile')) {
			$this->flash_danger('Gagal upload lampiran');
			redirect('mahasiswa/perizinan');
			return;
		}
		$data = $this->upload->data();
		$filename = $data['file_name'];
		$post_data = $this->input->post();
		$post_data['file'] = $filename;
		// input surat
		$this->load->model('Crud_m', 'crud');
		if ($this->crud->add('ajukan_surat', $post_data)) {
			$this->flash_success('Surat izin berhasil ditambahkan');
		} else {
			$this->flash_danger('Gagal menambahkan surat izin');
		}
		redirect('mahasiswa/perizinan');
	}

	public function presensi()
	{
		// cek jika ada post == presensi qr
		$post_data = $this->input->post();
		if (!empty($post_data)) {
			// get qr yang ada di db
			$qr_code = $post_data['qr'];
			$perkuliahan = $this->db->get_where('perkuliahan', [
				'qr' => $qr_code
			])->row_array();
			if ($perkuliahan) {
				// get detail jadwal
				$jadwal = $this->db->get_where('jadwal', [
					'kode_jadwal' => $perkuliahan['kode_jadwal']
				])->row_array();
				$kelas_jadwal = $this->db->get_where('tb_kelas', ['Nama_Kelas' => $jadwal['kelas_kode_kelas']])->row_array();
				// get kelas mhs
				$NI = $this->session->userdata('NI');
				$mahasiswa = $this->db->get_where('tb_mahasiswa', ['NI' => $NI])->row_array();
				if (!$mahasiswa || !$kelas_jadwal || $mahasiswa['id_kelas'] != $kelas_jadwal['id'])
				{
					$message = 'Maaf Anda tidak bisa melakukan presensi di kelas ini';
				}
				else
				{
					// cek apakah sdh presensi di db
					$presensi = $this->db->get_where('presensi', [
						'id_perkuliahan' => $perkuliahan['id'],
						'NI' => $NI,
					])->row_array();
					if ($presensi) {
						// jika sudah presensi berarti set presensi pulang
						// $message = 'Anda sudah presensi untuk Mata Kuliah "'. $jadwal['matakuliah_kode_mtk'] .'".';
						$waktu_sekarang = date('Y-m-d H:i:s');
						if ($perkuliahan['waktu_selesai'] == NULL || $perkuliahan['waktu_selesai'] > $waktu_sekarang) {
							$this->db->update('presensi', ['waktu_selesai' => $waktu_sekarang], ['id' => $presensi['id']]);
							$message = 'Berhasil melakukan presensi SELESAI untuk Mata Kuliah "'. $jadwal['matakuliah_kode_mtk'] .'".';
						} else {
							$message = 'Presensi untuk matakuliah ini sudah ditutup';
						}
					} else {
						// hitung waktu_presensi (jam sekarang) - waktu_mengajar
						$waktu_presensi = new DateTime();
						$waktu_mengajar = new DateTime($perkuliahan['waktu_mengajar']);
						$diff = $waktu_presensi->diff($waktu_mengajar);
						$telat_menit = $diff->h * 60 + $diff->m;
						// cek apakah telat > 50 menit?
						if ($telat_menit < 50) {
							$nilai_alfa = 0;
						} else {
							$nilai_alfa = intval($telat_menit / 50);
						}
						// insert to db
						$this->db->insert('presensi', [
							'id_perkuliahan' => $perkuliahan['id'],
							'kode_jadwal' => $perkuliahan['kode_jadwal'],
							'NI' => $NI,
							'waktu_presensi' => $waktu_presensi->format('Y-m-d H:i:s'),
							'telat_menit' => $telat_menit,
							'nilai_alfa' => $nilai_alfa,
							'status' => 'hadir',
						]);
						$message = 'Berhasil melakukan presensi untuk Mata Kuliah "'. $jadwal['matakuliah_kode_mtk'] .'".';
						if ($telat_menit > 0) {
							$message .= ' Anda terlambat '. $telat_menit .' menit ('. $nilai_alfa .' alfa).';
						}
					}
				}
			} else {
				$message = 'Error! QR Code tidak valid!';
			}
			echo json_encode([
				'message' => $message,
			]);
			return;
		}
		$data['title'] = 'Presensi QR Code';
		$this->view('mahasiswa/presensi', $data);
	}

	public function kehadiran()
	{
		$NI = $this->session->userdata('NI');
		$data['nim'] = $NI;
		$data['presensi'] = $this->db->query("SELECT
				presensi.*,
				jadwal.matakuliah_kode_mtk
			FROM
				presensi
				LEFT JOIN jadwal ON (jadwal.kode_jadwal = presensi.kode_jadwal)
				LEFT JOIN perkuliahan ON (perkuliahan.id = presensi.id_perkuliahan)
			WHERE
				presensi.NI = '$NI'
				AND perkuliahan.id IS NOT NULL
			ORDER BY
				presensi.waktu_presensi DESC")->result_array();
		$data['title'] = "Daftar Kehadiran";
		$this->view('mahasiswa/kehadiran', $data);
	}

	public function jadwal()
	{
		$user = $this->db->get_where('tb_mahasiswa', ['NI' => $this->session->userdata('NI')])->row_array();
		$kelas = $this->db->get_where('tb_kelas', ['id' => $user['id_kelas']])->row_array();
		$jadwal = $this->db->get_where('jadwal', ['kelas_kode_kelas' => $kelas['Nama_Kelas']])->result_array();

		$jam_mulai = $this->db->query("SELECT jam_mulai FROM jadwal GROUP BY jam_mulai ORDER BY jam_mulai")->result_array();
		$jam_selesai = $this->db->query("SELECT jam_selesai FROM jadwal GROUP BY jam_selesai ORDER BY jam_selesai")->result_array();
		$hari = $this->db->query("SELECT hari FROM jadwal GROUP BY hari ORDER BY kode_jadwal")->result_array();
		$data['jam_mulai'] = [];
		$data['jam_selesai'] = [];
		$data['hari'] = [];
		foreach ($jam_mulai as $r) { $data['jam_mulai'][] = $r['jam_mulai']; }
		foreach ($jam_selesai as $r) { $data['jam_selesai'][] = $r['jam_selesai']; }
		foreach ($hari as $r) { $data['hari'][] = $r['hari']; }

		// masukkan jadwal default NULL
		foreach ($data['jam_mulai'] as $row) {
			foreach ($data['hari'] as $col) {
				$data['jadwal'][$row][$col] = NULL;
			}
		}

		// echo '<pre>'; var_dump($data['jadwal']); die();
		// mapping jadwal by waktu_mulai & hari
		foreach ($jadwal as $j) {
			$jam_mulai = $j['jam_mulai'];
			$hari = $j['hari'];
			$data['jadwal'][$jam_mulai][$hari] = $j;
		}

		$data['title'] = 'Jadwal Kelas '. $kelas['Nama_Kelas'];
		$this->view('mahasiswa/jadwal', $data);
	}
}
