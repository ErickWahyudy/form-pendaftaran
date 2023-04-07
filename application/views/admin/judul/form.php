<?php $this->load->view('template/header'); ?>

<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Judul</th>
                <th>Sub Judul</th>
                <th>Deskripsi</th>
                <th>Foto Logo</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $pengaturan): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $pengaturan['nama_judul'] ?></td>
                <td><?= $pengaturan['sub_judul'] ?></td>
                <td><?= $pengaturan['judul2'] ?></td>
                <td><img src="<?= base_url('themes/foto_logo/'.$pengaturan['foto_logo']) ?>" width="120px">
                    <a href="" class="btn btn-xs btn-warning" data-toggle="modal"
                        data-target="#editlogo<?= $pengaturan['id_judul'] ?>"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <?php $stt = $pengaturan['akses_pendaftaran']  ?>
                        <?php if($stt == 'Buka Akses'){ ?>
                        <span class="label label-success">Buka Akses</span>
                            <?php }elseif($stt == 'Tutup Akses'){ ?>
                            <span class="label label-danger">Tutup Akses</span>
                    <?php } ?>
                    <a href="" class="btn btn-xs btn-warning" data-toggle="modal"
                        data-target="#editstatus<?= $pengaturan['id_judul'] ?>"><i class="fa fa-edit"></i></a>
                </td>
                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $pengaturan['id_judul'] ?>"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal edit judul-->
    <?php foreach($data->result_array() as $pengaturan): ?>
    <div class="modal fade" id="edit<?= $pengaturan['id_judul'] ?>" tabindex="-1" role="dialog"
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
                        <form id="edit" method="post">
                            <tr>
                                <th class="">ID judul</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_judul"
                                        value="<?= $pengaturan['id_judul'] ?>" class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th class="">Judul</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama_judul"
                                        value="<?= $pengaturan['nama_judul'] ?>" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th class="">Sub Judul</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="sub_judul"
                                        value="<?= $pengaturan['sub_judul'] ?>" class="form-control">
                                </td>
                            </tr>
                            <tr>
                                <th class="">Deskripsi</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="judul2" value="<?= $pengaturan['judul2'] ?>"
                                        class="form-control">
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
    <!-- End Modal edit judul-->

    <!-- Modal edit status-->
    <?php foreach($data->result_array() as $pengaturan): ?>
    <div class="modal fade" id="editstatus<?= $pengaturan['id_judul'] ?>" tabindex="-1" role="dialog"
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
                        <form id="editstatus" method="post">
                        <input type="hidden" name="id_judul" value="<?= $pengaturan['id_judul'] ?>" class="form-control" readonly>
                            <tr>
                                <th class="">Status</th>
                            </tr>
                            <tr>
                                <td>
                                <input type="radio" name="akses_pendaftaran" value="Buka Akses" <?php if($pengaturan['akses_pendaftaran'] == 'Buka Akses'){ echo 'checked'; } ?>> Buka Akses
                                <input type="radio" name="akses_pendaftaran" value="Tutup Akses" <?php if($pengaturan['akses_pendaftaran'] == 'Tutup Akses'){ echo 'checked'; } ?>> Tutup Akses
                                </td>
    
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

    <!-- Modal edit logo-->
    <?php foreach($data->result_array() as $pengaturan): ?>
    <div class="modal fade" id="editlogo<?= $pengaturan['id_judul'] ?>" tabindex="-1" role="dialog"
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
                        <form id="editlogo" method="post">
                        <input type="hidden" name="id_judul" value="<?= $pengaturan['id_judul'] ?>" class="form-control" readonly>
                            <tr>
                                <th class="">Logo</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="file" name="foto" id="bukti_logo" class="form-control" onchange="previewLOGO()">
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

     //edit judul
     $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/judul/api_edit/') ?>" + form_data.get('id_judul'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_judul'));
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

    //edit status
    $(document).on('submit', '#editstatus', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/judul/api_editstatus/') ?>" + form_data.get('id_judul'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#editstatus' + form_data.get('id_judul'));
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

    //upload logo
    $(document).on('submit', '#editlogo', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/judul/api_upload/') ?>" + form_data.get('id_judul'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#editlogo' + form_data.get('id_judul'));
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


    //ajax hapus judul
    function hapusjudul(id_judul) {
        swal({
            title: "Apakah Anda Yakin?",
            text: "Data Akan Dihapus",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Ya, Hapus!",
            cancelButtonText: "Tidak, Batalkan!",
            closeOnConfirm: false,
            closeOnCancel: true // Set this to true to close the dialog when the cancel button is clicked
        }).then(function(result) {
            if (result.value) { // Only delete the data if the user clicked on the confirm button
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/judul/api_hapus/') ?>" + id_judul,
                    dataType: "json",
                }).done(function() {
                    swal({
                        title: "Berhasil",
                        text: "Data Berhasil Dihapus",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                }).fail(function() {
                    swal({
                        title: "Gagal",
                        text: "Data Gagal Dihapus",
                        type: "error",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE"
                    }).then(function() {
                        location.reload();
                    });
                });
            } else { // If the user clicked on the cancel button, show a message indicating that the deletion was cancelled
                swal("Batal hapus", "Data Tidak Jadi Dihapus", "error");
            }
        });
    }

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