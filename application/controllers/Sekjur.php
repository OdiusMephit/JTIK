<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sekjur extends MY_Controller 
{
	protected $_roles = [ROLE_SEKJUR];
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('sekjur/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		
            $data['title'] = 'Profil Saya';
            $this->load->view('templates/header', $data);
            $this->load->view('sekjur/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('sekjur/index', $data);
            $this->load->view('templates/footer', $data);
	}

	public function profil()
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
        $data['title'] = 'Dashboard';
        $this->load->view('templates/header', $data);
        $this->load->view('sekjur/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('auth/profilsaya', $data);
        $this->load->view('templates/footer', $data);
	}

	public function presensi()
	{
		$data['title'] = 'Presensi Harian';
		$data['tgl'] = $this->input->get('tgl') ?: date('Y-m-d');
		$start = $data['tgl'] .' 00:00:00';
		$end = $data['tgl'] .' 23:59:59';
		// cek apakah prelu rekap
		$rekap = $this->input->get('rekap') ?: 0;
		if ($rekap == 1) {
			// get jadwal hari ini
			$idx_hari = date('w', strtotime($data['tgl']));
			switch ($idx_hari) {
				case 1: $hari = 'SENIN';	break;
				case 2: $hari = 'SELASA';	break;
				case 3: $hari = 'RABU';		break;
				case 4: $hari = 'KAMIS';	break;
				case 5: $hari = 'JUMAT';	break;
				case 6: $hari = 'SABTU';	break;
				case 0:
				default:
					$hari = 'MINGGU';		break;
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
				$waktu_mulai_seharusnya = $data['tgl'] .' '. $j['jam_mulai'];
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
				if ($perkuliahan['alfa'] == 0)
				{
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
			redirect('admin/presensi?tgl='. $data['tgl']);
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
}