<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends MY_Controller
{
	protected $_roles = [ROLE_ADMIN];
	public function __construct()
	{
		parent::__construct();
		$this->load->library('form_validation');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$this->load->view('templates/header', $data);
		$this->load->view('admin/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	public function index()
	{
		$data['jml_kelas']   = $this->db->get('tb_kelas')->num_rows();
		$data['jml_ruangkelas']   = $this->db->get('tb_ruang_kelas')->num_rows();
		$data['jml_matkul']   = $this->db->get('tb_matakuliah')->num_rows();
		$data['jml_user']   = $this->db->get('tb_user')->num_rows();
		$data['user_log']  = $this->Crud_m->get_user_log();

		$data['title'] = 'Dashboard';
		$this->view('admin/index', $data);
	}

	public function profil()
	{
		$data['title'] = 'Dashboard';
		$this->view('auth/profilsaya', $data);
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
		$data['hide_materi'] = False;
		$data['hide_rekap'] = False;
		// get daftar kelas utk di export
		$data['kelas'] = $this->db->order_by('Nama_Kelas')->get('tb_kelas')->result_array();
		$this->view('admin/presensi', $data);
	}

	public function perizinan()
	{
		$data['title'] = 'Perizinan';
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
					ajukan_surat.status = 1
					OR ajukan_surat.status = 2
				ORDER BY ajukan_surat.tanggal_matkul DESC")
			->result_array();
		$this->view('admin/perizinan', $data);
	}

	public function set_perizinan()
	{
		$data_post = $this->input->post();
		// cek apakah izin ada di db
		$izin = $this->db->get_where('ajukan_surat', [
			'id_surat' => $data_post['id_surat']
		])->row_array();
		if (!$izin) {
			$this->flash_danger('Error! Surat perizinan tidak ditemukan');
			return redirect('admin/perizinan');
		}
		// get jadwal dari tanggal_matkul dan kode_mtk dan kode kelas
		$idx_hari = date('w', strtotime($izin['tanggal_matkul']));
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
		$NI = $izin['NIPNIM'];
		$kelas = $this->db->query("SELECT
				tb_kelas.*
			FROM
				tb_kelas
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.id_kelas = tb_kelas.id)
			WHERE
				tb_mahasiswa.NI = '$NI'")->row_array();
		$jadwal = $this->db->get_where('jadwal', [
			'hari' => $hari,
			'matakuliah_kode_mtk' => $izin['matakuliah_kode_mtk'],
			'kelas_kode_kelas' => $kelas['Nama_Kelas']
		])->row_array();
		if (!$jadwal) {
			$this->flash_danger('Error! Matakuliah tidak ditemukan untuk surat izin ini. Silahkan cek jadwal dari tanggal surat izin & mata kuliahnya.');
			return redirect('admin/perizinan');
		}
		// get presensi dari jadwal & mahasiswa, dan max_date (jam 24:00 hari itu)
		$start = date('Y-m-d 00:00:00', strtotime($izin['tanggal_matkul']));
		$end = date('Y-m-d 23:59:59', strtotime($izin['tanggal_matkul']));
		$presensi = $this->db->get_where('presensi', [
			'kode_jadwal' => $jadwal['kode_jadwal'],
			'NI' => $izin['NIPNIM'],
			'waktu_presensi >' => $start,
			'waktu_presensi <' => $end,
		])->row_array();
		if (!$presensi) {
			$this->flash_danger('Error! Belum ada presensi untuk mahasiswa ini. Silahkan lakukan rekap tanggal "<b>' . date('d M Y', strtotime($izin['tanggal_matkul'])) . '</b>" terlebih dahulu');
			return redirect('admin/perizinan');
		}
		// ubah nilai_alfa jadi 0 jika status izin / sakit
		$data_presensi['status'] = $data_post['presensi'];
		if ($data_presensi['status'] == 'izin' || $data_presensi['status'] == 'sakit') {
			$data_presensi['nilai_alfa'] = 0;
		}
		// update ajukan_surat & presensi
		$this->db->update('ajukan_surat', $data_post, ['id_surat' => $data_post['id_surat']]);
		$this->db->update('presensi', $data_presensi, ['id' => $presensi['id']]);
		$this->flash_success('Berhasil mengubah status surat izin');
		redirect('admin/perizinan');
	}

	public function export_mahasiswa()
	{
		$id_kelas = $this->input->get('id_kelas');
		$kelas = $this->db->get_where('tb_kelas', ['id' => $id_kelas])->row_array();
		if (!$kelas) {
			$this->flash_danger('Kelas tidak ditemukan!');
			return redirect('admin/presensi');
		}
		// get from & to dari input, default hari ini
		$from = $this->input->get('from') ?: date('Y-m-d');
		$to = $this->input->get('to') ?: date('Y-m-d');
		// set filename
		$filename = "{$kelas['Nama_Kelas']}_{$from}_{$to}";
		$title = "Rekapitulasi Kompensasi " . date('d M Y', strtotime($from)) . " - " . date('d M Y', strtotime($to));
		// tambahkan jam 00:00 dari from, tambahkan jam 23:59 dari to
		$from .= ' 00:00:00';
		$to .= ' 23:59:59';
		// get presensi mahasiswa
		$data['presensi'] = $this->db->query("SELECT
				presensi.NI,
				tb_user.nama,
				tb_kelas.Nama_Kelas as kelas,
				tb_prodi.Nama_Prodi as prodi,
				SUM(presensi.nilai_alfa) as nilai_alfa
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = tb_user.NI)
				LEFT JOIN tb_kelas ON (tb_kelas.id = tb_mahasiswa.id_kelas)
				LEFT JOIN tb_prodi ON (tb_prodi.id = tb_mahasiswa.id_prodi)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.id_kelas = {$id_kelas}
				AND presensi.waktu_presensi BETWEEN '{$from}' AND '{$to}'
			GROUP BY
				presensi.NI
			ORDER BY
				presensi.waktu_presensi")->result_array();
		// get total status
		foreach ($data['presensi'] as &$p) {
			$p['sakit'] = $this->db->where('NI', $p['NI'])
				->where('waktu_presensi >=', $from)
				->where('waktu_presensi <=', $to)
				->where('status', 'sakit')
				->from('presensi')
				->count_all_results();
			$p['izin'] = $this->db->where('NI', $p['NI'])
				->where('waktu_presensi >=', $from)
				->where('waktu_presensi <=', $to)
				->where('status', 'izin')
				->from('presensi')
				->count_all_results();
			$p['alfa'] = $this->db->where('NI', $p['NI'])
				->where('waktu_presensi >=', $from)
				->where('waktu_presensi <=', $to)
				->where('status', 'alfa')
				->from('presensi')
				->count_all_results();
		}
		// get type export
		$type = $this->input->get('type') ?: 'xlsx';
		if ($type == 'xlsx') {
			$this->export_mahasiswa_xlsx($data['presensi'], $filename, $title);
		} else if ($type == 'pdf') {
			$this->export_mahasiswa_pdf($data['presensi'], $filename, $title);
		} else {
			$this->flash_danger('Tipe export tidak didukung!');
			return redirect('admin/presensi');
		}
		// echo '<pre>'; var_dump($type); die();
	}
	private function export_mahasiswa_xlsx($presensi, $filename, $title)
	{
		$this->load->library('PHPExcel');
		$filename .= ".xlsx";
		$excel = new PHPExcel();
		$excel->setActiveSheetIndex();

		// set title
		$excel->getActiveSheet()->setCellValue('A1', $title);

		// set header
		$excel->getActiveSheet()->setCellValue('A3', "No");
		$excel->getActiveSheet()->setCellValue('B3', "NIM");
		$excel->getActiveSheet()->setCellValue('C3', "Nama Lengkap");
		$excel->getActiveSheet()->setCellValue('D3', "Kelas");
		$excel->getActiveSheet()->setCellValue('E3', "Prodi");
		$excel->getActiveSheet()->setCellValue('F3', "Sakit");
		$excel->getActiveSheet()->setCellValue('G3', "Izin");
		$excel->getActiveSheet()->setCellValue('H3', "Alfa");
		$excel->getActiveSheet()->setCellValue('I3', "Nilai Alfa");

		// set row
		$row_count = 4;
		foreach ($presensi as $row) {
			$excel->getActiveSheet()->setCellValue("A{$row_count}", $row_count - 3);
			$excel->getActiveSheet()->setCellValue("B{$row_count}", $row['NI']);
			$excel->getActiveSheet()->setCellValue("C{$row_count}", $row['nama']);
			$excel->getActiveSheet()->setCellValue("D{$row_count}", $row['kelas']);
			$excel->getActiveSheet()->setCellValue("E{$row_count}", $row['prodi']);
			$excel->getActiveSheet()->setCellValue("F{$row_count}", $row['sakit']);
			$excel->getActiveSheet()->setCellValue("G{$row_count}", $row['izin']);
			$excel->getActiveSheet()->setCellValue("H{$row_count}", $row['alfa']);
			$excel->getActiveSheet()->setCellValue("I{$row_count}", $row['nilai_alfa']);
			$row_count++;
		}

		$row_count--;
		$excel->getActiveSheet()->getStyle("A3:I{$row_count}")->applyFromArray(array(
			'borders' => array(
				'allborders' => array(
					'style' => PHPExcel_Style_Border::BORDER_THIN
				)
			)
		));

		$writer = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="' . $filename . '"');
		header('Cache-Control: max-age=0');
		$writer->save('php://output');
	}

	private function export_mahasiswa_pdf($presensi, $filename, $title)
	{
		// die('woi');
		$data['presensi'] = $presensi;
		$data['filename'] = $filename;
		$data['title'] = $title;
		$this->view('admin/export_mahasiswa_pdf', $data);
	}

	public function kelas()
	{
		$data['title'] = 'Daftar Kelas';
		$data['daftar_kelas'] = $this->db->query("SELECT * FROM tb_kelas INNER JOIN tb_prodi ON tb_prodi.id = tb_kelas.prodi_id")->result_array();

		$this->view('admin/kelas', $data);
	}

	public function tambah_kelas()
	{
		$datakelas = [
			'Nama_Kelas' => htmlspecialchars($this->input->post('Nama_Kelas', true)),
			'prodi_id' => htmlspecialchars($this->input->post('prodi_id', true))
		];

		$this->db->insert('tb_kelas', $datakelas);
		$this->session->set_flashdata('message', '<div class="alert alert-success" role="alert">Berhasil Input Data Kelas.</div');
		redirect('admin/kelas');
	}
}
