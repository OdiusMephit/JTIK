<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kps extends MY_Controller
{
	protected $_roles = [
		ROLE_KPSTI,
		ROLE_KPSTMJ,
		ROLE_KPSTMD,
		ROLE_KPSTKJ,
	];
	const MAPPING_PRODI = [
		ROLE_KPSTI	=> "(1,2)",
		ROLE_KPSTMJ	=> "(3,4)",
		ROLE_KPSTMD	=> "(5,6)",
		ROLE_KPSTKJ	=> "(7,8)",
	];
	const SLUG_PRODI = [
		ROLE_KPSTI => 'TI',
		ROLE_KPSTMJ => 'TMJ',
		ROLE_KPSTMD => 'TMD',
		ROLE_KPSTKJ => 'TKJ',
	];

	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('kps/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		$data['title'] = 'Profil Saya';
		$this->view('kps/index', $data);
	}

	public function profil()
	{
		$data['title'] = 'Dashboard';
		$this->view('auth/profilsaya', $data);
	}

	public function perizinan()
	{
		$data['title'] = 'Perizinan';
		// get perizinan berdasarkan jenis kps
		$role_id = $this->session->userdata('role_id');
		$id_prodi = self::MAPPING_PRODI[$role_id];
		$data['surat'] = $this->db
			->query("SELECT
					ajukan_surat.*,
					tb_matakuliah.Nama_Matakuliah as makul,
					tb_user.nama as mahasiswa
				FROM ajukan_surat
					LEFT JOIN tb_matakuliah ON tb_matakuliah.Kode_MK = ajukan_surat.matakuliah_kode_mtk
					LEFT JOIN tb_user ON tb_user.NI = ajukan_surat.NIPNIM
					LEFT JOIN tb_mahasiswa ON tb_mahasiswa.NI = tb_user.NI
				WHERE
					tb_mahasiswa.id_prodi IN $id_prodi
				ORDER BY ajukan_surat.tanggal_matkul DESC")
			->result_array();
		$this->view('kps/perizinan', $data);
	}

	public function set_perizinan()
	{
		$id_surat = $this->input->post('id_surat');
		$data['status'] = $this->input->post('status');
		$this->load->model('Crud_m', 'crud');
		if ($this->crud->edit('ajukan_surat', $data, 'id_surat', $id_surat)) {
			$this->flash_success("Status berhasil diubah");
		} else {
			$this->flash_danger("Gagal mengubah status!");
		}
		redirect('kps/perizinan');
	}

	public function kehadiran_mahasiswa()
	{
		$role_id = $this->session->userdata('role_id');
		$id_prodi = self::MAPPING_PRODI[$role_id];
		$data['presensi'] = $this->db->query("SELECT
				presensi.*,
				tb_user.nama,
				jadwal.matakuliah_kode_mtk
			FROM
				tb_mahasiswa
				LEFT JOIN presensi ON (presensi.NI = tb_mahasiswa.NI)
				LEFT JOIN jadwal ON (presensi.kode_jadwal = jadwal.kode_jadwal)
				LEFT JOIN tb_user ON (tb_user.NI = tb_mahasiswa.NI)
			WHERE
				tb_mahasiswa.id_prodi IN $id_prodi
			ORDER BY
				presensi.waktu_presensi DESC")->result_array();
		$data['title'] = 'Presensi Mahasiswa Prodi ' . self::SLUG_PRODI[$role_id];
		$this->view('kps/kehadiran_mahasiswa', $data);
	}

	public function upload_jadwal()
	{
		$data['title'] = 'Upload Jadwal';
		$this->view('kps/upload_jadwal', $data);
	}

	public function do_upload_jadwal()
	{
		$email = $this->session->userdata('email');
		$user = $this->db->get_where('tb_user', ['email' => $email])->row_array();
		$id_user = $user['id_user'];
		if (isset($_FILES['userfile']) && is_uploaded_file($_FILES['userfile']['tmp_name'])) {
			$this->load->library('SimpleXLSX');
			$file = $_FILES['userfile']['tmp_name'];
			if ($xlsx = SimpleXLSX::parse($file)) {
				$i = 0;
				$rows = $xlsx->rows();

				$idx_start = 0;
				foreach ($rows as $i => $r) {
					if (strtolower(trim($r[0])) == 'hari') {
						$idx_start = $i + 1;
						break;
					}
				}
				$row_kelas = $rows[$idx_start];
				$kelas = [];
				foreach ($row_kelas as $i => $k) {
					if ($i < 3) {
						continue;
					}
					if (empty($k)) {
						continue;
					}
					if (in_array($k, $kelas)) {
						$this->flash_danger('Error! Ada duplikasi nama kelas: '. $k);
						return redirect('kps/upload_jadwal');
					}
					$kelas[] = $k;
				}
				// echo '<pre>'; var_dump($row_kelas); die();

				// get tahunakademik
				$tahunakademik_kode_ta = '';
				foreach ($rows[0] as $c) {
					if (strpos($c, '-') === FALSE) {
						continue;
					}
					$ta = explode(' ', $c);
					$genap = strpos(strtolower($c), 'genap') !== FALSE;
					foreach ($ta as $t) {
						if (strpos($t, '-') === FALSE) {
							continue;
						}
						$tahunakademik_kode_ta = $t;
						break;
					}
					if ($tahunakademik_kode_ta) {
						break;
					}
				}
				$tanggal_upload = date('Y-m-d H:i:s');
				$hari = '';
				$prevs = [];
				$counter_save = 0;

				// delete dulu
				$this->db->empty_table('jadwal');

				foreach ($rows as $i => $r) {
					// skip header
					if ($i <= $idx_start+1) {
						continue;
					}

					$next_hari = $r[0];
					if (!empty($next_hari) && $next_hari != $hari) {
						// echo $next_hari ."<br>"; // die();
						// if (!empty($prevs)) {
						// 	echo '<pre>'; var_dump($prevs); echo '</pre>';
						// }
						$hari = $next_hari;
					}
					// echo "{$r[2]}<br>";
					if (empty($r[2])) {
						continue;
					}
					$jam = explode('-', $r[2]);
					$jam_mulai = str_replace('.', ':', trim($jam[0])) .':00';
					$jam_selesai = str_replace('.', ':', trim($jam[1])) .':00';
					$idx_kelas = 0;
					for ($j = 3; $j < count($r); $j += 4) {
						$kelas_kode_kelas = $kelas[$idx_kelas];
						$matakuliah_kode_mtk = $r[$j];
						$pegawai_nip = $r[$j + 1];
						$ruang_kelas = $r[$j + 2];
						// cek apakah sudah di save prev
						if (isset($prevs[$kelas_kode_kelas])) {
							// jika kode & hari sama, update jam_Selesai
							if (strtolower($prevs[$kelas_kode_kelas]['matakuliah_kode_mtk']) == strtolower($matakuliah_kode_mtk)
								&& strtolower($prevs[$kelas_kode_kelas]['hari']) == strtolower($hari))
							{
								$prevs[$kelas_kode_kelas]['jam_selesai'] = $jam_selesai;
							}
							// simpan jika kode mtk tidak kosong
							else if (!empty($prevs[$kelas_kode_kelas]['matakuliah_kode_mtk']))
							{
								// echo "{$i}-'{$kelas_kode_kelas}': '{$prevs[$kelas_kode_kelas]['matakuliah_kode_mtk']}' == '{$matakuliah_kode_mtk}'
								// && '{$prevs[$kelas_kode_kelas]['hari']}' == '{$hari}'<br>";
								$counter_save++;
								// if ($counter_save >= 26) {
								// 	echo '<pre>'; var_dump($prevs[$kelas_kode_kelas]); die();
								// }
								$this->db->insert('jadwal', $prevs[$kelas_kode_kelas]);
								unset($prevs[$kelas_kode_kelas]);
							} else {
								unset($prevs[$kelas_kode_kelas]);
							}
						}

						if (!isset($prevs[$kelas_kode_kelas])) {
							$prevs[$kelas_kode_kelas] = [
								'kelas_kode_kelas' => $kelas_kode_kelas,
								'matakuliah_kode_mtk' => $matakuliah_kode_mtk,
								'pegawai_nip' => $pegawai_nip,
								'hari' => $hari,
								'jam_mulai' => $jam_mulai,
								'jam_selesai' => $jam_selesai,
								'ruang_kelas' => $ruang_kelas,
								'tahunakademik_kode_ta' => $tahunakademik_kode_ta,
								'tanggal_upload' => $tanggal_upload,
							];
						}
						$idx_kelas++;
					}
				}
				$this->flash_success('Berhasil import jadwal');
			} else {
				$this->flash_danger(SimpleXLSX::parseError());
			}
		}
		// die('woi');
		redirect('kps/upload_jadwal');
	}
}
