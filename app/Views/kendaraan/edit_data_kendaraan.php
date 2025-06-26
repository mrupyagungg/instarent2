<?=$this->extend('templates/head');?>
<?=$this->section('content-admin');?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                    <h4 class="mb-sm-0 font-size-18"><?=$title?></h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:
                                    void(0);"><?=$title?></a></li>
                            <li class="breadcrumb-item active"><?=$title?></li>
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
                        <form action="<?=base_url('kendaraan/edit/' . $kendaraan['id_kendaraan'])?>" method="POST" class="no-validated row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Kendaraan</label>
                                <input type="text" class="form-control" name="kode_kendaraan" value="<?=$kendaraan['kode_kendaraan']?>" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jenis Kendaraan</label>
                                <select class="form-control" name="jenis_kendaraan" required>
                                    <option value="" disabled selected>Pilih Jenis Kendaraan</option>
                                    <option value="Mobil" <?=$kendaraan['jenis_kendaraan'] == 'Mobil' ? 'selected' : ''?> >Mobil</option>
                                    <option value="Motor" <?=$kendaraan['jenis_kendaraan'] == 'Motor' ? 'selected' : ''?> >Motor</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama Kendaraan</label>
                                <input type="text" class="form-control" name="nama_kendaraan" value="<?=$kendaraan['nama_kendaraan']?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Merk Kendaraan</label>
                                <input type="text" class="form-control" name="merk_kendaraan" value="<?=$kendaraan['merk_kendaraan']?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tahun Kendaraan</label>
                                <select class="form-control" name="tahun_kendaraan" required>
                                    <option value="" disabled selected>Pilih Tahun Kendaraan</option>
                                    <?php for ($i = date('Y'); $i >= 2000; $i--): ?>
                                        <option value="<?=$i?>" <?=$kendaraan['tahun_kendaraan'] == $i ? 'selected' : ''?> ><?=$i?></option>
                                    <?php endfor;?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Warna Kendaraan</label>
                                <input type="text" class="form-control" name="warna_kendaraan" value="<?=$kendaraan['warna_kendaraan']?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Harga Kendaraan</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-apend">
                                        <div class="input-group-text">
                                            <span>Rp</span>
                                        </div>
                                    </div>
                                <input type="text" class="form-control jumlah" name="harga_sewa_kendaraan" value="<?=$kendaraan['harga_sewa_kendaraan']?>" oninput="validity.valid||(value='');" autocomplete="off">
                                </div>
                            </div>
                            <hr>
                            <div class="col-12 pt-2">
                                <a href="<?=base_url('kendaraan')?>" class="btn btn-warning"> Batal</a>
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