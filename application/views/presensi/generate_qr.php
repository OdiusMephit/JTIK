<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= $this->session->flashdata('message') ?>

  <div class="row">
    <div class="col-12 col-md-7">
      <?= form_open('', ['method' => 'GET']) ?>
      <input type="hidden" name="kode_jadwal" id="kode_jadwal">
      <input type="hidden" name="manual" id="manual" value="0">
      <div class="form-group row">
        <label for="pegawai_nip" class="col-4 col-form-label">Nama Pengajar</label>
        <div class="col-8">
          <p class="form-control-plaintext mb-0" id="pegawai_nip"><?= $user['nama'] ?></p>
        </div>
      </div>
      <div class="form-group row">
        <label for="tanggal" class="col-4 col-form-label">Tanggal</label>
        <div class="col-5">
          <p class="form-control-plaintext mb-0" id="tanggal"><?= date('d M Y') ?></p>
        </div>
      </div>
      <div class="form-group row">
        <label for="kelas_kode_kelas" class="col-4 col-form-label">Kelas</label>
        <div class="col-4">
          <select name="" id="kelas_kode_kelas" class="form-control" onchange="setKelas()" required>
            <option value="" hidden="hidden" disabled="disabled" selected="selected">-- Pilih Kelas --</option>
            <?php foreach ($kelas_makul as $kode_kelas => $makul) : ?>
              <option value="<?= $kode_kelas ?>"><?= $kode_kelas ?></option>
            <?php endforeach ?>
          </select>
        </div>
      </div>
      <div class="form-group row">
        <label for="matakuliah_kode_mtk" class="col-4 col-form-label">Mata Kuliah</label>
        <div class="col-8">
          <select name="" id="matakuliah_kode_mtk" class="form-control" onchange="setMakul()" required></select>
        </div>
      </div>
      <div class="form-group row">
        <label for="jam" class="col-4 col-form-label">Dimulai Jam</label>
        <div class="col-2">
          <p class="form-control-plaintext mb-0" id="jam_mulai">--</p>
        </div>
        <label class="col-1 col-form-label">s/d</label>
        <div class="col-2">
          <p class="form-control-plaintext mb-0" id="jam_selesai">--</p>
        </div>
      </div>
      <div class="form-group row">
        <label for="ruang_kelas" class="col-4 col-form-label">Tempat Pembelajaran</label>
        <div class="col-6">
          <p class="form-control-plaintext mb-0" id="ruang_kelas">--</p>
        </div>
      </div>
      <br>
      <button type="submit" class="btn btn-primary" id="btn-submit" disabled>Generate QR-Code</button>
      <button type="submit" class="btn btn-success ml-2" id="btn-manual" disabled onclick="setManual()">Presensi Manual</button>
      <?= form_close() ?>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<script>
  var kelas_makul = <?= json_encode($kelas_makul) ?>;
  var jadwal = <?= json_encode($jadwal) ?>;

  function setKelas() {
    var kelas_kode_kelas = $('#kelas_kode_kelas').val();
    // reset makul
    $('#matakuliah_kode_mtk').val('');
    $('#matakuliah_kode_mtk option').remove();
    $('#jam_mulai').text('--');
    $('#jam_selesai').text('--');
    $('#ruang_kelas').text('--');
    $('#btn-submit').attr('disabled', 'disabled');
    $('#btn-manual').attr('disabled', 'disabled');
    // get makul
    var makul = kelas_makul[kelas_kode_kelas];
    // auto select jika jumlah makul == 1
    if (makul.length == 1) {
      m = makul[0];
      $('#matakuliah_kode_mtk').append(`
          <option value="${m}" selected>
            ${m}
          </option>
          `);
      setMakul();
    } else {
      $('#matakuliah_kode_mtk').append(`
        <option hidden selected disabled value="">
          -- Pilih Mata Kuliah --
        </option>
        `);
      for (var m of makul) {
        $('#matakuliah_kode_mtk').append(`
          <option value="${m}">
            ${m}
          </option>
          `);
      }
    }
  }

  function setMakul() {
    var kelas_kode_kelas = $('#kelas_kode_kelas').val();
    var matakuliah_kode_mtk = $('#matakuliah_kode_mtk').val();
    for (var j of jadwal) {
      if (j.kelas_kode_kelas == kelas_kode_kelas &&
        j.matakuliah_kode_mtk == matakuliah_kode_mtk) {
        $('#jam_mulai').text(j.jam_mulai);
        $('#jam_selesai').text(j.jam_selesai);
        $('#ruang_kelas').text(j.ruang_kelas);
        $('#kode_jadwal').val(j.kode_jadwal);
        $('#btn-submit').removeAttr('disabled');
        $('#btn-manual').removeAttr('disabled');
        break;
      }
    }
  }

  function setManual() {
    $('#manual').val(1);
  }

  <?php if (!empty($selected_kode_kelas)) : ?>
    // otomatis pilih kode kelas kalau hanya 1 jadwal
    $(function() {
      $('#kelas_kode_kelas').val('<?= $selected_kode_kelas ?>');
      setKelas();
    })
  <?php endif ?>
</script>