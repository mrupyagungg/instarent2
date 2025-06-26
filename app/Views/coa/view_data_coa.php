<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>

<div class="page-content">
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Data COA</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">COA</a></li>
                            <li class="breadcrumb-item active">Data COA</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="pl-3 mb-4">
                                <!-- Correct link for the "Tambah" button -->
                                <a href="<?= base_url('coa/add') ?>" class="btn btn-block btn-primary">Tambah</a>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="table-responsive">
                            <table id="coa" class="table align-middle dt-responsive nowrap table-striped" style="border-collapse: collapse; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Nomor Akun</th>
                                        <th>Nama Akun</th>
                                        <th>Posisi</th>                                      
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($coa as $akun) : ?>
                                        <tr>
                                            <td><?= $akun['id_akun'] ?></td>
                                            <td><?= $akun['nama_akun'] ?></td>
                                            <td>
                                                <?= $akun['posisi_d_c'] === 'd' ? 'Debit' : 'Kredit' ?>
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
        
    </div> 
</div>



<div id="add" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-secondary">
                <h5 class="modal-title text-white" id="staticBackdropLabel">Tambah Data COA</h5>
                <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('coa/add') ?>" method="POST" class="no-validated">
                    <?= csrf_field(); ?>
                    <div class="mb-3">
                        <label class="form-label">Nomor Akun</label>
                        <input type="number" class="form-control" name="id_akun" placeholder="Nomor akun" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Nama Akun</label>
                        <input type="text" class="form-control" name="nama_akun" placeholder="Nama Akun" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Posisi Akun</label>
                        <select name="posisi_d_c" class="form-control" required>
                            <option value="">---Pilih Posisi Akun---</option>
                            <option value="d">Debet</option>
                            <option value="c">Kredit</option>
                        </select>
                    </div>
                    <div class="mb-2 mt-1">
                        <div class="float-right d-none d-sm-block">
                            <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                            <button type="submit" class="btn btn-secondary">Simpan</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>



<?php foreach ($coa as $akun) : ?>
    <div id="edit<?= $akun['id_akun']; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="myCenterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-secondary">
                    <h5 class="modal-title text-white" id="myCenterModalLabel">Edit Data COA</h5>
                    <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                </div>
                <div class="modal-body">
                    <form action="<?= base_url('coa/edit') ?>" method="POST" class="no-validated">
                        <div class="mb-3">
                            <label class="form-label">Nomor Akun</label>
                            <input type="number" class="form-control" name="id_akun" value="<?= $akun['id_akun'] ?>" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Akun</label>
                            <input type="text" class="form-control" name="nama_akun" value="<?= $akun['nama_akun'] ?>" autocomplete="off" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Posisi Akun</label>
                            <select name="posisi_d_c" class="form-control" required>
                                <option value="">---Pilih Posisi Akun---</option>
                                <option value="d" <?= $akun['posisi_d_c'] === 'd' ? 'selected' : '' ?>>Debet</option>
                                <option value="c" <?= $akun['posisi_d_c'] === 'c' ? 'selected' : '' ?>>Kredit</option>
                            </select>
                        </div>
                        <div class="mb-2 mt-1">
                            <div class="float-right d-none d-sm-block">
                                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                                <button type="submit" class="btn btn-secondary">Simpan</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->
<?php endforeach; ?>

<!-- Delete Modals -->
<?php foreach ($coa as $akun) : ?>
    <form action="<?= base_url('coa/delete') ?>" method="post">
        <div id="delete<?= $akun['id_akun']; ?>" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header bg-secondary">
                        <h5 class="modal-title text-white">Apa Kamu Yakin ?</h5>
                        <a type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></a>
                    </div>
                    <div class="modal-body">Data yang dihapus tidak akan bisa dikembalikan.</div>
                    <div class="modal-body">
                        <div class="mb-2 mt-1">
                            <div class="float-right d-none d-sm-block">
                                <input type="hidden" name="id_akun" value="<?= $akun['id_akun'] ?>">
                                <a href="#" class="btn btn-danger" data-bs-dismiss="modal">Batal</a>
                                <button type="submit" class="btn btn-danger">Hapus</button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </form>
<?php endforeach; ?>

<?= $this->endSection(); ?>
