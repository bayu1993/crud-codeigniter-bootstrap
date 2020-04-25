<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css') ?>">
    <title><?php echo $title ?></title>
</head>

<body>
    <div class="container">
        <div class="card p-5 mt-5 mb-5">
            <div class="row">
                <div class="col-lg-4">
                    <a href="#" role="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#create">Tambah Data</a>
                </div>
            </div>
            <div class="row mt-3 justify-content-md-center">
                <div class="col-lg-12">
                    <?php

                    $title = $this->session->flashdata('title') ?? false;
                    $msg = $this->session->flashdata('msg') ?? false;
                    $classbs = $this->session->flashdata('classbs') ?? false;

                    if ($title && $msg) {

                        echo "<div class='alert $classbs alert-dismissible fade show' role='alert'>
                            <strong>$title</strong> $msg
                            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                                <span aria-hidden='true'>&times;</span>
                            </button>
                        </div>";
                    }
                    ?>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                    <th>JURUSAN</th>
                                    <th>FAKULTAS</th>
                                    <th>ANGKATAN</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                if (empty($mhs)) {
                                ?>
                                    <tr>
                                        <td class="text-center" colspan="7">Tidak ada data</td>
                                    </tr>
                                    <?php
                                } else {
                                    $no = 1;
                                    foreach ($mhs as $row) {
                                    ?>
                                        <tr>
                                            <td class="text-center"><?php echo $no++ ?></td>
                                            <td><?php echo $row->nim ?></td>
                                            <td><?php echo $row->nama ?></td>
                                            <td><?php echo $row->jurusan ?></td>
                                            <td><?php echo $row->fakultas ?></td>
                                            <td><?php echo $row->angkatan ?></td>
                                            <td class="text-center">
                                                <a href="#" data-toggle="modal" data-target="#update" data-nim="<?php echo $row->nim; ?>" data-nama="<?php echo $row->nama; ?>" data-jur="<?php echo $row->jurusan; ?>" data-fak="<?php echo $row->fakultas; ?>" data-akt="<?php echo $row->angkatan; ?>" class="btn btn-info">Ubah</a>
                                                <a href="#" data-toggle="modal" data-target="#delete" data-nim="<?php echo $row->nim; ?>" class="btn btn-danger">Hapus</a>
                                            </td>
                                        </tr>
                                <?php
                                    }
                                }

                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="createLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createLabel">Data Mahasiswa Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center">
                        <div class="col-10 ">
                            <?php echo form_open(base_url('index.php/add')); ?>
                            <div class="form-group">
                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "number",
                                    "placeholder" => "Nim",
                                    "id" => "nim",
                                    "name" => "nim",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "text",
                                    "placeholder" => "Nama",
                                    "name" => "nama",
                                    "id" => "nama",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                            <div class=" form-group">

                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "text",
                                    "placeholder" => "Jurusan",
                                    "name" => "jur",
                                    "id" => "jur",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>

                            </div>
                            <div class=" form-group">

                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "text",
                                    "placeholder" => "Fakultas",
                                    "name" => "fak",
                                    "id" => "fak",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                            <div class=" form-group">

                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "number",
                                    "name" => "akt",
                                    "id" => "akt",
                                    "placeholder" => "Angkatan",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                    $data = [
                        "class" => "btn btn-primary",
                        "type" => "submit",
                        "value" => "Simpan"
                    ];
                    echo form_submit($data);
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="updateLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateLabel">Ubah Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center">
                        <div class="col-10 ">
                            <?php echo form_open(base_url('index.php/ubah')); ?>
                            <div class="form-group">
                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "number",
                                    "placeholder" => "Nim",
                                    "id" => "nim",
                                    "name" => "nim",
                                    "required" => "required",
                                    "readonly" => "readonly"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                            <div class="form-group">
                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "text",
                                    "placeholder" => "Nama",
                                    "name" => "nama",
                                    "id" => "nama",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                            <div class=" form-group">

                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "text",
                                    "placeholder" => "Jurusan",
                                    "name" => "jur",
                                    "id" => "jur",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>

                            </div>
                            <div class=" form-group">

                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "text",
                                    "placeholder" => "Fakultas",
                                    "name" => "fak",
                                    "id" => "fak",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                            <div class=" form-group">

                                <?php
                                $data = [
                                    "class" => "form-control",
                                    "type" => "number",
                                    "name" => "akt",
                                    "id" => "akt",
                                    "placeholder" => "Angkatan",
                                    "required" => "required"
                                ];
                                echo form_input($data);
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <?php
                    $data = [
                        "class" => "btn btn-primary",
                        "type" => "submit",
                        "value" => "Ubah"
                    ];
                    echo form_submit($data);
                    echo form_close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteLabel">Konfirmasi Hapus Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row justify-content-md-center">
                        <div class="col-10 ">
                            <p>Apakah anda yakin ingin menghapus data ini?</p>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <a id="btn-delete" href="<?php echo base_url('index.php/hapus/' . $row->nim) ?>" class="btn btn-danger">Hapus</a>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="<?php echo base_url('assets/js/bootstrap.min.js') ?>" text="text/javascript"></script>
<script type="text/javascript">
    $('#update').on('show.bs.modal', function(event) {
        let data = {
            nim: $(event.relatedTarget).data('nim'),
            nama: $(event.relatedTarget).data('nama'),
            jur: $(event.relatedTarget).data('jur'),
            fak: $(event.relatedTarget).data('fak'),
            akt: $(event.relatedTarget).data('akt'),

        }
        console.log(data);
        $(this).find('#nim').val(data.nim);
        $(this).find('#nama').val(data.nama);
        $(this).find('#jur').val(data.jur);
        $(this).find('#fak').val(data.fak);
        $(this).find('#akt').val(data.akt);
    })
    $('#delete').on('show.bs.modal', function(event) {
        let data = $(event.relatedTarget).data('nim');
        console.log(data);
        $(this).find('#btn-delete').attr('href', '<?php echo base_url('index.php/hapus/') ?>'.$data);
    })
</script>

</html>