  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5 col-lg-7 mx-auto">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Halaman Daftar Akun</h1>
              </div>
              <form class="user">
                <div class="row">
                  <div class="col-lg-6">
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="NI" name="NI" placeholder="Nomor Induk" value="<?= set_value('NI'); ?>">
                       <?= form_error('NI','<small class="text-danger pl-3">', '</small>'); ?>
                  
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-user" id="nama" name="nama" placeholder="Nama Lengkap"  value="<?= set_value('nama'); ?>">
                         <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="tempat_lahir_mahasiswa" name="tempat_lahir_mahasiswa" placeholder="Tempat Lahir" value="<?= set_value('tempat_lahir_mahasiswa'); ?>">
                         <?= form_error('tempat_lahir_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="date" class="form-control form-control-user" id="tanggal_lahir_mahasiswa" name="tanggal_lahir_mahasiswa" placeholder="Tanggal Lahir"  value="<?= set_value('tanggal_lahir_mahasiswa'); ?>">
                         <?= form_error('tanggal_lahir_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="alamat_mahasiswa" name="alamat_mahasiswa"  placeholder="Alamat Lengkap"  value="<?= set_value('alamat_mahasiswa'); ?>">
                       <?= form_error('alamat_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-user" id="kelurahan_mahasiswa" name="kelurahan_mahasiswa" placeholder="Kelurahan"  value="<?= set_value('kelurahan_mahasiswa'); ?>">
                         <?= form_error('kelurahan_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-user" id="kecamatan_mahasiswa" name="kecamatan_mahasiswa" placeholder="Kecamatan"  value="<?= set_value('kecamatan_mahasiswa'); ?>">
                         <?= form_error('kecamatan_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-user" id="kota_mahasiswa" name="kota_mahasiswa" placeholder="Kota"  value="<?= set_value('kota_mahasiswa'); ?>">
                         <?= form_error('kota_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                  </div>

                  <div class="col-lg-6">
                    <div class="form-group">
                      <select id="jenis_kelamin" name="jenis_kelamin" class="form-control form-control-user"  value="<?= set_value('jenis_kelamin'); ?>">
                        <option>-- Pilih Jenis Kelamin --</option>
                        <option value="Perempuan">Perempuan</option>
                        <option value="Laki-Laki">Laki-Laki</option>
                      </select>
                       <?= form_error('jenis_kelamin','<small class="text-danger pl-3">', '</small>'); ?>
                  
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="nama_ayah_mahasiswa" name="nama_ayah_mahasiswa" placeholder="Nama Ayah"  value="<?= set_value('nama_ayah_mahasiswa'); ?>">
                         <?= form_error('nama_ayah_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="nama_ibu_mahasiswa" name="nama_ibu_mahasiswa" placeholder="Nama Ibu"  value="<?= set_value('nama_ibu_mahasiswa'); ?>">
                         <?= form_error('nama_ibu_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="alamat_ayah_mahasiswa" name="alamat_ayah_mahasiswa" placeholder="Alamat Ayah"  value="<?= set_value('alamat_ayah_mahasiswa'); ?>">
                         <?= form_error('alamat_ayah_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="alamat_ibu_mahasiswa" name="alamat_ibu_mahasiswa" placeholder="Alamat Ibu"  value="<?= set_value('alamat_ibu_mahasiswa'); ?>">
                         <?= form_error('alamat_ibu_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="kelurahan_ayah_mahasiswa" name="kelurahan_ayah_mahasiswa" placeholder="Kelurahan Ayah"  value="<?= set_value('kelurahan_ayah_mahasiswa'); ?>">
                         <?= form_error('kelurahan_ayah_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="kelurahan_ibu_mahasiswa" name="kelurahan_ibu_mahasiswa" placeholder="Kelurahan Ibu"  value="<?= set_value('kelurahan_ibu_mahasiswa'); ?>">
                         <?= form_error('kelurahan_ibu_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="kecamatan_ayah_mahasiswa" name="kecamatan_ayah_mahasiswa" placeholder="Kecamatan Ayah"  value="<?= set_value('kecamatan_ayah_mahasiswa'); ?>">
                         <?= form_error('kecamatan_ayah_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="kecamatan_ibu_mahasiswa" name="kecamatan_ibu_mahasiswa" placeholder="Kecamatan Ibu"  value="<?= set_value('kecamatan_ibu_mahasiswa'); ?>">
                         <?= form_error('kecamatan_ibu_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="kota_ayah_mahasiswa" name="kota_ayah_mahasiswa" placeholder="Kota Ayah"  value="<?= set_value('kota_ayah_mahasiswa'); ?>">
                         <?= form_error('kota_ayah_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="kota_ibu_mahasiswa" name="kota_ibu_mahasiswa" placeholder="Kota Ibu"  value="<?= set_value('kota_ibu_mahasiswa'); ?>">
                         <?= form_error('kota_ibu_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="tlp_mahasiswa" name="tlp_mahasiswa" placeholder="Nomor Telepon Mahasiswa"  value="<?= set_value('tlp_mahasiswa'); ?>">
                       <?= form_error('tlp_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                  
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="tlp_ayah" name="tlp_ayah" placeholder="Nomor Telepon Ayah"  value="<?= set_value('tlp_ayah'); ?>">
                         <?= form_error('tlp_ayah','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="tlp_ibu" name="tlp_ibu" placeholder="Nomor Telepon Ibu"  value="<?= set_value('tlp_ibu'); ?>">
                         <?= form_error('tlp_ibu','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="profesi_ayah" name="profesi_ayah" placeholder="Profesi Ayah"  value="<?= set_value('profesi_ayah'); ?>">
                         <?= form_error('profesi_ayah','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="text" class="form-control form-control-user" id="profesi_ibu" name="profesi_ibu" placeholder="Profesi Ibu"  value="<?= set_value('profesi_ibu'); ?>">
                         <?= form_error('profesi_ibu','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="penghasilan_ayah" name="penghasilan_ayah"  placeholder="Penghasilan Ayah"  value="<?= set_value('penghasilan_ayah'); ?>">
                       <?= form_error('penghasilan_ayah','<small class="text-danger pl-3">', '</small>'); ?>
                  
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6">
                        <select name="id_kelas" class="form-control" id="id_kelas"  value="<?= set_value('id_kelas'); ?>">
                          <option value="id_kelas[]">-- Pilih Kelas --</option>
                          <?php 
                          $sql = $this->db->get('tb_kelas');
                          foreach ($sql->result() as $row) {
                           ?>
                          <option value="<?php echo $row->id; ?>"><?php echo $row->Nama_Kelas; ?></option>
                          <?php } ?>
                      </select>
                       <?= form_error('id_kelas','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <select name="id_prodi" class="form-control" id="id_prodi"  value="<?= set_value('id_prodi'); ?>">
                          <option value="id_prodi[]">-- Pilih Prodi --</option>
                          <?php 
                          $sql = $this->db->get('tb_prodi');
                          foreach ($sql->result() as $row) {
                           ?>
                          <option value="<?php echo $row->id; ?>"><?php echo $row->Nama_Prodi; ?></option>
                          <?php } ?>
                      </select>
                       <?= form_error('id_prodi','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="tahun_akamedik" name="tahun_akamedik"  placeholder="Tahun Akademik"  value="<?= set_value('tahun_akamedik'); ?>">
                       <?= form_error('tahun_akamedik','<small class="text-danger pl-3">', '</small>'); ?>
                  
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-user" id="agama_mahasiswa" name="agama_mahasiswa"  placeholder="Agama Mahasiswa"  value="<?= set_value('agama_mahasiswa'); ?>">
                         <?= form_error('agama_mahasiswa','<small class="text-danger pl-3">', '</small>'); ?>
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-user" id="agama_ayah" name="agama_ayah"  placeholder="Agama Ayah"  value="<?= set_value('agama_ayah'); ?>">
                         <?= form_error('agama_ayah','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-4">
                        <input type="text" class="form-control form-control-user" id="agama_ibu" name="agama_ibu"  placeholder="Agama Ibu"  value="<?= set_value('agama_ibu'); ?>">
                         <?= form_error('agama_ibu','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="text" class="form-control form-control-user" id="email" name="email" placeholder="Email"  value="<?= set_value('email'); ?>">
                       <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
                  
                    </div>
                    <div class="form-group row">
                      <div class="col-sm-6 mb-3 mb-sm-0">
                        <input type="password" class="form-control form-control-user" id="password1" name="password1" placeholder="Password"  value="<?= set_value('password1'); ?>">
                         <?= form_error('password1','<small class="text-danger pl-3">', '</small>'); ?>
                  
                      </div>
                      <div class="col-sm-6">
                        <input type="password" class="form-control form-control-user" id="password2" name="password2" placeholder="Ulangi Password"  value="<?= set_value('password2'); ?>">
                         <!-- <?= form_error('password2','<small class="text-danger pl-3">', '</small>'); ?> -->
                  
                      </div>
                    </div>
                    <div class="form-group">
                      <input type="hidden" class="form-control " id="role_id" name="role_id" value="10">
                    </div>
                    
                  </div>
                
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar Akun
                </button>
              </div>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url(''); ?>">Lupa Kata Sandi?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth'); ?>">Halaman Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  
