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
              <th>Materi</th>
              <th data-sortable="false" data-searchable="false">File</th>
              <th data-sortable="false" data-searchable="false">Perkuliahan</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($materi as $index => $m): ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $m['matakuliah_kode_mtk'] ?></td>
                <td data-sort="<?=$m['waktu_mengajar']?>"><?= date('d M Y', strtotime($m['waktu_mengajar'])) ?></td>
                <td><?= nl2br($m['materi_text']) ?></td>
                <td>
                  <a class="text-nowrap" target="_blank" href="<?= site_url('uploads/materi/'. $m['materi_file']) ?>">
                    Download
                    <i class="fas fa-sm fa-external-link-alt"></i>
                  </a>
                </td>
                <td>
                  <a class="text-nowrap" href="<?= site_url('presensi/kehadiran/'. $m['id']) ?>">
                    Kehadiran Mahasiswa
                  </a>
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