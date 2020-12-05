<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
  <p class="lead text-muted mb-4">
    Jam perkuliahan:
    <?= $jadwal['jam_mulai'] ?> -
    <?= $jadwal['jam_selesai'] ?>
  </p>

  <?= $this->session->flashdata('message') ?>

  <div class="row">
    <div class="col-12 col-md-12">
      <?= form_open_multipart('presensi/set_materi/'. $perkuliahan['id']) ?>
      <div class="form-group">
        <label for="materi_text">Masukkan Materi Perkuliahan</label>
        <textarea name="materi_text" id="materi_text" rows="4" class="form-control" required="required"></textarea>
      </div>
      <div class="form-group">
        <label for="userfile">Upload File Materi</label>
        <input type="file" name="userfile" id="userfile" class="form-control" required="required" accept=".doc,.docx,.ppt,.pdf">
      </div>
      <div>
        <button type="submit" class="btn btn-primary">Simpan</button>
      </div>
      <?= form_close() ?>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->