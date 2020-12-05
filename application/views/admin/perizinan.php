<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="d-flex mb-4">
    <h1 class="h3 mb-0 mr-auto text-gray-800"><?= $title; ?></h1>
  </div>

  <?= $this->session->flashdata('message') ?>

  <div class="table-responsive">
    <table class="table table-hover" id="datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Nama Mahasiswa</th>
          <!-- <th>Mata Kuliah</th> -->
          <th>Tanggal Pengajuan</th>
          <!-- <th>Perihal</th> -->
          <!-- <th data-sortable="false" data-searchable="false">Lampiran</th> -->
          <th>Status</th>
          <th data-sortable="false" data-searchable="false">Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($surat as $index => &$s) : ?>
          <tr>
            <td><?= $index + 1 ?></td>
            <td><?= $s['mahasiswa'] ?></td>
            <!-- <td>
              <?= $s['makul'] ?> <br>
              <?= $s['tanggal_matkul'] = date('d M Y', strtotime($s['tanggal_matkul'])) ?>
            </td> -->
            <td><?= $s['tanggal'] = date('d M Y, H:i', strtotime($s['tanggal'])) ?></td>
            <!-- <td><?= $s['perihal'] = nl2br($s['perihal']) ?></td> -->
            <!-- <td>
              <a href="<?= site_url('uploads/surat/' . $s['file']) ?>" target="_blank">
                Lihat lampiran
                <i class="fas fa-sm fa-external-link-alt"></i>
              </a>
            </td> -->
            <td>
              <?php if ($s['status'] == 0) : ?>
                <span class="badge badge-secondary">Menunggu konfirmasi Ketua Prodi</span>
              <?php elseif ($s['status'] == 1) : ?>
                <span class="badge badge-info">Izin diterima Ketua Prodi, diteruskan ke Admin</span>
              <?php elseif ($s['status'] == 2) : ?>
                <span class="badge badge-success">Proses selesai, izin disetujui</span>
              <?php else : ?>
                <span class="badge badge-danger">Izin ditolak</span>
              <?php endif ?>
            </td>
            <td>
              <button class="btn btn-sm btn-info text-nowrap" data-index="<?= $index ?>" onclick="detailSurat(this)">Lihat detail</button>
            </td>
          </tr>
        <?php endforeach ?>
      </tbody>
    </table>
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
        <h5 class="modal-title" id="exampleModalLabel">Detail Pengajuan Izin</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('admin/set_perizinan') ?>
        <input type="hidden" name="id_surat" id="id_surat" readonly>

        <h3 class="h5">Izin diajukan oleh:</h3>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="mahasiswa">Nama</label>
          <div class="col-6">
            <p class="form-control-plaintext mb-0" id="mahasiswa"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="NIPNIM">NIM</label>
          <div class="col-6">
            <p class="form-control-plaintext mb-0" id="NIPNIM"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="tanggal">Diajukan Tanggal</label>
          <div class="col-6">
            <p class="form-control-plaintext mb-0" id="tanggal"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="perihal">Perihal</label>
          <div class="col-8">
            <p class="form-control-plaintext mb-0" id="perihal"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="file">Lampiran</label>
          <div class="col-8">
            <a class="form-control-plaintext mb-0" target="_blank" id="file">
              Lihat lampiran
              <i class="fas fa-sm fa-external-link-alt"></i>
            </a>
          </div>
        </div>

        <h3 class="h5">Untuk Matakuliah:</h3>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="makul">Mata Kuliah</label>
          <div class="col-8">
            <p class="form-control-plaintext mb-0" id="makul"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="tanggal_matkul">Tanggal</label>
          <div class="col-6">
            <p class="form-control-plaintext mb-0" id="tanggal_matkul"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-4 col-form-label" for="presensi">Status Presensi</label>
          <div class="col-6">
            <select class="form-control" name="presensi" id="presensi" required>
              <option disabled hidden selected value="">-- Pilih Status Presensi --</option>
              <option value="alfa">Alfa</option>
              <option value="sakit">Sakit</option>
              <option value="izin">Izin</option>
            </select>
          </div>
        </div>
        <div>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Tutup</button>

          <input type="hidden" name="status" id="status">
          <button type="submit" class="btn btn-primary text-nowrap" onclick="terimaIzin()">Ubah Status Presensi</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<!-- /Surat Modal-->

<script>
  var surat = <?= json_encode($surat) ?>;

  function detailSurat(btn) {
    var index = $(btn).data('index');
    var s = surat[index];
    $('#id_surat').val(s.id_surat);
    $('#mahasiswa').text(s.mahasiswa);
    $('#NIPNIM').text(s.NIPNIM);
    $('#tanggal').text(s.tanggal);
    $('#tanggal_matkul').text(s.tanggal_matkul);
    $('#perihal').text(s.perihal);
    $('#makul').text(s.matakuliah_kode_mtk);
    $('#presensi').val(s.presensi);
    $('#file').attr('href', '<?= site_url('uploads/surat/') ?>' + s.file);
    $('#modal-izin').modal('show');
  }

  function terimaIzin() {
    $('#status').val(2);
  }
</script>