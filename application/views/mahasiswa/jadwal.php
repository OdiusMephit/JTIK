<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-flex mb-4">
        <h1 class="h3 mb-0 mr-auto text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message') ?>
    <?php function removeZero($jam)
    {
        return date('H:i', strtotime($jam));
    } ?>

    <div class="table-responsive bg-white">
        <table class="table table-hover table-bordered table-striped">
            <thead>
                <tr class="text-center">
                    <th></th>
                    <?php foreach ($hari as $h) : ?>
                        <th><?= $h ?></th>
                    <?php endforeach ?>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($jam_mulai as $index => $j) : ?>
                    <tr>
                        <td class="text-center"><?= removeZero($j) ?> - <?= removeZero($jam_selesai[$index]) ?></td>
                        <?php foreach ($hari as $h): ?>
                            <td>
                                <?php if ($jadwal[$j][$h]): ?>
                                    <strong><?= $jadwal[$j][$h]['matakuliah_kode_mtk'] ?></strong>
                                    <br>
                                    Ruang: <?= $jadwal[$j][$h]['ruang_kelas'] ?>
                                <?php endif ?>
                            </td>
                        <?php endforeach ?>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<!-- /.container-fluid -->