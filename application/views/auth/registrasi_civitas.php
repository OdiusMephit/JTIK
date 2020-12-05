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
              <form class="user" method="POST" action="<?= base_url('auth/registrasi_civitas');?>">
                <div class="form-group">
                  <input type="text" class="form-control " id="NI" name="NI" placeholder="Nomor Induk"  value="<?= set_value('NI'); ?>">
                  <?= form_error('NI','<small class="text-danger pl-3">', '</small>'); ?>
                  
                </div>
                <div class="form-group">
                    <input type="text" class="form-control " id="nama" name="nama" placeholder="Nama Lengkap"  value="<?= set_value('nama'); ?>">
                    <?= form_error('nama','<small class="text-danger pl-3">', '</small>'); ?> 
                </div>
                <div class="form-group row">
                  <div class="col-sm-6">
                    <input type="text" class="form-control " id="tempat_lahir_civitas" name="tempat_lahir_civitas" placeholder="Tempat Lahir"  value="<?= set_value('tempat_lahir_civitas'); ?>">
                    <?= form_error('tempat_lahir_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                    
                  </div>
                  <div class="col-sm-6">
                    <input type="date" class="form-control " id="tanggal_lahir_civitas" name="tanggal_lahir_civitas" placeholder="Tanggal Lahir"  value="<?= set_value('tanggal_lahir_civitas'); ?>">
                    <?= form_error('tanggal_lahir_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                    
                  </div>
                </div>
                <div class="form-group">
                  <select id="jenis_kelamin_civitas" name="jenis_kelamin_civitas" class="form-control"  value="<?= set_value('jenis_kelamin_civitas'); ?>">
                    <option>Jenis Kelamin</option>
                    <option value="Perempuan">Perempuan</option>
                    <option value="Laki-Laki">Laki-Laki</option>
                  </select>
                  <?= form_error('jenis_kelamin_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                  
                </div>
                <div class="form-group">
                  <select id="agama" name="agama" class="form-control"  value="<?= set_value('agama'); ?>">
                    <option>Agama</option>
                    <option value="Islam">Islam</option>
                    <option value="Katolik">Katolik</option>
                    <option value="Kristen">Kristen</option>
                    <option value="Protestan">Protestan</option>
                    <option value="Hindhu">Hindhu</option>
                    <option value="Budha">Budha</option>
                    <option value="Konghucu">Konghucu</option>
                  </select>
                  <?= form_error('agama','<small class="text-danger pl-3">', '</small>'); ?>
                  
                </div>
                <div class="form-group">
                  <textarea class="form-control" id="alamat_civitas" name="alamat_civitas" rows="4" cols="50" placeholder="Alamat Lengkap" value="<?= set_value('alamat_civitas'); ?>"></textarea>
                  <?= form_error('alamat_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                  
                </div>
                <div class="form-group row">
                  <div class="col-sm-4">
                    <input type="text" class="form-control " id="kelurahan_civitas" name="kelurahan_civitas" placeholder="Kelurahan"  value="<?= set_value('kelurahan_civitas'); ?>">
                    <?= form_error('kelurahan_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                    
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control " id="kecamatan_civitas" name="kecamatan_civitas" placeholder="Kecamatan"  value="<?= set_value('kecamatan_civitas'); ?>">
                    <?= form_error('kecamatan_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                    
                  </div>
                  <div class="col-sm-4">
                    <input type="text" class="form-control " id="kota_civitas" name="kota_civitas" placeholder="Kota"  value="<?= set_value('kota_civitas'); ?>">
                    <?= form_error('kota_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                    
                  </div>
                </div>
                <div class="form-group">
                  <input type="text" class="form-control " id="tlp_civitas" name="tlp_civitas" placeholder="Nomor Telepon"  value="<?= set_value('tlp_civitas'); ?>">
                  <?= form_error('tlp_civitas','<small class="text-danger pl-3">', '</small>'); ?>
                  
                </div>
                <div class="form-group">
                  <input type="text" class="form-control " id="email" name="email" placeholder="Email"  value="<?= set_value('email'); ?>">
                  <?= form_error('email','<small class="text-danger pl-3">', '</small>'); ?>
                  
                </div>
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="password" class="form-control " id="password1" name="password1" placeholder="Password"  value="<?= set_value('password1'); ?>">
                    <?= form_error('password1','<small class="text-danger pl-3">', '</small>'); ?>
                  </div>
                  <div class="col-sm-6">
                    <input type="password" class="form-control " id="password2" name="password2" placeholder="Ulangi Password"  value="<?= set_value('password2'); ?>">
                   <!--  <?= form_error('password2','<small class="text-danger pl-3">', '</small>'); ?> -->
                    
                  </div>
                </div>
                <div class="form-group">
                      <select name="role_id" class="form-control" id="role_id"  value="<?= set_value('role_id'); ?>">
                          <option value="role_id[]">Role</option>
                          <?php 
                          $sql = $this->db->get('tb_role');
                          foreach ($sql->result() as $row) {
                           ?>
                          <option value="<?php echo $row->id; ?>"><?php echo $row->Nama_Role; ?></option>
                          <?php } ?>
                      </select>
                    </div>
                <button type="submit" class="btn btn-primary btn-user btn-block">
                  Daftar Akun
                </button>
              </form>
              <hr>
              <div class="text-center">
                <a class="small" href="<?= base_url(''); ?>">Lupa Kata Sandi?</a>
              </div>
              <div class="text-center">
                <a class="small" href="<?= base_url('auth');?>">Halaman Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>

  
