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
    <a class="nav-link" href="<?= base_url('admin'); ?>">
      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/presensi'); ?>">
      <i class="fas fa-fw fa-calendar-alt"></i>
      <span>Presensi Harian</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/perizinan'); ?>">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Perizinan</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="<?= base_url('admin/kelas'); ?>">
      <i class="fas fa-fw fa-list-alt"></i>
      <span>Kelas</span></a>
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