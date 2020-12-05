<!-- Begin Page Content -->
<div class="container-fluid">
  <div class="d-flex mb-4">
    <h1 class="h3 mb-0 mr-auto text-gray-800"><?= $title; ?></h1>
    <!-- <button class="btn btn-primary" data-toggle="modal" data-target="#modal-izin">Ajukan Izin Baru</button> -->
  </div>

  <?= $this->session->flashdata('message') ?>

  <div class="table-responsive">
    <table class="table table-hover" id="datatable">
      <thead>
        <tr>
          <th>No</th>
          <th>Mata Kuliah</th>
          <th>Tanggal Pengajuan</th>
          <th>Perihal</th>
          <th data-sortable="false" data-searchable="false">Lampiran</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($surat as $index => $s): ?>
          <tr>
            <td><?=$index+1?></td>
            <td>
              <?=$s['matakuliah_kode_mtk']?> <br>
              <?=date('d M Y', strtotime($s['tanggal_matkul']))?>
            </td>
            <td><?=date('d M Y, H:i', strtotime($s['tanggal']))?></td>
            <td><?=nl2br($s['perihal'])?></td>
            <td>
              <a href="<?=site_url('uploads/surat/'. $s['file'])?>" target="_blank">
                Lihat lampiran
                <i class="fas fa-sm fa-external-link-alt"></i>
              </a>
            </td>
            <td>
              <?php if ($s['status'] == 0): ?>
                <span class="badge badge-secondary">Menunggu konfirmasi Ketua Prodi</span>
              <?php elseif ($s['status'] == 1): ?>
                <span class="badge badge-info">Izin diterima Ketua Prodi, diteruskan ke Admin</span>
              <?php elseif ($s['status'] == 2): ?>
                <span class="badge badge-success">Proses selesai, izin disetujui</span>
              <?php else: ?>
                <span class="badge badge-danger">Izin ditolak</span>
              <?php endif ?>
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
            <select name="matakuliah_kode_mtk" id="matakuliah_kode_mtk" class="form-control" required>
              <?php foreach ($makul as $m): ?>
                <option value="<?=$m['Nama_Matakuliah']?>"><?=$m['Nama_Matakuliah']?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-3 col-form-label" for="tanggal_matkul">Tanggal</label>
          <div class="col-6">
            <input type="date" name="tanggal_matkul" id="tanggal_matkul" class="form-control" required>
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