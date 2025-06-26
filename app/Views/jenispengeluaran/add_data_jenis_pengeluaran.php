<?=$this->extend('templates/head');?>
<?=$this->section('content-admin');?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Master Data jenis_pengeluaran</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">jenis_pengeluaran</a></li>
                            <li class="breadcrumb-item active">Tambah Master Data jenis_pengeluaran</li>
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
                        <form action="<?=base_url('jenis_pengeluaran/create')?>" method="POST" class="no-validated row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode jenis_pengeluaran</label>
                                <input type="text" class="form-control" name="kode_jenis_pengeluaran" value="<?=$kode_jenis_pengeluaran?>" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jenis jenis_pengeluaran</label>
                                <select class="form-control" name="jenis_jenis_pengeluaran">
                                    <option value="" disabled selected>Pilih Jenis jenis_pengeluaran</option>
                                    <option value="Mobil">Mobil</option>
                                    <option value="Motor">Motor</option>
                                </select>
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('jenis_jenis_pengeluaran')?></span>
                                <?php endif;?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama jenis_pengeluaran</label>
                                <input type="text" class="form-control" name="nama_jenis_pengeluaran" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('nama_jenis_pengeluaran')?></span>
                                <?php endif;?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Merk jenis_pengeluaran</label>
                                <input type="text" class="form-control" name="merk_jenis_pengeluaran" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('merk_jenis_pengeluaran')?></span>
                                <?php endif;?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tahun jenis_pengeluaran</label>
                                <select class="form-control" name="tahun_jenis_pengeluaran">
                                    <option value="" disabled selected>Pilih Tahun jenis_pengeluaran</option>
                                    <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                                        <option value="<?=$i?>"><?=$i?></option>
                                    <?php endfor;?>
                                </select>
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('tahun_jenis_pengeluaran')?></span>
                                    <?php endif;?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Warna jenis_pengeluaran</label>
                                <input type="text" class="form-control" name="warna_jenis_pengeluaran" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('warna_jenis_pengeluaran')?></span>
                                    <?php endif;?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Harga Sewa jenis_pengeluaran</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-apend">
                                        <div class="input-group-text">
                                            <span>Rp</span>
                                        </div>
                                    </div>
                                <input type="text" class="form-control jumlah" name="harga_sewa_jenis_pengeluaran" oninput="validity.valid||(value='');" autocomplete="off">
                                </div>
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('harga_jenis_pengeluaran')?></span>
                                    <?php endif;?>
                            </div>
                            <hr>
                            <div class="col-12 pt-2">
                                <a href="<?=base_url('jenis_pengeluaran')?>" class="btn btn-warning"> Batal</a>
                                <button type="submit" class="btn btn-primary"> Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?=$this->endSection('content-admin');?>
<?=$this->section('content-script');?>
<!-- java script -->
<script>
    new AutoNumeric('.jumlah', autoNumericOptionsJumlah);
</script>
<?=$this->endSection('content-script');?>