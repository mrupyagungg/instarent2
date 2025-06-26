<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Master Data Kendaraan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Kendaraan</a></li>
                            <li class="breadcrumb-item active">Tambah Master Data Kendaraan</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('kendaraan/create') ?>" method="POST" class="no-validated row g-3"
                            enctype="multipart/form-data">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Kendaraan</label>
                                <input type="text" class="form-control" name="kode_kendaraan"
                                    value="<?= $kode_kendaraan ?>" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jenis Kendaraan</label>
                                <select class="form-control" name="jenis_kendaraan">
                                    <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                                    <option value="Mobil">Mobil</option>
                                    <option value="Motor">Motor</option>
                                </select>
                                <?php if (isset($validation)): ?>
                                <span class="badge bg-danger"> <?= $validation->getError('jenis_kendaraan') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama Kendaraan</label>
                                <input type="text" class="form-control" name="nama_kendaraan" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                <span class="badge bg-danger"> <?= $validation->getError('nama_kendaraan') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Merk Kendaraan</label>
                                <input type="text" class="form-control" name="merk_kendaraan" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                <span class="badge bg-danger"> <?= $validation->getError('merk_kendaraan') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tahun Kendaraan</label>
                                <select class="form-control" name="tahun_kendaraan">
                                    <option value="" disabled selected>Pilih Tahun Kendaraan</option>
                                    <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                                    <option value="<?= $i ?>"><?= $i ?></option>
                                    <?php endfor; ?>
                                </select>
                                <?php if (isset($validation)): ?>
                                <span class="badge bg-danger"> <?= $validation->getError('tahun_kendaraan') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Warna Kendaraan</label>
                                <input type="text" class="form-control" name="warna_kendaraan" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                <span class="badge bg-danger"> <?= $validation->getError('warna_kendaraan') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Harga Sewa Kendaraan</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-apend">
                                        <div class="input-group-text">
                                            <span>Rp</span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control jumlah" name="harga_sewa_kendaraan"
                                        oninput="validity.valid||(value='');" autocomplete="off">
                                </div>
                                <?php if (isset($validation)): ?>
                                <span class="badge bg-danger"> <?= $validation->getError('harga_kendaraan') ?></span>
                                <?php endif; ?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Gambar Kendaraan</label>
                                <input type="file" class="form-control" name="gambar_kendaraan" accept="image/*">
                                <?php if (isset($validation)): ?>
                                <span class="badge bg-danger"> <?= $validation->getError('gambar_kendaraan') ?></span>
                                <?php endif; ?>
                            </div>
                            <hr>
                            <div class="col-12 pt-2">
                                <a href="<?= base_url('kendaraan') ?>" class="btn btn-warning"> Batal</a>
                                <button type="submit" class="btn btn-primary"> Simpan</button>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content-admin'); ?>
<?= $this->section('content-script'); ?>
<!-- java script -->
<script>
new AutoNumeric('.jumlah', autoNumericOptionsJumlah);
</script>
<?= $this->endSection('content-script'); ?>