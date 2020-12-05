<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kajur extends MY_Controller
{
	protected $_roles = [ROLE_KAJUR];
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
		$this->load->model('m_grafik');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('kajur/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();

		$data['title'] = 'Profil Saya';
		$this->load->view('templates/header', $data);
		$this->load->view('kajur/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('kajur/index', $data);
		$this->load->view('templates/footer', $data);
	}

	public function profil()
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$data['title'] = 'Dashboard';
		$this->load->view('templates/header', $data);
		$this->load->view('kajur/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view('auth/profilsaya', $data);
		$this->load->view('templates/footer', $data);
	}

	public function presensi()
	{
		$data['title'] = 'Presensi Harian';
		$data['tgl'] = $this->input->get('tgl') ?: date('Y-m-d');
		$start = $data['tgl'] . ' 00:00:00';
		$end = $data['tgl'] . ' 23:59:59';
		// cek apakah prelu rekap
		$rekap = $this->input->get('rekap') ?: 0;
		if ($rekap == 1) {
			// get jadwal hari ini
			$idx_hari = date('w', strtotime($data['tgl']));
			switch ($idx_hari) {
				case 1:
					$hari = 'SENIN';
					break;
				case 2:
					$hari = 'SELASA';
					break;
				case 3:
					$hari = 'RABU';
					break;
				case 4:
					$hari = 'KAMIS';
					break;
				case 5:
					$hari = 'JUMAT';
					break;
				case 6:
					$hari = 'SABTU';
					break;
				case 0:
				default:
					$hari = 'MINGGU';
					break;
			}
			// cek apakah sudah ada perkuliahan untuk jadwal tersebut
			$jadwal = $this->db->get_where('jadwal', ['hari' => $hari])->result_array();
			$now =  date('Y-m-d H:i:s');
			foreach ($jadwal as $j) {
				$kode_jadwal = $j['kode_jadwal'];
				$perkuliahan = $this->db->where('kode_jadwal', $kode_jadwal)
					->where('waktu_mengajar >', $start)
					->where('waktu_mengajar <', $end)
					->get('perkuliahan')
					->row_array();
				$waktu_mulai_seharusnya = $data['tgl'] . ' ' . $j['jam_mulai'];
				$jam_mulai = new DateTime($j['jam_mulai']);
				$jam_selesai = new DateTime($j['jam_selesai']);
				$diff = $jam_mulai->diff($jam_selesai);
				$telat_menit = $diff->h * 60 + $diff->m;
				$nilai_alfa = intval($telat_menit / 50);
				// jika belum ada perkuliahan, set dosen punya alfa
				if (!$perkuliahan) {
					// input perkuliahan dengan tag alfa
					$this->db->insert('perkuliahan', [
						'kode_jadwal' => $kode_jadwal,
						'waktu_mengajar' => $waktu_mulai_seharusnya,
						'qr' => '',
						'alfa' => 1
					]);
					$id_perkuliahan = $this->db->insert_id();
					// input presensi dosen dengan alfa
					// get pengajar dari tb_user
					$user = $this->db->get_where('tb_user', ['nama' => $j['pegawai_nip']])->row_array();
					// iinsert presensi jika user exist
					if ($user) {
						$this->db->insert('presensi', [
							'id_perkuliahan' => $id_perkuliahan,
							'kode_jadwal' => $kode_jadwal,
							'NI' => $user['NI'],
							'waktu_presensi' => $waktu_mulai_seharusnya,
							'status' => 'alfa',
							'nilai_alfa' => $nilai_alfa,
						]);
					}
					// get lagi perkuliahan utk mahasiswa
					$perkuliahan = $this->db->get_where('perkuliahan', ['id' => $id_perkuliahan])->row_array();
				}

				// jika perkuliahan = alfa berarti tdk ada oleh dosen, mhs tidak perlu di alfa
				if ($perkuliahan['alfa'] == 0) {
					// get mahasiswa di kelas perkuliahan ini
					$kode_kelas = $j['kelas_kode_kelas'];
					$kelas = $this->db->get_where('tb_kelas', ['Nama_Kelas' => $kode_kelas])->row_array();
					$id_kelas = $kelas['id'];
					$mahasiswa = $this->db->get_where('tb_mahasiswa', ['id_kelas' => $id_kelas])->result_array();
					foreach ($mahasiswa as $m) {
						// cek apakah sdh ada presensi nya
						$presensi = $this->db->where('id_perkuliahan', $perkuliahan['id'])
							->where('NI', $m['NI'])
							->get('presensi')
							->row_array();
						// echo '<pre>'; var_dump($presensi); die();
						if (!$presensi) {
							$this->db->insert('presensi', [
								'id_perkuliahan' => $perkuliahan['id'],
								'kode_jadwal' => $kode_jadwal,
								'NI' => $m['NI'],
								'waktu_presensi' => $waktu_mulai_seharusnya,
								'status' => 'alfa',
								'nilai_alfa' => $nilai_alfa,
							]);
						}
					}
				}
			}
			redirect('admin/presensi?tgl=' . $data['tgl']);
		}
		// get presensi pengajar sesuai tgl
		$data['presensi_pengajar'] = $this->db->query("SELECT
				presensi.*,
				tb_user.nama,
				jadwal.matakuliah_kode_mtk,
				perkuliahan.materi_text,
				perkuliahan.materi_file
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
				LEFT JOIN jadwal ON (jadwal.kode_jadwal = presensi.kode_jadwal)
				LEFT JOIN perkuliahan ON (perkuliahan.id = presensi.id_perkuliahan)
			WHERE
				tb_user.role_id != 10
				AND presensi.waktu_presensi BETWEEN '$start' AND '$end'
				AND perkuliahan.id IS NOT NULL
				AND jadwal.matakuliah_kode_mtk IS NOT NULL
			ORDER BY
				tb_user.nama")->result_array();
		// get presensi mahasiswa sesuai tgl
		$data['presensi_mahasiswa'] = $this->db->query("SELECT
				presensi.*,
				tb_user.nama,
				jadwal.matakuliah_kode_mtk
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
				LEFT JOIN jadwal ON (jadwal.kode_jadwal = presensi.kode_jadwal)
				LEFT JOIN perkuliahan ON (perkuliahan.id = presensi.id_perkuliahan)
			WHERE
				tb_user.role_id = 10
				AND presensi.waktu_presensi BETWEEN '$start' AND '$end'
				AND perkuliahan.id IS NOT NULL
			ORDER BY
				tb_user.nama")->result_array();
		// echo '<pre>'; var_dump($data['presensi_mahasiswa']); die();
		$data['hide_materi'] = True;
		$data['hide_rekap'] = True;
		$this->view('admin/presensi', $data);
	}

	public function grafik()
	{
		$data['title'] = 'Grafik Kehadiran';

		$data['presensi_mahasiswa'] = $this->db->query("SELECT
				tb_mahasiswa.NI as NI,
				tb_user.nama,
				SUM(presensi.nilai_alfa) as nilai_alfa
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = tb_user.NI)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.NI
				AND presensi.waktu_presensi  
			GROUP BY
				tb_mahasiswa.NI
			ORDER BY
				presensi.waktu_presensi")->result_array();
		$data['presensi_pengajar'] = $this->db->query("SELECT
				tb_civitas.NI as NI,
				tb_user.nama,
				SUM(presensi.nilai_alfa) as nilai_alfa
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
				LEFT JOIN tb_civitas ON (tb_Civitas.NI = tb_user.NI)
			WHERE
				tb_civitas.NI IS NOT NULL
				AND tb_civitas.NI
				AND presensi.waktu_presensi  
			GROUP BY
				tb_civitas.NI
			ORDER BY
				presensi.waktu_presensi")->result_array();
		$data['data_prodi'] = $this->db->query("SELECT
				tb_prodi.id as id_prodi,
				tb_prodi.Nama_Prodi as prodi,
				SUM(presensi.nilai_alfa) as nilai_alfa
			FROM
				presensi
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = presensi.NI)
				LEFT JOIN tb_prodi ON (tb_prodi.id = tb_mahasiswa.id_prodi)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.id_prodi 
				AND presensi.waktu_presensi
			GROUP BY
				tb_prodi.id
			ORDER BY
				presensi.waktu_presensi")->result_array();
		$data['data_semester'] = $this->db->query("SELECT
				tb_mahasiswa.semester as semester,
				SUM(presensi.nilai_alfa) as nilai_alfa
			FROM
				presensi
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = presensi.NI)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.semester 
				AND presensi.waktu_presensi
			GROUP BY
				tb_mahasiswa.semester
			ORDER BY
				presensi.waktu_presensi")->result_array();
		$data['data_kelas'] = $this->db->query("SELECT
				tb_kelas.id as id_kelas,
				tb_kelas.Nama_Kelas as kelas,
				SUM(presensi.nilai_alfa) as nilai_alfa
			FROM
				presensi
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = presensi.NI)
				LEFT JOIN tb_kelas ON (tb_kelas.id = tb_mahasiswa.id_kelas)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.id_kelas 
				AND presensi.waktu_presensi
			GROUP BY
				tb_kelas.id
			ORDER BY
				presensi.waktu_presensi")->result_array();

		$this->view('kajur/chart', $data);
	}
	function grafik_kelas($id_kelas)
	{
		// $id_kelas = $this->uri->segment(3);
		$x['title'] = 'Grafik';
		$x['data'] = $this->m_grafik->get_data_kelas($id_kelas);
		// var_dump($x);
		// die();
		$this->view('kajur/grafik', $x);
	}
	function grafik_prodi($id_prodi)
	{
		// $id_prodi = $this->uri->segment(3);
		$as['title'] = 'Grafik';
		$as['data'] = $this->m_grafik->get_data_prodi($id_prodi);
		// var_dump($x);
		// die();
		$this->view('kajur/grafik', $as);
	}

	function grafik_semester($semester)
	{
		// $semester = $this->uri->segment(3);
		$ad['title'] = 'Grafik';
		$ad['data'] = $this->m_grafik->get_data_semester($semester);
		// var_dump($x);
		// die();
		$this->view('kajur/grafik', $ad);
	}

	function grafik_mahasiswa($NI)
	{
		// $NI = $this->uri->segment(3);
		$aa['title'] = 'Grafik';
		$aa['data'] = $this->m_grafik->get_data_mahasiswa($NI);
		// var_dump($x);
		// die();
		$this->view('kajur/grafik', $aa);
	}

	function grafik_pengajar($NI)
	{
		// $NI = $this->uri->segment(3);
		$aa['title'] = 'Grafik';
		$aa['data'] = $this->m_grafik->get_data_pengajar($NI);
		// var_dump($x);
		// die();
		$this->view('kajur/grafik', $aa);
	}
}
