<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
    <img src="<?php echo base_url('img/pnj.png') ?>" height="40" width="50">
    <div class="sidebar-brand-text mx-3">JTIK</div>
  </a>

  <!-- Divider -->
  <hr class="sidebar-divider">

  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('dosen'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('presensi/jadwal'); ?>">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Jadwal Perkuliahan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('presensi/generate_qr'); ?>">
      <i class="fas fa-fw fa-qrcode"></i>
      <span>QRCode Hari Ini</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('presensi/qr_aktif'); ?>">
      <i class="fas fa-fw fa-qrcode"></i>
      <span>QRCode Aktif</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('presensi/materi'); ?>">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Materi Perkuliahan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('presensi/kehadiran_pengajar'); ?>">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Kehadiran Saya</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('auth/logout'); ?>">
      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>

  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">

  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>

</ul>
<!-- End of Sidebar -->