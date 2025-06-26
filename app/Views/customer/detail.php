<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<!-- Link Bootstrap & CSS Tambahan -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">

<div class="container">
    <style>
    .breadcrumb-item+.breadcrumb-item::before {
        content: none;
    }
    </style>

    <div class="container mt-4">
        <!-- Flash Message -->
        <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success" id="success-alert">
            <strong>Success!</strong> <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger" id="error-alert">
            <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>

        <!-- Breadcrumb -->
        <nav aria-label="breadcrumb ">
            <ol class="breadcrumb">
                <li class="breadcrumb-item active" aria-current="page">Registrasi</li>
                <li class="breadcrumb-item"> <a href="<?= base_url('pemesanan/add_data_pemesanan') ?>">Pesan</a></li>
                <li class="breadcrumb-item">Bayar</li>
            </ol>
        </nav>

        <h2 class="mb-4">Detail <?= esc($kendaraan['jenis_kendaraan']) ?></h2>
        <div class="row">
            <!-- Detail Kendaraan -->
            <div class="col-md-6">
                <img src="<?= base_url('uploads/' . esc($kendaraan['gambar_kendaraan'], 'url')) ?>"
                    alt="Detail Kendaraan" class="img-fluid">
                <h2 class="mt-3"> <?= strtoupper(esc($kendaraan['merk_kendaraan'])) ?>
                    <?= strtoupper(esc($kendaraan['nama_kendaraan'])) ?></h2>
                <table class="table">
                    <tbody>
                        <tr>
                            <td><strong>Tahun</strong></td>
                            <td><?= esc($kendaraan['tahun_kendaraan']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Warna</strong></td>
                            <td><?= esc($kendaraan['warna_kendaraan']) ?></td>
                        </tr>
                        <tr>
                            <td><strong>Bahan Bakar</strong></td>
                            <td>Pertalite</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Form Pelanggan -->
            <div class="col-md-6 bg-white">
                <form action="/customer/store" method="post" id="pelangganForm" class="col-md-6 bg-white">
                    <center>
                        <h4>Formulir Data Pelanggan</h4>
                    </center>
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label for="nama_pelanggan" class="form-label">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                            value="<?= old('nama_pelanggan', session()->get('username')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email_pelanggan" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan"
                            value="<?= old('email_pelanggan', session()->get('email')) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="no_telp_pelanggan" class="form-label">No Telepon</label>
                        <input type="text" class="form-control" id="no_telp_pelanggan" name="no_telp_pelanggan"
                            value="<?= old('no_telp_pelanggan') ?>" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Jenis Kelamin</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="laki_laki"
                                    name="jenis_kelamin_pelanggan" value="Laki-laki"
                                    <?= old('jenis_kelamin_pelanggan') === 'Laki-laki' ? 'checked' : '' ?> required>
                                <label class="form-check-label" for="laki_laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" id="perempuan"
                                    name="jenis_kelamin_pelanggan" value="Perempuan"
                                    <?= old('jenis_kelamin_pelanggan') === 'Perempuan' ? 'checked' : '' ?> required>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="alamat_pelanggan" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat_pelanggan" name="alamat_pelanggan"
                            required><?= old('alamat_pelanggan') ?></textarea>
                    </div>

                    <button type="submit" class="btn btn-success w-100">Simpan Data</button>
                </form>

                <?php if (session()->getFlashdata('success')): ?>
                <a href="/pemesanan/add_data_pemesanan" class="btn btn-primary w-100 mt-2">Lanjut</a>
                <?php endif; ?>
            </div>

            <style>
            /* Check visibility and layout of select element */
            #jenis_kelamin_pelanggan {
                visibility: visible !important;
                /* Ensure the dropdown is visible */
                display: block !important;
                /* Make sure the dropdown is not hidden */
            }
            </style>


        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        document.getElementById('success-alert')?.remove();
        document.getElementById('error-alert')?.remove();
    }, 4000);
});
</script>

<?= $this->endSection() ?>