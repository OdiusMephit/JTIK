<div class="table-responsive">
  <table class="table datatable-basic" width="100%">
    <thead>
      <tr>
        <th scope="col">No</th>
        <th scope="col">Hari</th>
        <th scope="col">Tanggal</th>
        <th scope="col">Kelas</th>
        <th scope="col">Mata Kuliah</th>
        <th scope="col">Jam Mulai</th>
        <th scope="col">Jam Selesai</th>
        <th scope="col">Ruangan</th>
        <th scope="col">Dibuat Oleh</th>
        <th scope="col">Tanggal Pengajuan</th>
        <th scope="col">Status</th>
        <th scope="col"><center></center></th>

      </tr>
    </thead>
    <tbody>

      <?php $no = 1; 
      foreach ($list as $key) :?>

      <tr>
        <th scope="row"><?php echo $no++; ?></th>
        <td><?php echo $key['hari'] ?></td>
        <td><?php echo $key['tanggal'] ?></td>
        <td><?php echo $key['kelas_kode_kelas'] ?></td>
        <td><?php echo $key['matakuliah_kode_mtk'] ?></td>
        <td><?php echo $key['jam_mulai'] ?></td>
        <td><?php echo $key['jam_selesai'] ?></td>
        <td><?php echo $key['ruang_kelas'] ?></td>
        <td><?php echo $key['Dibuat_Oleh'] ?></td>
        <td><?php echo $key['Tanggal_Pengajuan'] ?></td>
        <td><?php echo $key['status'] ?></td>
     

         <td style="text-align: center;">
            <a href="#" class="btn btn-success btn-circle" onclick="edit('<?php echo $key['id_pengganti'] ?>')">
              <i class="fas fa-edit"></i></a>
            <a href="#" class="btn btn-danger btn-circle" onclick="hapus('<?php echo $key['id_pengganti'] ?>')"><i class="fas fa-trash"></i></a>
         </td>
      </tr>
      <?php endforeach; ?>

    </tbody>
  </table>
</div>
<script type="text/javascript">
  $(document).ready(function(){
    $('#table').DataTable();
  })
  function edit(id_pengganti) {
    $.ajax({
        type: 'POST',
        data:{
          id: id_pengganti
        },
        url: '<?php echo base_url() ?>jadwalpengganti/edit/',
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

  function hapus(id_pengganti) {
    Swal.fire({
      title: 'Konfirmasi ?',
      text: "Apakah anda yakin ingin menghapus data ?",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Ya !',
      cancelButtonText: 'Tidak !',
    }).then((result) => {
      if (result.value) {
        $.ajax({
          url:"<?php echo base_url(); ?>jadwalpengganti/delete",
          method:"POST",
          data: {
            id: id_stok_produk
          },
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
          success:function(data){
            $.unblockUI();
            var obj = JSON.parse(data);
            if(obj[0]) {
              Swal.fire({
                title: obj[1],
                text: obj[2],
                icon: 'success',
                showCancelButton: false,
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ok'
              }).then((result) => {
                if (result.value) {
                  tampil();
                }
              })
            } else {
              Swal.fire({
                icon: 'error',
                title: obj[1],
                text: obj[2],
              })
            }
          }
        })
      }
    })
  }
</script>
