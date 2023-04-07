<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>

<div class="table-responsive">
 <table id="example" class="table table-bordered  table-striped">
                <thead>
                <tr>
                  <th>Informasi</th>
                  <th>File Informasi</th>
                </tr>
                </thead>
                 <tbody>
                 <?php $no=1; foreach($data->result_array() as $informasi): ?>
                 <tr>
                  <td><?= $informasi['informasi'] ?></td>
                  <td>
                    <img src="<?= base_url('themes/file_informasi/'.$informasi['file_informasi']) ?>" width="100px">
                  </td>
                 </tr>
                 <?php $no++; endforeach; ?>
                 </tbody>
               </table>
<?php $this->load->view('template/footer'); ?>

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