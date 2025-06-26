<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                    <h4 class="mb-sm-0 font-size-18"><?= $title ?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:
                                    void(0);"><?= $title ?></a></li>
                            <li class="breadcrumb-item active"><?= $title ?></li>
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
                        <form action="<?= base_url('pengeluaran/edit/' . $pengeluaran['kode_transaksi']) ?>" method="POST" class="no-validated row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Transaksi</label>
                                <input type="text" class="form-control" name="kode_transaksi" value="<?= $pengeluaran['kode_transaksi']; ?>" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pengeluaran</label>
                                <select class="form-control" id="id_jenis_pengeluaran" disabled>
                                    <?php foreach ($jenis_pengeluaran as $list) { ?>
                                        <option <?php if ($list['id_jenis_pengeluaran'] == $pengeluaran['jenis_pengeluaran_id']) {
                                                    echo 'selected="selected"';
                                                } ?> value="<?= $list['id_jenis_pengeluaran'] ?>"><?= $list['nama_jenis_pengeluaran']  ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Keterangan</label>
                                <textarea type="text" class="form-control" name="keterangan" rows="3" autocomplete="off"><?= $pengeluaran['keterangan']; ?></textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jumlah</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-apend">
                                        <div class="input-group-text">
                                            <span>Rp</span>
                                        </div>
                                    </div>
                                    <input type="text" class="form-control jumlah" min=1 oninput="validity.valid||(value='');" name="jumlah" placeholder="Jumlah" value="<?= $pengeluaran['jumlah']; ?>" autocomplete="off">
                                    <?php if (isset($validation)) : ?>
                                        <span class="badge bg-danger"> <?= $validation->getError('jumlah') ?></span>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 pt-2">
                                <a href="<?= base_url('pengeluaran') ?>" class="btn btn-warning"> Batal</a>
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

<?= $this->section('content-admin-script'); ?>
<!-- java script -->
<script>
    new AutoNumeric('.jumlah', autoNumericOptionsJumlah);
</script>
<?= $this->endSection('content-admin-script'); ?>