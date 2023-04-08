<?php $this->load->view('template/header'); ?>

<?php
 if($this->session->userdata('level') == "Panitia" ){

 ?>
<?= $this->session->flashdata('pesan'); ?>

<div class="col-lg-3 col-xs-6">
    <!-- small box -->
    <div class="small-box bg-aqua">
        <div class="inner">
            <h3><?= $peserta;?> </h3>

            <p>Peserta</p>
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


    <div class="col-xs-12">
        <div class="box box-default">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="box-header with-border">
                        <i class="fa fa-bullhorn"></i>
                        <b style="font-size: 12pt">LAYANAN INFORMASI</b>
                        <u><a href="<?= base_url('panitia/informasi') ?>">Edit informasi</a></u>
                        <div class="box-tools pull-right">
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table id="example" class="table table-bordered  table-striped">
                            <thead>
                                <tr>
                                    <th>Jenis Informasi</th>
                                    <th>File</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no=1; foreach($informasi->result_array() as $informasi): ?>
                                <tr>
                                    <td><?= $informasi['informasi'] ?></td>
                                    <td>
                                        <img src="<?= base_url('themes/file_informasi/'.$informasi['file_informasi']) ?>" width="100px">
                                    </td>
                                </tr>
                                <?php $no++; endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

<?php $this->load->view('template/footer'); ?>


        <?php } ?>

        <?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}
 
//format tanggal indonesia
function tgl_indo($tanggal){
  $bulan = array (
    1 =>   'Januari',
    'Februari',
    'Maret',
    'April',
    'Mei',
    'Juni',
    'Juli',
    'Agustus',
    'September',
    'Oktober',
    'November',
    'Desember'
  );
  $pecahkan = explode('-', $tanggal);
  
  // variabel pecahkan 0 = tanggal
  // variabel pecahkan 1 = bulan
  // variabel pecahkan 2 = tahun
  
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}

?>