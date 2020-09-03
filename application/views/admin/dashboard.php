<div class="container-fluid">
	<div class="row">
    <?php $levelUser = $this->session->userdata('level'); if(in_array(1, $levelUser)) { ?>
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-info">
          <div class="inner">
            <h3><?= $this->lib->seluruh_siswa(); ?></h3>

            <p>Jumlah Siswa</p>
          </div>
          <div class="icon">
            <i class="ion ion-person"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-success">
          <div class="inner">
            <h3>53<sup style="font-size: 20px">%</sup></h3>

            <p>Bounce Rate</p>
          </div>
          <div class="icon">
            <i class="ion ion-stats-bars"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-warning">
          <div class="inner">
            <h3>44</h3>

            <p>User Registrations</p>
          </div>
          <div class="icon">
            <i class="ion ion-person-add"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
      <div class="col-lg-3 col-6">
        <!-- small box -->
        <div class="small-box bg-danger">
          <div class="inner">
            <h3>65</h3>

            <p>Unique Visitors</p>
          </div>
          <div class="icon">
            <i class="ion ion-pie-graph"></i>
          </div>
          <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
        </div>
      </div>
      <!-- ./col -->
    <?php } elseif(in_array(7, $levelUser)) { ?>      
      <div class="col-md-3 card" style="margin-left: 5px; height: 550px;">
        <div class="card-header">
          <h3 class="card-title">Tugas Terbaru</h3>
        </div>
      </div>
      <div class="col-md-3 card" style="margin-left: 5px; margin-right: 5px;">
        <div class="card-header">
          <h3 class="card-title">Pengumuman Terbaru</h3>
        </div>
      </div>
      <div class="col-md-5 card">
        <div class="card-header">
          <h3 class="card-title">Jadwal Kelas Hari Ini</h3>
        </div>
        <div class="card-body" id="daftarKelas" style="overflow:auto;">
          <?= $this->lib->daftarKelasSiswa(); ?>
        </div>
      </div>
    <?php } ?>
  </div>
</div>
