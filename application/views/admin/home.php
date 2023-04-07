<?php $this->load->view('template/header'); ?>

<?php
 if($this->session->userdata('level') == "Administrator" ){

  $kode_tahun = date('Y');
 ?>
<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

<div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $panitia;?></h3>

              <p>Data Panitia</p>
            </div>
            <div class="icon">
              <i class="fa fa-send"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $peserta;?></h3>

              <p>Data Peserta</p>
            </div>
            <div class="icon">
             <i class="fa fa-users"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>


        <div class="col-lg-3 col-xs-6">
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= rupiah($sum_pembayaran);?></h3>

              <p>Total Pembayaran Terkumpul</p>
            </div>
            <div class="icon">
             <i class="fa fa-dollar"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        

 
              <div class="chart">
                <canvas id="barChart" style="height:230px"></canvas>
              </div>
            

<?php }elseif($this->session->userdata('level') == "PLG"){ ?>

<div class="container"><?= $this->session->flashdata('pesan'); ?></div>

<div class="callout callout-success">
                <h4><i class="fa fa-cubes"></i>Selamat Datang </h4>

                <p>Anda Login Sebagai Pelanggan Silahkan Pilih Menu Di Samping Untuk Menggunakan Sistem</p>
              </div>


<?php 
} 

function rupiah($angka){
  
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
 
}

?>

<?php $this->load->view('template/footer'); ?>