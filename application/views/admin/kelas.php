<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message') ?>

    <div class="row align-items-end">
        <div class="col-12 col-lg-2 col-xl-2">
            <button class="btn btn-primary" data-toggle="modal" data-target="#modal-export-mhs">Tambah Kelas</button>
        </div>
    </div>
    <br>
    <div class=" card border-0 shadow-sm">
        <div class="card-body">
            <h2 class="h3 mb-3">Daftar Kelas</h2>
            <div class="table-responsive">
                <table class="table table-hover datatable">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Kelas</th>
                            <th>Nama Prodi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($daftar_kelas as $index => $p) : ?>
                            <tr>
                                <td><?= $index + 1 ?></td>
                                <td><?= $p['Nama_Kelas'] ?></td>
                                <td><?= $p['Nama_Prodi'] ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-export-mhs" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Input Data Kelas</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <?= form_open('admin/tambah_kelas') ?>
                    <div class="form-group row">
                        <label class="col-4 col-form-label" for="from">Nama Kelas.</label>
                        <div class="col-8">
                            <input type="text" name="Nama_Kelas" id="from" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-4 col-form-label" for="id_kelas">Nama Prodi</label>
                        <div class="col-12 col-lg-8 col-xl-8">
                            <select name="prodi_id" class="form-control" id="prodi">
                                <option value="prodi">-- Pilih Prodi --</option>
                                <?php
                                $sql = $this->db->get('tb_prodi');
                                foreach ($sql->result() as $row) {
                                ?>
                                    <option value="<?php echo $row->id; ?>"><?php echo $row->Nama_Prodi; ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-8 offset-4">
                            <button type="submit" class="btn btn-primary">
                                Simpan
                                <i class="fas fa-file-save"></i>
                            </button>
                        </div>
                    </div>
                    <?= form_close() ?>
                </div>
            </div>
        </div>
    </div>
</div>