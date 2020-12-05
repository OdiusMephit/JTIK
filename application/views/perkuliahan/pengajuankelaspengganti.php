<div id="infoMessage" class="text-center"><?= $this->session->flashdata('message'); ?></div>
<form method="post" action="<?= base_url('jadwalpengganti/save'); ?>">
<div class="col-md-12">
  <div class="form-group">
    <label>Hari</label>
        <select name="hari" class="form-control" required>
            <option>- Pilih Hari --</option>
            <option value="Senin">Senin</option>
            <option value="Selasa">Selasa</option>
            <option value="Rabu">Rabu</option>
            <option value="Kamis">Kamis</option>
            <option value="Jumat">Jumat</option>
            <option value="Sabtu">Sabtu</option>
        </select>
  </div>
  <div class="form-group">
    <label>Tanggal</label>
    <input type="date" placeholder="Pengajuan Tanggal" id="tanggal" name="tanggal" class="form-control" required>
  </div>

  <div class="form-group">
    <label>Kelas</label>
    <select name="kelas_kode_kelas" class="form-control" id="kelas_kode_kelas" required>
      <option>-- Pilih Kelas --</option>
          <?php 
          $this->db->from('jadwal');
          $this->db->where('pegawai_nip', $user['nama']);
          $sql =  $this->db->get();
          foreach ($sql->result() as $row) {
           ?>
      <option value="<?php echo $row->kelas_kode_kelas; ?>"><?php echo $row->kelas_kode_kelas; ?></option>
              <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label>Mata Kuliah</label>
    <select name="matakuliah_kode_mtk" class="form-control" id="matakuliah_kode_mtk" required>
      <option>-- Pilih Mata Kuliah --</option>
          <?php 
           $this->db->from('jadwal');
           $this->db->where('pegawai_nip', $user['nama']);
           $sql =  $this->db->get();
          foreach ($sql->result() as $row) {
           ?>
      <option value="<?php echo $row->matakuliah_kode_mtk; ?>"><?php echo $row->matakuliah_kode_mtk; ?></option>
              <?php } ?>
    </select>
  </div>

  <div class="form-group">
    <label>Jam Mulai</label>
    <input type="text" placeholder="00:00:00" name="jam_mulai" class="form-control" required>
  </div>
  <div class="form-group">
    <label>Jam Selesai</label>
    <input type="text" placeholder="00:00:00" name="jam_selesai" class="form-control" required>
  </div>

  <div class="form-group">
    <label>Ruangan</label>
    <select name="ruang_kelas" class="form-control" required>
        <option>-- Pilih Ruangan --</option>
              <?php 
              $sql = $this->db->get('tb_ruang_kelas');
              foreach ($sql->result() as $row) {
               ?>
              <option value="<?php echo $row->Nama_Ruang_Kelas; ?>"><?php echo $row->Nama_Ruang_Kelas; ?></option>
              <?php } ?>
    </select>
  </div>

  <div class="form-group hidden">
      <input type="hidden" name="Dibuat_Oleh" id="Dibuat_Oleh" class="form-control" value="<?= $user['nama']; ?>">
  </div>
  <div class="form-group hidden">
      <input type="hidden" name="status" id="status" class="form-control" value="Menunggu Konfirmasi">
  </div>

  <div class="form-group">
    <button type="submit" class="btn btn-info btn-md">Ajukan</button>
  </div>
</div>

</form>
