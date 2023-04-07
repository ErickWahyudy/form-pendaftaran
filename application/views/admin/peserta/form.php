<?php $this->load->view('template/header'); ?>

<a href="" class="btn btn-primary" data-toggle="modal" data-target="#modalTambahpeserta"><i class="fa fa-plus"></i>
    Tambah</a>
<br /><br /><br />
<?= $this->session->flashdata('pesan') ?>
<div class="table-responsive">
    <table id="example1" class="table table-bordered  table-striped">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Alamat</th>
                <th>No HP</th>
                <th>Tgl Daftar</th>
                <th>Nominal Pembayaran</th>
                <th>Bukti Pembayaran</th>
                <th>Tahun Angkatan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php $no=1; foreach($data->result_array() as $peserta): ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $peserta['nama'] ?></td>
                <td><?= $peserta['alamat'] ?></td>
                <td><?= $peserta['no_hp'] ?></td>
                <td><?= tgl_indo($peserta['tgl_daftar']) ?></td>
                <td><?= rupiah($peserta['nominal_pembayaran']) ?></td>
                <td>
                    <img src="<?= base_url('themes/bukti_bayar/'.$peserta['bukti_pembayaran']) ?>" width="100px">
                    <p><?= $peserta['bukti_pembayaran'] ?></p>
                </td>
                <td><?= $peserta['nama_periode'] ?></td>

                <td>
                    <a href="" class="btn btn-warning" data-toggle="modal"
                        data-target="#edit<?= $peserta['id_peserta'] ?>"><i class="fa fa-edit"></i></a>
                </td>
            </tr>
            <?php $no++; endforeach; ?>
        </tbody>
    </table>

    <!-- Modal tambah data peserta-->
    <div class="modal fade" id="modalTambahpeserta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header bg-purple">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="myModalLabel">Tambah <?= $judul ?></h4>
                </div>
                <div class="modal-body table-responsive">
                    <table class="table table-bordered table-striped">
                        <form id="add" method="post">
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama" class="form-control" placeholder="nama" autocomplete="off"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="alamat" class="form-control" placeholder="alamat" autocomplete="off"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp" class="form-control" placeholder="no hp" autocomplete="off">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Daftar</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_daftar" class="form-control" value="<?= date('Y-m-d') ?>"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Nominal Pembayaran</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="nominal_pembayaran" class="form-control" autocomplete="off"
                                        placeholder="nominal pembayaran" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Tahun Angkatan</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_periode" class="form-control" required="">
                                        <option value="">--Pilih Angkatan--</option>
                                        <!-- mengambil data dari periode -->
                                        <?php 
                                          $periode = $this->db->get('periode')->result_array();
                                          foreach($periode as $prd): ?>
                                        <option value="<?= $prd['id_periode'] ?>">
                                            <?= ucfirst($prd['nama_periode']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama Penginput</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="bukti_pembayaran" class="form-control"
                                        value='<?= $this->session->userdata('nama') ?>' readonly>
                                </td>
                            </tr>

                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Submit" class="btn btn-success">
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!-- End Modal -->

    <!-- Modal edit data peserta-->
    <?php foreach($data->result_array() as $peserta): ?>
    <div class="modal fade" id="edit<?= $peserta['id_peserta'] ?>" tabindex="-1" role="dialog"
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
                                <th>ID peserta</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="id_peserta" value="<?= $peserta['id_peserta'] ?>"
                                        class="form-control" readonly>
                                </td>
                            </tr>
                            <tr>
                                <th>Nama</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="nama" value="<?= $peserta['nama'] ?>" class="form-control"
                                        required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Alamat</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="text" name="alamat" value="<?= $peserta['alamat'] ?>"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>No HP</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="no_hp" value="<?= $peserta['no_hp'] ?>"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Tgl Daftar</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="date" name="tgl_daftar" value="<?= $peserta['tgl_daftar'] ?>"
                                        class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Nominal Pembayaran</th>
                            </tr>
                            <tr>
                                <td>
                                    <input type="number" name="nominal_pembayaran"
                                        value="<?= $peserta['nominal_pembayaran'] ?>" class="form-control" required="">
                                </td>
                            </tr>
                            <tr>
                                <th>Tahun Angkatan</th>
                            </tr>
                            <tr>
                                <td>
                                    <select name="id_periode" class="form-control" required="">
                                        <option value="">--Pilih Angkatan--</option>
                                        <!-- mengambil data dari periode -->
                                        <?php 
                                          $periode = $this->db->get('periode')->result_array();
                                          foreach($periode as $prd): ?>
                                        <option value="<?= $prd['id_periode'] ?>"
                                            <?= $prd['id_periode'] == $peserta['id_periode'] ? 'selected' : '' ?>>
                                            <?= ucfirst($prd['nama_periode']) ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                </td>
                            </tr>
                            
                            <tr>
                                <td>
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>
                                    &nbsp;&nbsp;
                                    <input type="submit" name="kirim" value="Simpan" class="btn btn-success"> &nbsp;&nbsp;
                                    <a href="javascript:void(0)" onclick="hapuspeserta('<?= $peserta['id_peserta'] ?>')"
                                        class="btn btn-danger">Hapus</a>
                                </td>
                            </tr>

                        </form>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <?php endforeach; ?>
    <!-- End Modal -->

    <script>
        //add data
        $(document).ready(function () {
        $('#add').submit(function (e) {
            e.preventDefault();
            $.ajax({
                url: "<?= site_url('admin/peserta/api_add') ?>",
                type: "POST",
                data: new FormData(this),
                processData: false,
                contentType: false,
                cache: false,
                async: false,
                success: function (data) {
                    $('#modalTambahpeserta');
                    $('#add')[0].reset();
                    swal({
                        title: "Berhasil",
                        text: "Data berhasil ditambahkan",
                        type: "success",
                        showConfirmButton: true,
                        confirmButtonText: "OKEE",
                    }).then(function () {
                        location.reload();
                    });
                }
            });
        });
    });

        //edit file
        $(document).on('submit', '#edit', function(e) {
        e.preventDefault();
        var form_data = new FormData(this);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/peserta/api_edit/') ?>" + form_data.get('id_peserta'),
            dataType: "json",
            data: form_data,
            processData: false,
            contentType: false,
            //memanggil swall ketika berhasil
            success: function(data) {
                $('#edit' + form_data.get('id_peserta'));
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

        //ajax hapus peserta
        function hapuspeserta(id_peserta) {
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
                    url: "<?php echo site_url('admin/peserta/api_hapus/') ?>" + id_peserta,
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
    </script>

    <?php $this->load->view('template/footer'); ?>

<?php 

function rupiah($angka){
  $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
  return $hasil_rupiah;
}

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
  return $pecahkan[2] . ' ' . $bulan[ (int)$pecahkan[1] ] . ' ' . $pecahkan[0];
}
?>