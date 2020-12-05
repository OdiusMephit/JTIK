<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

  <?= $this->session->flashdata('message') ?>

  <!-- Nav tabs -->
  <ul class="nav nav-pills" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pengajar" role="tab" aria-controls="home" aria-selected="true">Pengajar</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="profile-tab" data-toggle="tab" href="#mahasiswa" role="tab" aria-controls="profile" aria-selected="false">Mahasiswa</a>
    </li>
  </ul>

  <br>

  <div class="tab-content" id="myTabContent">
    <div class="tab-pane fade show active" id="pengajar" role="tabpanel" aria-labelledby="home-tab">
      <div class="table-responsive">
        <table class="table table-hover datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th data-sortable="false" data-searchable="false">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users_pengajar as $index => $user) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $user['nama'] ?></td>
                <td><?= $user['email'] ?></td>
                <td><?= $user['role'] ?></td>
                <td>
                  <?php if ($user['status'] == 1) : ?>
                    <span class="badge badge-success">Aktif</span>
                  <?php else : ?>
                    <span class="badge badge-secondary">Tdk. Aktif</span>
                  <?php endif ?>
                </td>
                <td>
                  <button class="btn btn-sm btn-info text-nowrap" data-id_user="<?= $user['id_user'] ?>" data-nama="<?= $user['nama'] ?>" data-role_id="<?= $user['role_id'] ?>" onclick="editRole(this)">Edit Role</button>
                </td>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </div>
    <div class="tab-pane fade" id="mahasiswa" role="tabpanel" aria-labelledby="profile-tab">
      <div class="table-responsive">
        <table class="table table-hover datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Nama</th>
              <th>Email</th>
              <th>Role</th>
              <th>Status</th>
              <th data-sortable="false" data-searchable="false">Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($users_mahasiswa as $index => $user) : ?>
              <tr>
                <td><?= $index + 1 ?></td>
                <td><?= $user['nama'] ?></td>
                <td><?= $user['email'] ?></td>
                <td>Mahasiswa</td>
                <td>
                  <?php if ($user['status'] == 1) : ?>
                    <span class="badge badge-success">Aktif</span>
                  <?php else : ?>
                    <span class="badge badge-secondary">Tdk. Aktif</span>
                  <?php endif ?>
                </td>
                <td>
                  <button class="btn btn-sm btn-info text-nowrap" data-id_user="<?= $user['id_user'] ?>" data-nama="<?= $user['nama'] ?>" data-role_id="<?= $user['role_id'] ?>" data-status="<?= $user['status'] ?>" onclick="editStatus(this)">Edit Status</button>
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

<!-- Edit Role Modal-->
<div class="modal fade" id="modal-role" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Role User</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('superadmin/set_role_user') ?>
        <input type="hidden" name="id_user" id="id_user" value="0">
        <div class="form-group row">
          <label class="col-3 col-form-label" for="nama">Nama</label>
          <div class="col-7">
            <p class="form-control-plaintext mb-0" id="nama"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-3 col-form-label" for="role_id">Role</label>
          <div class="col-7">
            <select name="role_id" id="role_id" class="form-control" required>
              <?php foreach ($roles as $role) : ?>
                <option value="<?= $role['id'] ?>"><?= $role['Nama_Role'] ?></option>
              <?php endforeach ?>
            </select>
          </div>
        </div>
        <div>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<!-- /Edit Role Modal-->

<!-- Edit Status Modal-->
<div class="modal fade" id="modal-status" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edit Status User</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <?= form_open('superadmin/set_status_user') ?>
        <input type="hidden" name="id_user" id="id_user2" value="0">
        <div class="form-group row">
          <label class="col-3 col-form-label" for="nama2">Nama</label>
          <div class="col-7">
            <p class="form-control-plaintext mb-0" id="nama2"></p>
          </div>
        </div>
        <div class="form-group row">
          <label class="col-3 col-form-label" for="status">Status</label>
          <div class="col-7">
            <select name="status" id="status" class="form-control" required>
              <option value="1">Aktif</option>
              <option value="0">Tidak Aktif</option>
            </select>
          </div>
        </div>
        <div>
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
        <?= form_close() ?>
      </div>
    </div>
  </div>
</div>
<!-- /Edit Status Modal-->

<script>
  function editRole(btn) {
    var id_user = $(btn).data('id_user');
    var nama = $(btn).data('nama');
    var role_id = $(btn).data('role_id');
    $('#id_user').val(id_user);
    $('#nama').text(nama);
    $('#role_id').val(role_id);
    $('#modal-role').modal('show');
  }
  function editStatus(btn) {
    var id_user = $(btn).data('id_user');
    var nama = $(btn).data('nama');
    var status = $(btn).data('status');
    $('#id_user2').val(id_user);
    $('#nama2').text(nama);
    $('#status').val(status);
    $('#modal-status').modal('show');
  }
</script>