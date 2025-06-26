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
                        <form action="<?=base_url('pemesanan/edit/' . $pemesanan['id_pemesanan'])?>" method="POST" class="no-validated row g-3" enctype="multipart/form-data">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kode Pemesanan</label>
                                <input type="text" class="form-control" name="kode_pemesanan" value="<?=$pemesanan['kode_pemesanan']?>" autocomplete="off" disabled>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Tanggal Pemesanan</label>
                                <input type="date" class="form-control" name="tanggal_pemesanan" value="<?=$pemesanan['tanggal_pemesanan']?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Lama Pemesanan</label>
                                <input type="number" class="form-control" name="lama_pemesanan" value="<?=$pemesanan['lama_pemesanan']?>" autocomplete="off">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Jaminan Identitas</label>
                                <input type="file" class="form-control" name="jaminan_identitas" autocomplete="off">
                                <img src="/uploads/images/<?=$pemesanan['jaminan_identitas']?>" alt="" width="400px" class="mt-2">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Pelanggan</label>
                                <select class="form-control" name="pelanggan_id">
                                    <option value="" disabled selected>Pilih Pelanggan</option>
                                    <?php foreach ($pelanggan as $data): ?>
                                        <option value="<?=$data['id_pelanggan']?>" <?=$pemesanan['pelanggan_id'] == $data['id_pelanggan'] ? 'selected' : ''?> ><?=$data['nama_pelanggan']?> - <?=$data['kode_pelanggan']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label">Kendaraan</label>
                                <select class="form-control" name="kendaraan_id">
                                    <option value="" disabled selected>Pilih Kendaraan</option>
                                    <?php foreach ($kendaraan as $data): ?>
                                        <option value="<?=$data['id_kendaraan']?>" <?=$pemesanan['kendaraan_id'] == $data['id_kendaraan'] ? 'selected' : ''?> ><?=$data['nama_kendaraan']?> - <?=$data['harga_sewa_kendaraan']?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <hr>
                            <div class="col-12 pt-2">
                                <a href="<?=base_url('pelanggan')?>" class="btn btn-warning"> Batal</a>
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