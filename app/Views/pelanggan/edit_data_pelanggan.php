<!-- view.detail.php -->
<?= $this->extend('template/layout') ?>

<!-- Content section -->
<?= $this->section('content') ?>
<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Home Content -->
<div id="home">
    <div class="container mt-5">
        <!-- Vehicle Details -->
        <h2 class="mb-4">Detail <?= esc($kendaraan['jenis_kendaraan']) ?></h2>
        <div class="row">
            <div class="col-md-6">
                <img src="<?= base_url('uploads/' . esc($kendaraan['gambar_kendaraan'], 'url')) ?>" alt="Detail Mobil"
                    class="img-fluid mb-3 rounded">
            </div>
            <div class="col-md-6">
                <h3 class="mb-3"><?= esc(ucwords($kendaraan['merk_kendaraan'] . ' ' . $kendaraan['nama_kendaraan'])) ?>
                </h3>
                <ul class="list-unstyled">
                    <li><strong>Tahun:</strong> <?= esc($kendaraan['tahun_kendaraan']) ?></li>
                    <li><strong>Harga Sewa:</strong> Rp.
                        <?= number_format(esc($kendaraan['harga_sewa_kendaraan']), 2) ?> /hari</li>
                </ul>
                <p class="text-muted">Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur,
                    adipisci velit, sed quia non.</p>

                <!-- Booking Form -->
                <h4 class="form-header mt-4">Form Pemesanan</h4>
                <form action="" method="POST" class="no-validated row g-3">


                    <!-- Nama Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="<?= esc(session()->get('username')) ?>" disabled>
                        <?php if (isset($validation)): ?>
                        <span class="badge bg-danger"> <?= $validation->getError('nama_pelanggan') ?></span>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input class="form-control" type="email" id="email" name="email"
                            value="<?= esc(session()->get('email')) ?>" disabled>
                        <?php if (isset($validation)): ?>
                        <span class="badge bg-danger"> <?= $validation->getError('nama_pelanggan') ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Nomor Telepon Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nomor Telepon Pelanggan</label>
                        <input type="number" class="form-control" name="no_telp_pelanggan" autocomplete="off"
                            maxlength="13">
                        <?php if (isset($validation)): ?>
                        <span class="badge bg-danger"> <?= $validation->getError('no_telp_pelanggan') ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Alamat Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Alamat Pelanggan</label>
                        <textarea type="text" class="form-control" name="alamat_pelanggan" rows="3"
                            autocomplete="off"></textarea>
                        <?php if (isset($validation)): ?>
                        <span class="badge bg-danger"> <?= $validation->getError('alamat_pelanggan') ?></span>
                        <?php endif; ?>
                    </div>

                    <!-- Jenis Kelamin Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Jenis Kelamin Pelanggan</label>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="jenis_kelamin_pelanggan" id="laki-laki"
                                value="Laki-Laki" autocomplete="off">
                            <label for="laki-laki" class="form-check-label">Laki-Laki</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" name="jenis_kelamin_pelanggan" id="perempuan"
                                value="Perempuan" autocomplete="off">
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                        <?php if (isset($validation)): ?>
                        <span class="badge bg-danger"> <?= $validation->getError('jenis_kelamin_pelanggan') ?></span>
                        <?php endif; ?>
                    </div>

                    <hr>
                    <!-- Buttons -->
                    <div class="col-12 pt-2">
                        <a href="<?= base_url('pelanggan') ?>" class="btn btn-warning">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End content section -->
<?= $this->endSection() ?>