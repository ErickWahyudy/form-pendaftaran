<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Informasi</th>
                <th>File</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $informasi): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $informasi['title'] ?></td>
                <td><a href="" class="btn btn-xs btn-warning" data-toggle="modal" data-target="#edit<?= $informasi['id_informasi'] ?>"><i class="fa fa-edit"></i></a> <br>
                    <?= $informasi['informasi'] ?>
                </td>
                <td><a href="" class="btn btn-xs btn-warning" data-toggle="modal"
                        data-target="#editfile<?= $informasi['id_informasi'] ?>"><i class="fa fa-edit"></i></a>
                    <img src="<?= base_url('themes/file_informasi/'.$informasi['file_informasi']) ?>" width="120px">
                </td>

            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal edit judul-->
    <?php foreach($data->result_array() as $informasi): ?>
    <div class="modal fade" id="edit<?= $informasi['id_informasi'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content modal-lg">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="edit" method="post">
                            <input type="hidden" name="id_informasi" value="<?= $informasi['id_informasi'] ?>">
                            <tr>
                                <th class="">Judul</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="title"
                                        value="<?= $informasi['title'] ?>" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th class="">Informasi</th>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="informasi" class="form-control ckeditor" id="ckeditor"><?= $informasi['informasi'] ?></textarea>
                            </tr>
 

                            <tr>
                                <td>
                                    <button href="" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal edit judul-->

    <!-- Modal edit file-->
    <?php foreach($data->result_array() as $informasi): ?>
    <div class="modal fade" id="editfile<?= $informasi['id_informasi'] ?>" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Edit <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="editfile" method="post">
                        <input type="hidden" name="id_informasi" value="<?= $informasi['id_informasi'] ?>" class="form-control" readonly>
                            <tr>
                                <th class="">File</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="file" id="bukti_logo" class="form-control" onchange="previewLOGO()">
                                    <img id="preview_logo" alt="image preview" width="50%" />
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <button href="" class="btn btn-warning" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    

    <script>
   
     //edit informasi
     $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('panitia/informasi/api_edit/') ?>" + form_data.get('id_informasi'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_informasi'));
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Diubah",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            },
            //memanggil swall ketika gagal
            error: function(data) {
                swal({
                    title: "Gagal",
                    text: "Data Gagal Diubah",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            }
        });
    });

    //upload file
    $(document).on('submit', '#editfile', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('panitia/informasi/api_upload/') ?>" + form_data.get('id_informasi'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#editfile' + form_data.get('id_informasi'));
                swal({
                    title: "Berhasil",
                    text: "Data Berhasil Diubah",
                    type: "success",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            },
            //memanggil swall ketika gagal
            error: function(data) {
                swal({
                    title: "Gagal",
                    text: "Data Gagal Diubah",
                    type: "error",
                    showConfirmButton: true,
                    confirmButtonText: "OKEE",
                }).then(function() {
                    location.reload();
                });
            }
        });
    });

    //preview Logo
    function previewLOGO() {
    document.getElementById("preview_logo").style.display = "block";
    var oFReader = new FileReader();
    oFReader.readAsDataURL(document.getElementById("bukti_logo").files[0]);

    oFReader.onload = function(oFREvent) {
        document.getElementById("preview_logo").src = oFREvent.target.result;
    };

};
    </script>
    <script type="text/javascript" src="<?php echo base_url('themes/admin/ckeditor/ckeditor.js')?>"></script>
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