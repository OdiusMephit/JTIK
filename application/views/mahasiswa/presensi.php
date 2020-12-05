<!-- Begin Page Content -->
<div class="container-fluid">
    <div class="d-flex mb-4">
        <h1 class="h3 mb-0 mr-auto text-gray-800"><?= $title; ?></h1>
    </div>

    <?= $this->session->flashdata('message') ?>

    <div class="form-group row">
        <label for="select-camera" class="col-form-label offset-2 col-2">Pilih Kamera:</label>
        <div class="col-6">
            <select id="select-camera" class="form-control" onchange="setCamera()"></select>
        </div>
    </div>
    <div class="row">
        <p class="col-6 offset-3 lead text-center">Scan qr code absensi melalui kamera, pastikan qr code terlihat jelas di bidang berikut</p>
    </div>
    <div id="reader"></div>
</div>
<!-- /.container-fluid -->

<div id="spinner" style="display:none">
    <div class="w-100 h-100 position-fixed d-flex align-items-center justify-content-center" style="left:0;top:0;z-index:666;background-color:rgba(0,0,0,.5)">
        <div class="text-center text-white">
            <img src="<?= site_url('assets/img/spinner-white.svg') ?>" class="img-fluid">
            <h1 class="font-weight-normal mb-1">Loading</h1>
            <p class="lead">Sedang melakukan presensi online</p>
        </div>
    </div>
</div>

<script src="<?= site_url('assets/js/html5-qrcode.min.js') ?>"></script>
<script>
    // This method will trigger user permissions
    Html5Qrcode.getCameras().then(devices => {
        /**
         * devices would be an array of objects of type:
         * { id: "id", label: "label" }
         */
        // console.log(devices);
        if (devices && devices.length) {
            for (var d of devices) {
                var cameraId = d.id;
                var cameraLabel = d.label;
                $('#select-camera').append(`
                    <option value="${cameraId}">
                        ${cameraLabel}
                    </option>
                    `);
            }
            setCamera();
        }
    }).catch(err => {
        // handle err
        alert('Error! Tidak bisa mengakses kamera!');
        console.log(err);
    });

    var html5QrCode = null;

    function setCamera() {
        var cameraId = $('#select-camera').val();
        html5QrCode = new Html5Qrcode('reader');
        html5QrCode.start(
                cameraId, // retreived in the previous step.
                {
                    fps: 10, // sets the framerate to 10 frame per second 
                    // qrbox: 250  // sets only 250 X 250 region of viewfinder to
                    // scannable, rest shaded.
                },
                qrCodeMessage => { // do something when code is read. For example:
                    console.log(`QR Code detected: ${qrCodeMessage}`);
                    sendQr(qrCodeMessage);
                },
                errorMessage => { // parse error, ideally ignore it. For example:
                    console.log(`QR Code no longer in front of camera.`);
                })
            .catch(err => { // Start failed, handle it. For example, 
                console.log(`Unable to start scanning, error: ${err}`);
            });
    }

    function stopScanning() {
        if (html5QrCode) {
            html5QrCode.stop().then(ignore => {
                // QR Code scanning is stopped. 
                console.log('QR Code scanning stopped.');
            }).catch(err => {
                // Stop failed, handle it. 
                console.log('Unable to stop scanning.');
            });
        }
    }

    function dummyScan() {
        sendQr('mtk-1193-20200702-074357')
    }

    var sendingQr = false
    function sendQr(qr) {
        if (sendingQr) {
            return;
        }

        sendingQr = true;

        $('#spinner').show();
        $.ajax({
            url: '<?=base_url('mahasiswa/presensi')?>',
            method: 'POST',
            data: {
                qr
            }
        })
        .then(res => {
            res = JSON.parse(res);
            alert(res.message);
        })
        .fail(err => {
            alert('Error! Gagal melakukan presensi online. Silahkan coba refresh halaman');
            console.log(err);
        })
        .always(() => {
            $('#spinner').hide();
            setTimeout(() => {
                sendingQr = false;
            }, 5000);
        })
    }
</script>