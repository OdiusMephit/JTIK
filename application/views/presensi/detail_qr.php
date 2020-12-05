<!-- Begin Page Content -->
<div class="container-fluid text-center">
  <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
  <?php if (isset($perkuliahan)): ?>
    <p class="lead text-muted mb-4">
      Jam perkuliahan:
      <?= $jadwal['jam_mulai'] ?> -
      <?= $jadwal['jam_selesai'] ?>
    </p>
  <?php endif ?>

  <?= $this->session->flashdata('message') ?>

  <div class="row">
    <div class="col-12 col-md-12">
      <?php if (isset($perkuliahan['qr'])): ?>
        <div class="text-center">
          <img class="border shadow img-fluid" id="qr" src="<?= site_url('uploads/presensi/' . $perkuliahan['qr']) ?>" alt="<?= $title ?>" width="512">
          <br>
          <br>
          <a href="<?= site_url('presensi/akhiri/'. $perkuliahan['id']) ?>" class="btn btn-lg btn-primary">Akhiri Perkuliahan</a>
          <a href="<?= site_url('presensi/kehadiran/'. $perkuliahan['id']) ?>" class="btn btn-lg btn-primary ml-3">Kehadiran Mahasiswa</a>
        </div>
      <?php elseif (isset($perkuliahan)): ?>
        <p class="lead">Tidak ada QR Code untuk perkuliahan ini. Presensi dilakukan manual / sudah dilakukan rekap presensi harian.</p>
        <a href="<?= site_url('presensi/manual/'. $perkuliahan['id']) ?>" class="btn btn-lg btn-primary">Presensi Manual</a>
      <?php else: ?>
        <p class="lead">Semua perkuliahan sudah selesai.</p>
      <?php endif ?>
    </div>
  </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<?php if (isset($perkuliahan['qr'])): ?>
  <script>
    // simpan qr awal
    var qr = '<?= $perkuliahan['qr'] ?>';
    // set interval untuk meminta update qr code
    setInterval(() => {
      // remove qr dahulu dengan mengubah src jadi kosongan
      $('#qr').attr('src', '');
      // kirim ajax ke API presensi/update_qr
      $.ajax({
        url: '<?= site_url('presensi/update_qr') ?>',
        method: 'GET',
        data: {
          qr: qr, // qr dapatkan dari var qr di baris 41
          kode_jadwal: '<?= $perkuliahan['kode_jadwal'] ?>'
        }
      })
      // fungsi .then kalau berhasil menghubungi server
      .then(res => {
        // parse json string response dari API
        res = JSON.parse(res);
        // jika ada atribut json berupa qr, maka set image dengan qr yang baru
        if (res.qr) {
          qr = res.qr
          $('#qr').attr('src', '<?= site_url('uploads/presensi/') ?>'+ qr);
        }
        console.log(res.message)
      })
      // fungsi .fail jika gagal menghubungi server
      .fail(res => {
        alert('Error')
        console.log(res)
      })
    }, 5 * 1000);
    // ^ 5 * 1000 = 5 detik
    // 1 detik = 1000
    // untuk mengganti interval misal 10 detik, berarti ganti jadi 10 * 1000

    // timeout untuk mengakhiri perkuliahan otomatis
    setTimeout(() => {
      window.location = '<?= site_url('presensi/akhiri/'. $perkuliahan['id']) ?>'
    }, <?= $ttl ?> * 1000);
  </script>
<?php endif ?>