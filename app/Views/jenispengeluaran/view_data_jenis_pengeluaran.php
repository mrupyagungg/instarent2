<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data Jenis Pengeluaran</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Jenis Pengeluaran</a></li>
                            <li class="breadcrumb-item active">Data Jenis Pengeluaran</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="row">
                            <div class="pl-3 mb-4">
                                <button type="button" class="btn btn-block btn-primary" data-toggle="modal" data-target="#addModal">Tambah</button>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Jenis Pengeluaran</th>
                                        <th>Nama Jenis Pengeluaran</th>
                                        <th>Coa</th>
                                        <th class="text-center"><i class="fa fa-cog fa-spin"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($jenispengeluaran as $data) : ?>
                                        <tr>
                                            <td> <?= $no++ ?> </td>
                                            <td> <?= $data['id_jenis_pengeluaran'] ?> </td>
                                            <td> <?= $data['nama_jenis_pengeluaran'] ?> </td>
                                            <td> <?= $data['id_akun'] ?> - <?= $data['nama_akun'] ?> </td>
                                            <td class="text-center">
                                                <a type="button" data-toggle="modal" data-target="#edit<?= $data['id_jenis_pengeluaran']; ?>" class="btn btn-warning btn-sm text-white"><i class="fa fa-edit"></i></a>                                           
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<!-- Modal for Adding -->
<div id="addModal" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title text-white" id="addModalLabel">Tambah <?= $title ?></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('jenispengeluaran/add') ?>" method="POST" class="no-validated">
                    <?= csrf_field(); ?>
                    <div>
                        <div class="mb-3">
                            <label class="form-label">Kode Jenis Pengeluaran</label>
                            <input type="text" class="form-control" name="id_jenis_pengeluaran" value="<?= $id_jenis_pengeluaran ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Jenis Pengeluaran</label>
                            <input type="text" class="form-control" name="nama_jenis_pengeluaran" placeholder="Nama Jenis Pengeluaran" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Coa</label>
                            <select class="form-control" name="id_akun" required>
                                <option value="" disabled selected>--- Pilih Coa ---</option>
                                <?php foreach ($coa as $list) { ?>
                                    <option value="<?= $list['id_akun'] ?>"><?= $list['id_akun'] ?> - <?= $list['nama_akun'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-2 mt-1">
                            <div class="float-right">
                                <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-close-thick fa-lg"></i> Batal</button>
                                <button type="submit" class="btn btn-secondary"><i class="mdi mdi-content-save-move fa-lg"></i> Simpan</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Edit Modal -->
<?php foreach ($jenispengeluaran as $data) : ?>
    <div id="edit<?= $data['id_jenis_pengeluaran']; ?>" class="modal fade" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title text-white" id="editModalLabel">Edit <?= $title ?></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('jenispengeluaran/edit') ?>" method="POST" class="no-validated">
                        <div class="mb-3">
                            <label class="form-label">Kode Jenis Pengeluaran</label>
                            <input type="text" class="form-control" name="id_jenis_pengeluaran" value="<?= $data['id_jenis_pengeluaran'] ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Jenis Pengeluaran</label>
                            <input type="text" class="form-control" name="nama_jenis_pengeluaran" value="<?= $data['nama_jenis_pengeluaran'] ?>" placeholder="Nama Jenis Pengeluaran" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Coa</label>
                            <select name="id_akun" class="form-control">
                                <option value="" disabled selected>--- Pilih Coa ---</option>
                                <?php foreach ($coa as $list) { ?>
                                    <option <?php if ($list['id_akun'] == $data['id_akun']) echo 'selected="selected"'; ?> value="<?= $list['id_akun'] ?>"><?= $list['id_akun'] ?> - <?= $list['nama_akun'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="float-right">
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="mdi mdi-close-thick fa-lg"></i> Batal</button>
                            <button type="submit" class="btn btn-secondary"><i class="mdi mdi-content-save-move fa-lg"></i> Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
<?php endforeach ?>

<?= $this->endSection('content-admin'); ?>
