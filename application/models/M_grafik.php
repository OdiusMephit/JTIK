 <?php
	class M_grafik extends CI_Model
	{

		function get_data_kelas($id_kelas)
		{
			$sql = $this->db->query("SELECT
				SUM(presensi.nilai_alfa) as total,
				MONTHNAME(waktu_presensi) AS Bulan
			FROM
				presensi
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = presensi.NI)
				LEFT JOIN tb_kelas ON (tb_kelas.id = tb_mahasiswa.id_kelas)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.id_kelas = '$id_kelas'
				AND presensi.waktu_presensi
			GROUP BY
                tb_kelas.id,
				DATE_FORMAT(waktu_presensi, '%Y-%m')
            ORDER BY 
             	presensi.waktu_presensi");

			if ($sql->num_rows() > 0) {
				foreach ($sql->result() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}

		function get_data_prodi($id_prodi)
		{
			$sql = $this->db->query("SELECT
				SUM(presensi.nilai_alfa) as total,
				MONTHNAME(waktu_presensi) AS Bulan
			FROM
				presensi
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = presensi.NI)
				LEFT JOIN tb_prodi ON (tb_prodi.id = tb_mahasiswa.id_prodi)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.id_prodi = '$id_prodi'
				AND presensi.waktu_presensi
			GROUP BY
                tb_prodi.id,
				DATE_FORMAT(waktu_presensi, '%Y-%m')
            ORDER BY 
             	presensi.waktu_presensi");

			if ($sql->num_rows() > 0) {
				foreach ($sql->result() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}

		function get_data_semester($semester)
		{
			$sql = $this->db->query("SELECT
				tb_mahasiswa.semester as semester,
                SUM(presensi.nilai_alfa) as total,
				MONTHNAME(waktu_presensi) AS Bulan
			FROM
				presensi
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = presensi.NI)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.semester = '$semester'
				AND presensi.waktu_presensi
			GROUP BY
				tb_mahasiswa.semester,
				DATE_FORMAT(waktu_presensi, '%Y-%m')
			ORDER BY
				presensi.waktu_presensi");

			if ($sql->num_rows() > 0) {
				foreach ($sql->result() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}

		function get_data_mahasiswa($NI)
		{
			$sql = $this->db->query("SELECT
				tb_mahasiswa.NI as NI,
				SUM(presensi.nilai_alfa) as total,
				MONTHNAME(waktu_presensi) AS Bulan
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
				LEFT JOIN tb_mahasiswa ON (tb_mahasiswa.NI = tb_user.NI)
			WHERE
				tb_mahasiswa.NI IS NOT NULL
				AND tb_mahasiswa.NI = '$NI'
				AND presensi.waktu_presensi  
			GROUP BY
				presensi.NI,
                DATE_FORMAT(waktu_presensi, '%Y-%m')
			ORDER BY
				presensi.waktu_presensi");

			if ($sql->num_rows() > 0) {
				foreach ($sql->result() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}

		function get_data_pengajar($NI)
		{
			$sql = $this->db->query("SELECT
				tb_civitas.NI as NI,
				SUM(presensi.nilai_alfa) as total,
				MONTHNAME(waktu_presensi) AS Bulan
			FROM
				presensi
				LEFT JOIN tb_user ON (tb_user.NI = presensi.NI)
				LEFT JOIN tb_civitas ON (tb_civitas.NI = tb_user.NI)
			WHERE
				tb_civitas.NI IS NOT NULL
				AND tb_civitas.NI = '$NI'
				AND presensi.waktu_presensi  
			GROUP BY
				presensi.NI,
                DATE_FORMAT(waktu_presensi, '%Y-%m')
			ORDER BY
				presensi.waktu_presensi");

			if ($sql->num_rows() > 0) {
				foreach ($sql->result() as $data) {
					$hasil[] = $data;
				}
				return $hasil;
			}
		}
	}
