<div class="container-fluid">

          <!-- Content Row -->
          <div class="row">

            <!-- Kelas -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">Kelas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_kelas; ?>
                      </div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-graduation-cap fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Ruang Kelas -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Ruang Kelas</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_ruangkelas; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-school fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- Matkul -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">Matkul</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_matkul; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-book fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <!-- jumlah user -->
            <div class="col-xl-3 col-md-6 mb-4">
              <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                  <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                      <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">User</div>
                      <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $jml_user; ?></div>
                    </div>
                    <div class="col-auto">
                      <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Content Row -->
          <div class="row">

            <div class="col-lg-6 mb-4">

              <!-- Illustrations -->
              <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Online Users</h6>
                  <h7 class="m-0 text-primary">5 menit terakhir</h7>
                </div>
                <div class="card-body">
                  <div class="text-center">
                    <img class="img-fluid px-3 px-sm-4 mt-3 mb-4" style="width: 10rem;" src="img/undraw_posting_photo.svg" alt="">
                  </div>
                <div class="panel-body">
                  <table class="table datatable-basic" width="10%">
                    <thead>
                      <tr>
                        <th></th>
                      </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($user_log->result() as $baris) {
                        ?>
                          <tr>
                            <td><?php echo $baris->email; ?></td>
                            <td><?= date('d M Y H:i', strtotime($baris->waktu)) ?></td>
                          </tr>
                        <?php
                        } ?>
                    </tbody>
                  </table>
                </div>
                <!--   <a target="_blank" rel="nofollow" href="https://undraw.co/">Browse Illustrations on unDraw &rarr;</a> -->
                </div>
              </div>

              <!-- Approach -->
      <!--         <div class="card shadow mb-4">
                <div class="card-header py-3">
                  <h6 class="m-0 font-weight-bold text-primary">Development Approach</h6>
                </div>
                <div class="card-body">
                  <p>SB Admin 2 makes extensive use of Bootstrap 4 utility classes in order to reduce CSS bloat and poor page performance. Custom CSS classes are used to create custom components and custom utility classes.</p>
                  <p class="mb-0">Before working with this theme, you should become familiar with the Bootstrap framework, especially the utility classes.</p>
                </div>
              </div> -->

            </div>
          </div>

        </div>