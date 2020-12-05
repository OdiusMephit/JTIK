<div class="container-fluid">
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>

    <?= $this->session->flashdata('message') ?>


    <?php
    foreach ($data as $data) {
        $Bulan[] = $data->Bulan;
        $Alfa[] = (float) $data->total;
    }
    ?>
    <canvas id="canvas" width="1000" height="280"></canvas>
    <script type="text/javascript" src="<?php echo base_url() . 'assets/chartjs/chart.min.js' ?>"></script>
    <script>
        var barChartData = {
            labels: <?php echo json_encode($Bulan); ?>,
            datasets: [{
                    fillColor: "rgba(220,220,220,0.5)",
                    strokeColor: "rgba(220,220,220,1)",
                    data: <?php echo json_encode($Alfa); ?>
                }
                // {
                //     fillColor: "rgba(220,220,220,0.5)",
                //     strokeColor: "rgba(120,226,220,1)",
                //     data: <?php echo json_encode($Alfa); ?>
                // },
                // {
                //     fillColor: "rgba(151,187,205,0.5)",
                //     strokeColor: "rgba(151,187,205,1)",
                //     data: <?php echo json_encode($Alfa); ?>
                // }
            ]

        }

        var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);
    </script>
</div>