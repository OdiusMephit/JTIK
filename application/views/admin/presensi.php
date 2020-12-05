<!-- Begin Page Content -->
<div class="container-fluid">
  <!-- <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1> -->
  <form class="mb-4" method="get">
    <div class="row align-items-end">
      <label class="col-12 col-lg-2 col-xl-1" for="tgl">Tanggal</label>
      <div class="col-12 col-lg-3 col-xl-2">
        <div class="form-group mb-0">
          <input class="form-control" type="date" name="tgl" id="tgl" value="<?= $tgl ?>" required>
        </div>
      </div>
      <div class="col-12 col-lg-2 col-xl-2">
        <button type="submit" class="btn btn-block btn-primary">Lihat Presensi</button>
      </div>
      <?php if (!$hide_rekap) : ?>
        <div class="col-12 col-lg-2 col-xl-2">
          <input type="hidden" name="rekap" id="rekap" value="0">
          <button type="submit" class="btn btn-block btn-warning" onclick="setRekap()">Rekap Presensi</button>
        </div>
      <?php endif ?>
    </div>
  </form>

  <?= $this->session->flashdata('message') ?>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <h2 class="h3 mb-3">Kehadiran Pengajar</h2>
      <div class="table-responsive">
        <table class="table table-hover datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Matkul</th>
              <th>Nama</th>
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
            <?php foreach ($presensi_pengajar as $index => $p) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $p['matakuliah_kode_mtk'] ?></td>
                <td><?= $p['nama'] ?></td>
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
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <br>

  <div class="card border-0 shadow-sm">
    <div class="card-body">
      <div class="d-flex mb-3">
        <h2 class="h3 mb-0 mr-auto">Kehadiran Mahasiswa</h2>
        <?php if (!$hide_materi) : ?>
          <button class="btn btn-success" data-toggle="modal" data-target="#modal-export-mhs">
            Export
            <i class="fas fa-file-export ml-2"></i>
          </button>
        <?php endif ?>
      </div>
      <div class="table-responsive">
        <table class="table table-hover datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Matkul</th>
              <th>Nama</th>
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
            <?php foreach ($presensi_mahasiswa as $index => $p) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $p['matakuliah_kode_mtk'] ?></td>
                <td><?= $p['nama'] ?></td>
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
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <?php if (!$hide_materi) : ?>
    <br>

    <div class="card border-0 shadow-sm">
      <div class="card-body">
        <h2 class="h3 mb-3">Materi Perkuliahan</h2>
        <div class="table-responsive">
          <table class="table table-hover datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Matkul</th>
                <th>Pengajar</th>
                <th>Materi</th>
                <th data-searchable="false">File</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($presensi_pengajar as $index => $p) : ?>
                <tr>
                  <td><?= $index + 1 ?></td>
                  <td><?= $p['matakuliah_kode_mtk'] ?></td>
                  <td><?= $p['nama'] ?></td>
                  <td>
                    <?php if ($p['materi_text']) : ?>
                      <?= nl2br($p['materi_text']) ?>
                    <?php else : ?>
                      -
                    <?php endif ?>
                  </td>
                  <td>
                    <?php if ($p['materi_file']) : ?>
                      <a target="_blank" href="<?= base_url('uploads/materi/' . $p['materi_file']) ?>">
                        Download File
                        <i class="fas fa-sm fa-external-link-alt"></i>
                      </a>
                    <?php else : ?>
                      -
                    <?php endif ?>
                  </td>
                </tr>
              <?php endforeach ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>

    <!-- Surat Modal-->
    <div class="modal fade" id="modal-export-mhs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Export Kehadiran Mahasiswa</h5>
            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <?= form_open('admin/export_mahasiswa', ['method' => 'GET']) ?>
            <div class="form-group row">
              <label class="col-4 col-form-label" for="from">Mulai Tgl.</label>
              <div class="col-8">
                <input type="date" name="from" id="from" class="form-control" required="required" value="<?= date('Y-m-01') ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-form-label" for="to">Sampai</label>
              <div class="col-8">
                <input type="date" name="to" id="to" class="form-control" required="required" value="<?= date('Y-m-d') ?>">
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-form-label" for="id_kelas">Kelas</label>
              <div class="col-8">
                <select name="id_kelas" id="id_kelas" class="form-control" required="required">
                  <option value="" selected="selected" hidden="hidden">-- Pilih Kelas --</option>
                  <?php foreach ($kelas as $k) : ?>
                    <option value="<?= $k['id'] ?>"><?= $k['Nama_Kelas'] ?></option>
                  <?php endforeach ?>
                </select>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-4 col-form-label" for="type">Export Sebagai</label>
              <div class="col-8">
                <div class="custom-control custom-radio">
                  <input type="radio" name="type" id="type1" value="xlsx" class="custom-control-input" checked> 
                  <label class="custom-control-label" for="type1">XLSX</label>
                </div>
                <div class="custom-control custom-radio">
                  <input type="radio" name="type" id="type2" value="pdf" class="custom-control-input">
                  <label class="custom-control-label" for="type2">PDF</label>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-8 offset-4">
                <button type="submit" class="btn btn-primary">
                  Export
                  <i class="fas fa-file-export ml-2"></i>
                </button>
              </div>
            </div>
            <?= form_close() ?>
          </div>
        </div>
      </div>
    </div>
    <!-- /Surat Modal-->
  <?php endif ?>


</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
  function setRekap() {
    $('#rekap').val(1);
  }
</script>