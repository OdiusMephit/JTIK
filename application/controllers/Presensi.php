<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Presensi extends MY_Controller
{
	const ROLE_PENGAJAR = [
		ROLE_KAJUR,
		ROLE_SEKJUR,
		ROLE_KPSTI,
		ROLE_KPSTKJ,
		ROLE_KPSTMD,
		ROLE_KPSTMJ,
		ROLE_DOSEN,
	];

	public function __construct()
	{
		parent::__construct();
		$role_id = $this->session->userdata('role_id');
		if (!in_array($role_id, self::ROLE_PENGAJAR)) {
			$this->flash_danger('Kamu tidak dapat mengakses halaman ini');
			redirect('mahasiswa');
			return;
		}
		$this->load->library('form_validation');
	}

	public function view($view, $data = [])
	{
		$data['user'] = $this->db->get_where('tb_user', ['email' => $this->session->userdata('email')])->row_array();
		$role_id = $this->session->userdata('role_id');
		$role = $this->get_role_str($role_id);
		$this->load->view('templates/header', $data);
		$this->load->view($role .'/sidebar', $data);
		$this->load->view('templates/topbar', $data);
		$this->load->view($view, $data);
		$this->load->view('templates/footer', $data);
	}

	private function get_role_str($role_id)
	{
		switch ($role_id) {
			case ROLE_KAJUR:
				return 'kajur';
			case ROLE_SEKJUR:
				return 'sekjur';
			case ROLE_KPSTI:
			case ROLE_KPSTMJ:
			case ROLE_KPSTMD:
			case ROLE_KPSTKJ:
				return 'kps';
			case ROLE_DOSEN:
				return 'dosen';
		}
		return NULL;
	}

	public function generate_qr()
	{
		$data['title'] = 'Generate QR-Code Hari Ini';
		// cek apakah ada data get
		$data_get = $this->input->get();
		if (!empty($data_get)) {
			$manual = $data_get['manual'] == 1;
			$kode_jadwal = $data_get['kode_jadwal'];
			$jadwal = $this->db->get_where('jadwal', ['kode_jadwal' => $kode_jadwal])->row_array();
			if ($jadwal) {
				// cek apakah qr code perkuliahan sudah digenerate
				$perkuliahan = $this->db->get_where('perkuliahan', [
					'kode_jadwal' => $kode_jadwal,
					'waktu_mengajar >' => date('Y-m-d 00:00:00'),
					'waktu_mengajar <' => date('Y-m-d 23:59:59')
				])->row_array();
				// jika belum, generate qr code
				if (!$perkuliahan) {
					// get diff jadwal start-end
					$jam_mulai = new DateTime($jadwal['jam_mulai']);
					$jam_selesai = new DateTime($jadwal['jam_selesai']);
					$diff = $jam_mulai->diff($jam_selesai);
					$diff = $diff->h * 3600 + $diff->m * 60 + $diff->s; // dalam second
					// get waktu mengajar & selesai dari diff sebelumnya
					$waktu_mengajar = date('Y-m-d H:i:s');
					// cek apakah sudah pas / lewat waktu mengajar
					$waktu_mulai_seharusnya = date('Y-m-d') .' '. $jadwal['jam_mulai'] .':00';
					$waktu_selesai_seharusnya = date('Y-m-d') .' '. $jadwal['jam_selesai'] .':00';
					if ($waktu_mengajar < $waktu_mulai_seharusnya) {
						$this->flash_danger('Error! Belum waktunya utk mulai perkuliahan');
						return redirect('presensi/generate_qr');
					} else if ($waktu_mengajar > $waktu_selesai_seharusnya) {
						$this->flash_danger('Error! Jadwal perkuliahan telah berlalu');
						return redirect('presensi/generate_qr');
					}
					// generate qr image jika tidak manual
					$this->load->library('ciqrcode', 'qr');
					$qr = '';
					if (!$manual) {
						$qr = 'mtk-' . $kode_jadwal . '-' . date('Ymd-His');
						$params['data'] = $qr;
						$params['level'] = 'H';
						$params['size'] = 512;
						$params['savename'] = FCPATH . '/uploads/presensi/' . $qr;
						$this->ciqrcode->generate($params);
					}
					// $waktu_selesai = date('Y-m-d H:i:s', strtotime("+$diff seconds"));
					// insert qr perkuliahan
					$this->db->insert('perkuliahan', [
						'kode_jadwal' => $kode_jadwal,
						'waktu_mengajar' => $waktu_mengajar,
						// 'waktu_selesai' => $waktu_selesai, // waktu selesai diset saat mengakhiri kelas, default NULL
						'qr' => $qr,
					]);
					$id_perkuliahan = $this->db->insert_id();
					// insert presensi pengajar
					$this->db->insert('presensi', [
						'id_perkuliahan' => $id_perkuliahan,
						'kode_jadwal' => $kode_jadwal,
						'NI' => $this->session->userdata('NI'),
						'waktu_presensi' => date('Y-m-d H:i:s'),
						'status' => 'hadir',
					]);
					$perkuliahan = $this->db->get_where('perkuliahan', [
						'kode_jadwal' => $kode_jadwal,
						'waktu_mengajar >' => date('Y-m-d 00:00:00'),
						'waktu_mengajar <' => date('Y-m-d 23:59:59')
					])->row_array();
					if (!$perkuliahan) {
						if (!$manual) {
							$this->flash_danger('Gagal generate QRCODE');
						} else {
							$this->flash_danger('Gagal memasukkan perkuliahan');
						}
					}
				}

				// qr sudah ada / berhasil generate = redirect ke detail
				if ($perkuliahan) {
					if (!$manual) {
						redirect('presensi/qr/' . $perkuliahan['id']);
						return;
					} else {
						redirect('presensi/manual/' . $perkuliahan['id']);
						return;
					}
				}
			}
		}
		// get daftar jadwal yg dimiliki hari ini
		$nama = $this->session->userdata('nama');
		$idx_hari = date('w');
		switch ($idx_hari) {
			case 1:
				$data['hari'] = 'SENIN';
				break;
			case 2:
				$data['hari'] = 'SELASA';
				break;
			case 3:
				$data['hari'] = 'RABU';
				break;
			case 4:
				$data['hari'] = 'KAMIS';
				break;
			case 5:
				$data['hari'] = 'JUMAT';
				break;
			case 6:
				$data['hari'] = 'SABTU';
				break;
			case 0:
			default:
				$data['hari'] = 'MINGGU';
				break;
		}
		$data['jadwal'] = $this->db->query("SELECT *
			FROM jadwal
			WHERE pegawai_nip='$nama'
				AND hari='$data[hari]'")->result_array();
		// get kelas & makul
		$data['kelas_makul'] = [];
		foreach ($data['jadwal'] as $j) {
			$kelas = $j['kelas_kode_kelas'];
			$makul = $j['matakuliah_kode_mtk'];
			if (!isset($data['kelas_makul'][$kelas])) {
				$data['kelas_makul'][$kelas] = [];
			}
			$data['kelas_makul'][$kelas][] = $makul;
		}
		// otomatis pilih kode kelas kalau hanya 1 jadwal
		$data['selected_kode_kelas'] = '';
		if (count($data['kelas_makul']) == 1) {
			foreach ($data['kelas_makul'] as $kelas => $makul) {
				$data['selected_kode_kelas'] = $kelas;
			}
		}
		$this->view('presensi/generate_qr', $data);
	}

	// API untuk update QR dinamis
	public function update_qr()
	{
		// get qr dan kode_jadwal yg dikirim dari ajax
		$qr = $this->input->get('qr') ?: '';
		$kode_jadwal = $this->input->get('kode_jadwal') ?: '';
		// cek apakah qr & kode jadwal valid dengan get perkuliahan nya
		$perkuliahan = $this->db->get_where('perkuliahan', [
			'qr' => $qr,
			'kode_jadwal' => $kode_jadwal,
		])->row_array();
		// jika tdk valid kirim pesan qr tidak valid
		if (!$perkuliahan) {
			echo json_encode([
				'message' => 'QR-Code tidak valid!',
				'qr' => '',
			]);
			return;
		}
		// cek apakah perkuliahan masih berjalan
		if ($perkuliahan['waktu_selesai'] != NULL) {
			echo json_encode([
				'message' => 'Perkuliahan sudah selesai!',
				'qr' => '',
			]);
			return;
		}
		// generate qr lagi
		$this->load->library('ciqrcode', 'qr');
		$qr = 'mtk-' . $kode_jadwal . '-' . date('Ymd-His');
		$params['data'] = $qr;
		$params['level'] = 'H';
		$params['size'] = 512;
		$params['savename'] = FCPATH . '/uploads/presensi/' . $qr;
		$this->ciqrcode->generate($params);
		// update qr perkuliahan
		$this->db->update('perkuliahan', ['qr' => $qr], ['id' => $perkuliahan['id']]);
		echo json_encode([
			'message' => 'OK',
			'qr' => $qr,
		]);
		return;
	}
	// end of API untuk update QR dinamis

	public function qr_aktif()
	{
		$nama = $this->session->userdata('nama');
		$data['perkuliahan'] = $this->db->query("SELECT
				perkuliahan.*
			FROM
				perkuliahan
				LEFT JOIN jadwal ON (perkuliahan.kode_jadwal = jadwal.kode_jadwal)
			WHERE
				jadwal.pegawai_nip = '{$nama}'
				AND perkuliahan.waktu_selesai IS NULL
				AND perkuliahan.alfa = 0
			ORDER BY
				perkuliahan.waktu_mengajar DESC")->row_array();
		if ($data['perkuliahan']) {
			$data['jadwal'] = $this->db->get_where('jadwal', [
				'kode_jadwal' => $data['perkuliahan']['kode_jadwal']
			])->row_array();
			$data['title'] = 'QR-Code: ' . $data['jadwal']['matakuliah_kode_mtk'] . ' - ' . $data['jadwal']['kelas_kode_kelas'];
			// get kapan harus berhenti
			$jam_selesai = date('Y-m-d', strtotime($data['perkuliahan']['waktu_mengajar'])).' '.$data['jadwal']['jam_selesai'];
			$ttl = (new DateTime($jam_selesai))->diff(new DateTime());
			$data['ttl'] = $ttl->h * 60 * 60 + $ttl->i * 60 + $ttl->s;
		} else {
			$data['title'] = 'Tidak ada QR-Code Aktif';
		}
		$data['jadwal'] = $this->db->get_where('jadwal', [
			'kode_jadwal' => $data['perkuliahan']['kode_jadwal']
		])->row_array();
		$this->view('presensi/detail_qr', $data);
	}
	public function qr($id)
	{
		$data['perkuliahan'] = $this->db->get_where('perkuliahan', [
			'id' => $id,
		])->row_array();
		if (!$data['perkuliahan']) {
			$this->flash_danger('QR Code tidak ditemukan');
			redirect('presensi/generate_qr');
			return;
		}
		// cek apakah perkuliahan sdh selesai
		if ($data['perkuliahan']['waktu_selesai']) {
			$this->flash_danger('Perkuliahan sudah selesai');
			return redirect('presensi/kehadiran/'. $data['perkuliahan']['id']);
		}
		$data['jadwal'] = $this->db->get_where('jadwal', [
			'kode_jadwal' => $data['perkuliahan']['kode_jadwal']
		])->row_array();
		// get kapan harus berhenti
		$data['title'] = 'QR-Code: ' . $data['jadwal']['matakuliah_kode_mtk'] . ' - ' . $data['jadwal']['kelas_kode_kelas'];
		$jam_selesai = date('Y-m-d', strtotime($data['perkuliahan']['waktu_mengajar'])).' '.$data['jadwal']['jam_selesai'];
		$ttl = (new DateTime($jam_selesai))->diff(new DateTime());
		$data['ttl'] = $ttl->h * 60 * 60 + $ttl->i * 60 + $ttl->s;
		$this->view('presensi/detail_qr', $data);
	}
	public function manual($id)
	{
		$data['perkuliahan'] = $this->db->get_where('perkuliahan', [
			'id' => $id,
		])->row_array();
		if (!$data['perkuliahan']) {
			$this->flash_danger('Perkuliahan tidak ditemukan');
			redirect('presensi/generate_qr');
			return;
		}
		// jika sudah ada qr berarti tdk bisa manual
		if ($data['perkuliahan']['qr']) {
			$this->flash_danger('Perkuliahan sudah pernah dibuka');
			return redirect('presensi/generate_qr');
		}
		$data['jadwal'] = $this->db->get_where('jadwal', [
			'kode_jadwal' => $data['perkuliahan']['kode_jadwal']
		])->row_array();
		$data['title'] = 'Presensi Manual: ' . $data['jadwal']['matakuliah_kode_mtk'] . ' - ' . $data['jadwal']['kelas_kode_kelas'];
		// get kelas dari jadwal
		$kelas = $this->db->get_where('tb_kelas', ['Nama_Kelas' => $data['jadwal']['kelas_kode_kelas']])->row_array();
		if (!$kelas) {
			$this->flash_danger('Kelas '. $data['jadwal']['kelas_kode_kelas'] .' tidak ditemukan di Database Kelas');
			return redirect('presensi/generate_qr');
		}
		// get mahassiwa kelas tsb
		$data['mahasiswa'] = $this->db->query("SELECT
				tb_mahasiswa.*,
				tb_user.nama
			FROM
				tb_mahasiswa
				LEFT JOIN tb_user ON (tb_user.NI = tb_mahasiswa.NI)
			WHERE
				tb_mahasiswa.id_kelas = {$kelas['id']}")->result_array();
		$this->view('presensi/manual', $data);
	}
	public function set_manual($id)
	{
		$data['perkuliahan'] = $this->db->get_where('perkuliahan', [
			'id' => $id,
		])->row_array();
		if (!$data['perkuliahan']) {
			$this->flash_danger('Perkuliahan tidak ditemukan');
			redirect('presensi/generate_qr');
			return;
		}
		$presensi = $this->input->post('presensi');
		$this->db->insert_batch('presensi', $presensi);
		redirect('presensi/akhiri/'. $data['perkuliahan']['id']);
	}
	public function akhiri($id)
	{
		$data['perkuliahan'] = $this->db->get_where('perkuliahan', [
			'id' => $id,
		])->row_array();
		if (!$data['perkuliahan']) {
			$this->flash_danger('QR Code tidak ditemukan');
			redirect('presensi/generate_qr');
			return;
		}
		// set waktu selesai jika blm diset
		$waktu_sekarang = date('Y-m-d H:i:s');
		if (!$data['perkuliahan']['waktu_selesai']) {
			$this->db->update('perkuliahan', ['waktu_selesai' => $waktu_sekarang], ['id' => $data['perkuliahan']['id']]);
			// set waktu selesai presensi mahasiswa & pengajar
			$this->db->update('presensi', ['waktu_selesai' => $waktu_sekarang], [
				'id_perkuliahan' => $data['perkuliahan']['id'],
				// 'NI' => $this->session->userdata('NI'),
			]);
		}
		$data['jadwal'] = $this->db->get_where('jadwal', [
			'kode_jadwal' => $data['perkuliahan']['kode_jadwal']
		])->row_array();
		if ($data['perkuliahan']['qr']) {
			$data['title'] = 'Mensudahi Perkuliahan: ' . $data['jadwal']['matakuliah_kode_mtk'] . ' - ' . $data['jadwal']['kelas_kode_kelas'];
		} else {
			// tidak ada qr berarti presensi manual
			$data['title'] = 'Input Materi: ' . $data['jadwal']['matakuliah_kode_mtk'] . ' - ' . $data['jadwal']['kelas_kode_kelas'];
		}
		$this->view('presensi/input_materi', $data);
	}
	public function set_materi($id)
	{
		$data['perkuliahan'] = $this->db->get_where('perkuliahan', [
			'id' => $id,
		])->row_array();
		if (!$data['perkuliahan']) {
			$this->flash_danger('QR Code tidak ditemukan');
			redirect('presensi/generate_qr');
			return;
		}
		// upload file & masukkan ke post_data
		$config['upload_path']          = './uploads/materi/';
		$config['allowed_types']        = [
			'doc','docx','pdf',
			'jpg','jpeg','png',
		];
		$config['file_name']			= $data['perkuliahan']['qr'];
		$config['overwrite']			= true;
		$this->load->library('upload', $config);
		if (!$this->upload->do_upload('userfile')) {
			$this->flash_danger($this->upload->display_errors());
			redirect('presensi/akhiri/'. $data['perkuliahan']['id']);
			return;
		}
		$data = $this->upload->data();
		$filename = $data['file_name'];
		$post_data = $this->input->post();
		$post_data['materi_file'] = $filename;
		// update materi di db
		$this->db->update('perkuliahan', $post_data, ['id' => $id]);
		$this->flash_success('Materi perkuliahan berhasil diubah');
		redirect('presensi/materi');
	}

	public function materi()
	{
		$pegawai_nip = $this->session->userdata('nama');
		// get materi
		$data['materi'] = $this->db->query("SELECT
				perkuliahan.*,
				jadwal.matakuliah_kode_mtk
			FROM
				perkuliahan
				LEFT JOIN jadwal ON (jadwal.kode_jadwal = perkuliahan.kode_jadwal)
			WHERE
				perkuliahan.materi_text IS NOT NULL
				AND perkuliahan.materi_file IS NOT NULL
				AND jadwal.pegawai_nip = '$pegawai_nip'
			ORDER BY
				perkuliahan.waktu_mengajar DESC")->result_array();
		$data['title'] = 'Daftar Materi';
		$this->view('presensi/materi', $data);
	}

	public function kehadiran($id)
	{
		$data['perkuliahan'] = $this->db->get_where('perkuliahan', [
			'id' => $id
		])->row_array();
		$data['presensi'] = $this->db->query("SELECT
				presensi.*,
				tb_user.nama
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
			WHERE
				presensi.id_perkuliahan = $id
				AND tb_user.role_id = 10
			ORDER BY
				tb_user.nama")->result_array();
		$data['jadwal'] = $this->db->get_where('jadwal', ['kode_jadwal' => $data['perkuliahan']['kode_jadwal']])->row_array();
		$data['title'] = 'Kehadiran Mahasiswa';
		$this->view('presensi/kehadiran', $data);
	}

	public function kehadiran_pengajar()
	{
		$NI = $this->session->userdata('NI');
		$data['presensi'] = $this->db->query("SELECT
				presensi.*,
				jadwal.matakuliah_kode_mtk
			FROM
				presensi
				LEFT JOIN jadwal ON (jadwal.kode_jadwal = presensi.kode_jadwal)
			WHERE
				presensi.NI = '$NI'
			ORDER BY
				presensi.waktu_presensi DESC")->result_array();
		$data['title'] = "Daftar Kehadiran";
		$this->view('presensi/kehadiran_pengajar', $data);
	}

	public function jadwal()
	{
		$jadwal = $this->db->get_where('jadwal', ['pegawai_nip' => $this->session->userdata('nama')])->result_array();

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

		// mapping jadwal by waktu_mulai & hari
		foreach ($jadwal as $j) {
			$jam_mulai = $j['jam_mulai'];
			$hari = $j['hari'];
			$data['jadwal'][$jam_mulai][$hari] = $j;
		}

		$data['title'] = 'Jadwal Perkuliahan';
		$this->view('presensi/jadwal', $data);
	}
}
