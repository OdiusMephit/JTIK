<div class="container-fluid">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header" style="background-color: white;">
        <div id="infoMessage" class="text-center"><?= $this->session->flashdata('message'); ?></div>
        <div class="row">
          <div class="col-md-3" align="left">
            <a href="<?= base_url('jadwalpengganti/add');?>" class="btn btn-success btn-sm" title="Tambah" ">Buat</a>
            <a href="<?= base_url('jadwalpengganti/load_table');?>" class="btn btn-primary btn-sm" title="Reload">Muat Data</a>
          </div>
        </div>
      </div>
      <div class="card-body">
          <div id="content_data"></div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
  $(document).ready(function() {
    tampil();
  })
  function tampil() {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url() ?>jadwalpengganti/load_table',
      beforeSend: function(data) {
        $.blockUI({
          message: 'Mohon tunggu !',
          overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
          },
          css: {
            border: 0,
            color: '#fff',
            zIndex: 1201,
            padding: 0,
            backgroundColor: 'transparent'
          }
        });
      },
      error: function (data) {
        $.unblockUI();
        alert('Opps, gagal memuat data!', 'info')
      },
      success: function (data) {
        $.unblockUI();
        $('#content_data').html(data);
      }
    })
  }

  function add() {
    $.ajax({
      type: 'POST',
      url: '<?php echo base_url() ?>jadwalpengganti/add',
      beforeSend: function(data) {
        $.blockUI({
          message: 'Mohon tunggu !',
          overlayCSS: {
            backgroundColor: '#1b2024',
            opacity: 0.8,
            zIndex: 1200,
            cursor: 'wait'
          },
          css: {
            border: 0,
            color: '#fff',
            zIndex: 1201,
            padding: 0,
            backgroundColor: 'transparent'
          }
        });
      },
      error: function (data) {
        $.unblockUI();
        alert('Opps, gagal memuat data!', 'info')
      },
      success: function (data) {
        $.unblockUI();
        $('#content_data').html(data);
      }
    })
  }
</script>
