<!-- Begin Page Content -->
<div class="container-fluid text-center">
  <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
  <p class="lead text-muted mb-4">
    Jam perkuliahan:
    <?= $jadwal['jam_mulai'] ?> -
    <?= $jadwal['jam_selesai'] ?>
  </p>

  <?= $this->session->flashdata('message') ?>

  <div class="row">
    <div class="col-12 col-md-12">
      <?= form_open('presensi/set_manual/'. $perkuliahan['id']) ?>
      <div class="table-responsive">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th data-searchable="false">Hadir</th>
              <th data-searchable="false">Sakit</th>
              <th data-searchable="false">Izin</th>
              <th data-searchable="false">Alfa</th>
              <th class="text-nowrap" data-searchable="false">Nilai Alfa</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($mahasiswa as $index => $p) : ?>
              <input type="hidden" name="presensi[<?=$index?>][id_perkuliahan]" value="<?= $perkuliahan['id'] ?>">
              <input type="hidden" name="presensi[<?=$index?>][kode_jadwal]" value="<?= $perkuliahan['kode_jadwal'] ?>">
              <input type="hidden" name="presensi[<?=$index?>][NI]" value="<?= $p['NI'] ?>">
              <input type="hidden" name="presensi[<?=$index?>][waktu_presensi]" value="<?= date('Y-m-d H:i:s') ?>">
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $p['nama'] ?></td>
                <td>
                  <div class="custom-control custom-radio" onclick="toggleNilaiAlfa('#nilai_alfa_<?= $index ?>', false)">
                    <input type="radio" id="status_hadir_<?= $index ?>" name="presensi[<?=$index?>][status]" class="custom-control-input" value="hadir" required checked>
                    <label class="custom-control-label" for="status_hadir_<?= $index ?>">Hadir</label>
                  </div>
                </td>
                <td>
                  <div class="custom-control custom-radio" onclick="toggleNilaiAlfa('#nilai_alfa_<?= $index ?>', false)">
                    <input type="radio" id="status_sakit_<?= $index ?>" name="presensi[<?=$index?>][status]" class="custom-control-input" value="sakit" required>
                    <label class="custom-control-label" for="status_sakit_<?= $index ?>">Sakit</label>
                  </div>
                </td>
                <td>
                  <div class="custom-control custom-radio" onclick="toggleNilaiAlfa('#nilai_alfa_<?= $index ?>', false)">
                    <input type="radio" id="status_izin_<?= $index ?>" name="presensi[<?=$index?>][status]" class="custom-control-input" value="izin" required>
                    <label class="custom-control-label" for="status_izin_<?= $index ?>">Izin</label>
                  </div>
                </td>
                <td>
                  <div class="custom-control custom-radio" onclick="toggleNilaiAlfa('#nilai_alfa_<?= $index ?>', true)">
                    <input type="radio" id="status_alfa_<?= $index ?>" name="presensi[<?=$index?>][status]" class="custom-control-input" value="alfa" required>
                    <label class="custom-control-label" for="status_alfa_<?= $index ?>">Alfa</label>
                  </div>
                </td>
                <td class="text-center" style="width:1%">
                  <input type="number" id="nilai_alfa_<?= $index ?>" name="presensi[<?=$index?>][nilai_alfa]" class="form-control" min="0" step="1" required="required" value="0" readonly>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>

        <div class="text-center mt-4">
          <button type="submit" class="btn btn-primary btn-lg">Simpan</button>
        </div>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
  function toggleNilaiAlfa(id, enable) {
    if (enable) {
      $(id).removeAttr('readonly');
    } else {
      $(id).attr('readonly', 'readonly');
    }
  }
</script>