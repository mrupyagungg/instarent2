<?=$this->extend('templates/head');?>
<?=$this->section('content-admin');?>
<div class="page-content">
    <div class="container-fluid">

        
        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Master Data COA</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">COA</a></li>
                            <li class="breadcrumb-item active">Tambah Master Data COA</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                    <form action="<?=base_url('coa/create')?>" method="POST" class="no-validated row g-3">
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nomor Akun</label>
                                <input type="text" class="form-control" name="id_akun" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('id_akun')?></span>
                                <?php endif;?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Nama Akun</label>
                                <input type="text" class="form-control" name="nama_akun" autocomplete="off">
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('nama_akun')?></span>
                                <?php endif;?>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Kategori</label>
                                    <div>
                                    <div class="form check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori" value="harta" <?= set_radio('kategori', 'harta'); ?>>
                                        <label class="form-check-label" for="kategori_harta">Harta</label>
                                    </div>
                                    <div class="form check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori" value="aktiva" <?= set_radio('kategori', 'aktiva'); ?>>
                                        <label class="form-check-label" for="kategori_aktiva">Aktiva</label>
                                    </div>
                                    <div class="form check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori" value="pendapatan" <?= set_radio('kategori', 'pendapatan'); ?>>
                                        <label class="form-check-label" for="kategori_pendapatan">Pendapatan</label>
                                    </div>
                                    <div class="form check form-check-inline">
                                        <input class="form-check-input" type="radio" name="kategori" value="beban" <?= set_radio('kategori', 'beban'); ?>>
                                        <label class="form-check-label" for="kategori_beban">Beban</label>
                                    </div>
                                    </div>
                                <?php if (isset($validation)): ?>
                                        <span class="badge bg-danger"> <?=$validation->getError('posisi')?></span>
                                <?php endif;?>
                            </div> 
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Posisi</label>
                                <div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="posisi_d_c" id="posisi_d" value="d" <?= set_radio('posisi', 'd'); ?>>
                                        <label class="form-check-label" for="posisi_d">Debit (d)</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="posisi_d_c" id="posisi_c" value="c" <?= set_radio('posisi', 'c'); ?>>
                                        <label class="form-check-label" for="posisi_c">Kredit (c)</label>
                                    </div>
                                </div>
                                <?php if (isset($validation)): ?>
                                    <span class="badge bg-danger"> <?=$validation->getError('posisi')?></span>
                                <?php endif;?>
                                </div>
                                                        
                            <hr>
                            <div class="col-12 pt-2">
                                <a href="<?=base_url('coa')?>" class="btn btn-warning"> Batal</a>
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