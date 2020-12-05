<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message') ?>

    <!-- Nav tabs -->
    <ul class="nav nav-pills" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#pengajarhlmn" role="tab" aria-controls="home" aria-selected="true">Pengajar</a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#mahasiswahlmn" role="tab" aria-controls="profile" aria-selected="false">Mahasiswa</a>
        </li>
    </ul>

    <br>

    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="pengajarhlmn" role="tabpanel" aria-labelledby="home-tab">
            <div class="card border-0 shadow-sm">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover datatable">
                            <thead>
                                <tr>
                                    <th data-searchable="false">No</th>
                                    <th>NIM</th>
                                    <th>Nama</th>
                                    <th data-searchable="false">Total Alfa</th>
                                    <th>Lihat Grafik</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($presensi_pengajar as $index => $user) : ?>
                                    <tr>
                                        <td><?= $index + 1 ?></td>
                                        <td><?= $user['NI'] ?></td>
                                        <td><?= $user['nama'] ?></td>
                                        <td><?= $user['nilai_alfa'] ?></td>
                                        <td>
                                            <a href="<?php echo base_url('Kajur/grafik_pengajar/') . $user['NI']  ?>" class="btn btn-sm btn-primary">Grafik</a>
                                        </td>
                                    </tr>
                                <?php endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="mahasiswahlmn" role="tabpanel" aria-labelledby="profile-tab">
            <ul class="nav nav-pills" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#prodi" role="tab" aria-controls="home" aria-selected="true">Prodi</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#semester" role="tab" aria-controls="home" aria-selected="false">Semester</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#kelas" role="tab" aria-controls="home" aria-selected="false">Kelas</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link" id="home-tab" data-toggle="tab" href="#mahasiswa" role="tab" aria-controls="home" aria-selected="false">Mahasiswa</a>
                </li>
            </ul>
            <br>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade" id="prodi" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th data-searchable="false">No</th>
                                            <th>Prodi</th>
                                            <th data-searchable="false">Total Alfa</th>
                                            <th>Lihat Grafik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_prodi as $index => $user) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $user['prodi'] ?></td>
                                                <td><?= $user['nilai_alfa'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Kajur/grafik_prodi/') . $user['id_prodi']  ?>" class="btn btn-sm btn-primary">Grafik</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="semester" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th data-searchable="false">No</th>
                                            <th>Semester</th>
                                            <th data-searchable="false">Total Alfa</th>
                                            <th>Lihat Grafik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_semester as $index => $user) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $user['semester'] ?></td>
                                                <td><?= $user['nilai_alfa'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Kajur/grafik_semester/') . $user['semester']  ?>" class="btn btn-sm btn-primary">Grafik</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="kelas" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th data-searchable="false">No</th>
                                            <th>Kelas</th>
                                            <th data-searchable="false">Total Alfa</th>
                                            <th>Lihat Grafik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($data_kelas as $index => $user) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $user['kelas'] ?></td>
                                                <td><?= $user['nilai_alfa'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Kajur/grafik_kelas/') . $user['id_kelas']  ?>" class="btn btn-sm btn-primary">Grafik</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="mahasiswa" role="tabpanel" aria-labelledby="home-tab">
                    <div class="card border-0 shadow-sm">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover datatable">
                                    <thead>
                                        <tr>
                                            <th data-searchable="false">No</th>
                                            <th>NIM</th>
                                            <th>Nama</th>
                                            <th data-searchable="false">Total Alfa</th>
                                            <th>Lihat Grafik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach ($presensi_mahasiswa as $index => $user) : ?>
                                            <tr>
                                                <td><?= $index + 1 ?></td>
                                                <td><?= $user['NI'] ?></td>
                                                <td><?= $user['nama'] ?></td>
                                                <td><?= $user['nilai_alfa'] ?></td>
                                                <td>
                                                    <a href="<?php echo base_url('Kajur/grafik_mahasiswa/') . $user['NI']  ?>" class="btn btn-sm btn-primary">Grafik</a>
                                                </td>
                                            </tr>
                                        <?php endforeach ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
</div>

<!-- /////////////////PUNYA ORANG -->