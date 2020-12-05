<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= $this->session->flashdata('message') ?>

  <div class="row">
    <div class="col-12 col-md-12">

      <div class="table-responsive">
        <table class="table table-hover" id="datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Matkul</th>
              <th>Tanggal</th>
              <th>Masuk</th>
              <th>Pulang</th>
              <th data-searchable="false">Hadir</th>
              <th data-searchable="false">Sakit</th>
              <th data-searchable="false">Izin</th>
              <th data-searchable="false">Alfa</th>
              <th data-searchable="false">Nilai Alfa</th>
              <th data-sortable="false" data-searchable="false">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($presensi as $index => $p) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $p['matakuliah_kode_mtk'] ?></td>
                <td data-sort="<?= $p['waktu_presensi'] ?>">
                  <?= $p['waktu_presensi'] ? date('d M Y', strtotime($p['waktu_presensi'])) : '-' ?>
                </td>
                <td data-sort="<?= $p['waktu_presensi'] ?>">
                  <?= $p['waktu_presensi'] && $p['status'] == 'hadir' ? date('H:i', strtotime($p['waktu_presensi'])) : '-' ?>
                </td>
                <td data-sort="<?= $p['waktu_selesai'] ?>">
                  <?= $p['waktu_selesai'] && $p['status'] == 'hadir' ? date('H:i', strtotime($p['waktu_selesai'])) : '-' ?>
                </td>
                <td>
                  <?php if ($p['status'] == 'hadir') : ?>
                    <i class="fas fa-check-square text-primary"></i>
                  <?php endif ?>
                </td>
                <td>
                  <?php if ($p['status'] == 'sakit') : ?>
                    <i class="fas fa-check-square text-primary"></i>
                  <?php endif ?>
                </td>
                <td>
                  <?php if ($p['status'] == 'izin') : ?>
                    <i class="fas fa-check-square text-primary"></i>
                  <?php endif ?>
                </td>
                <td>
                  <?php if ($p['status'] == 'alfa') : ?>
                    <i class="fas fa-check-square text-primary"></i>
                  <?php endif ?>
                </td>
                <td><?= $p['nilai_alfa'] ?></td>
                <td>
                  <?php if ($p['status'] == 'alfa'): ?>
                    <button class="btn btn-primary btn-sm"
                      data-matakuliah_kode_mtk="<?= $p['matakuliah_kode_mtk'] ?>"
                      data-tanggal_matkul="<?= date('Y-m-d', strtotime($p['waktu_presensi'])) ?>"
                      onclick="buatIzin(this)">Ajukan Izin</button>
                  <?php endif ?>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Surat Modal-->
<div class="modal fade" id="modal-izin" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ajukan Izin Baru</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open_multipart('mahasiswa/add_perizinan') ?>
        <?= form_hidden('NIPNIM', $nim) ?>
        <div class="form-group row">
          <label class="col-3 col-form-label" for="matakuliah_kode_mtk">Mata Kuliah</label>
          <div class="col-9">
            <!-- <select name="matakuliah_kode_mtk" id="matakuliah_kode_mtk" class="form-control" required>
              <?php foreach ($makul as $m): ?>
                <option value="<?=$m['Nama_Matakuliah']?>"><?=$m['Nama_Matakuliah']?></option>
              <?php endforeach ?>
            </select> -->
            <input type="text" name="matakuliah_kode_mtk" id="matakuliah_kode_mtk" class="form-control" required="required" readonly="readonly">
          </div>
        </div>
        <div class="form-group row">
          <label class="col-3 col-form-label" for="tanggal_matkul">Tanggal</label>
          <div class="col-6">
            <input type="date" name="tanggal_matkul" id="tanggal_matkul" class="form-control" required readonly>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-3 col-form-label" for="perihal">Perihal</label>
          <div class="col-9">
            <textarea name="perihal" id="perihal" rows="3" class="form-control" required="required"></textarea>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-3 col-form-label" for="userfile">Lampiran</label>
          <div class="col-9">
            <input type="file" name="userfile" id="userfile" class="form-control" accept=".pdf,.doc,.docx,.png,.jpg,.jpeg" required="required">
          </div>
        </div>
        <div>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<!-- /Surat Modal-->

<script>
  function buatIzin(btn) {
    var matakuliah_kode_mtk = $(btn).data('matakuliah_kode_mtk');
    var tanggal_matkul = $(btn).data('tanggal_matkul');
    $('#matakuliah_kode_mtk').val(matakuliah_kode_mtk);
    $('#tanggal_matkul').val(tanggal_matkul);
    $('#modal-izin').modal('show');
  }
</script>