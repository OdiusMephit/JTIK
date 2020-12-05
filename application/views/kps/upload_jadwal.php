<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="d-flex mb-4">
    <h1 class="h3 mb-0 mr-auto text-gray-800"><?= $title; ?></h1>
  </div>

  <?= $this->session->flashdata('message') ?>

  <?= form_open_multipart('kps/do_upload_jadwal') ?>
  <div class="form-group">
    <label for="userfile">Masukkan excel jadwal (ekstensi xlsx)</label>
    <input type="file" name="userfile" id="userfile" class="form-control" required="required" accept=".xlsx">
  </div>
  <div>
    <button type="submit" class="btn btn-primary">Upload</button>
  </div>
  <?= form_close() ?>

</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->