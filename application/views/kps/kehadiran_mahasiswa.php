<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>

  <?= $this->session->flashdata('message') ?>

  <div class="row">
    <div class="col-12 col-md-12">

      <div class="table-responsive">
        <table class="table table-hover" id="datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Matkul</th>
              <th>Nama</th>
              <th>Tanggal</th>
              <th>Masuk</th>
              <th>Pulang</th>
              <th data-searchable="false">Hadir</th>
              <th data-searchable="false">Sakit</th>
              <th data-searchable="false">Izin</th>
              <th data-searchable="false">Alfa</th>
              <th data-searchable="false">Nilai Alfa</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($presensi as $index => $p) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $p['matakuliah_kode_mtk'] ?></td>
                <td><?= $p['nama'] ?></td>
                <td data-sort="<?= $p['waktu_presensi'] ?>">
                  <?= $p['waktu_presensi'] ? date('d M Y', strtotime($p['waktu_presensi'])) : '-' ?>
                </td>
                <td data-sort="<?= $p['waktu_presensi'] ?>">
                  <?= $p['waktu_presensi'] ? date('H:i', strtotime($p['waktu_presensi'])) : '-' ?>
                </td>
                <td data-sort="<?= $p['waktu_selesai'] ?>">
                  <?= $p['waktu_selesai'] ? date('H:i', strtotime($p['waktu_selesai'])) : '-' ?>
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