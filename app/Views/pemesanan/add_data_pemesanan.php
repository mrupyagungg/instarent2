<?= $this->extend('template/layout') ?>

<?= $this->section('content') ?>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
<!-- ✅ Tambahan CSS jika ingin beri highlight kendaraan yang dipilih -->
<style>
.kendaraan-item.selected .card {
    border: 2px solid #0d6efd;
    background-color: #e7f1ff;
}
</style>
<style>
.breadcrumb {
    background-color: #f8f9fa;
    padding: 10px 15px;
    border-radius: 8px;
    margin-bottom: 20px;
}

.breadcrumb-item.active {
    font-weight: bold;
    color: #007bff;
}

.form-header {
    font-size: 24px;
    font-weight: bold;
    color: #343a40;
    margin-bottom: 20px;
}

.card {
    border: 1px solid #e3e6f0;
    border-radius: 12px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
}

.card:hover,
.card.selected {
    transform: scale(1.02);
    box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
    border: 2px solid #007bff;
}

.breadcrumb-item+.breadcrumb-item::before {
    content: none;
}
</style>
<div class="container">
    <div class="container mt-4">
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

        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">Registrasi</li>
                <li class="breadcrumb-item active" aria-current="page">Pesan</li>
                <li class="breadcrumb-item">Bayar</a></li>
            </ol>
        </nav>

        <h4 class="form-header">Book Now</h4>
        <form action="<?= base_url('pemesanan/create/' . $kendaraanDipilih['id_kendaraan']) ?>" method="POST"
            enctype="multipart/form-data" class="no-validated row g-3">

            <!-- Kode dan Tanggal Pemesanan -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Kode Pemesanan</label>
                <input type="text" class="form-control" value="<?= esc($kode_pemesanan) ?>" disabled>
                <input type="hidden" name="kode_pemesanan" value="<?= esc($kode_pemesanan) ?>">
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Pemesanan</label>
                <input type="date" class="form-control" name="tanggal_pemesanan" value="<?= date('Y-m-d') ?>" readonly>
            </div>

            <!-- Tanggal Awal dan Akhir -->
            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Awal</label>
                <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Tanggal Akhir</label>
                <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir" required>
            </div>

            <!-- Lama Pemesanan -->
            <div class="mb-3">
                <label for="lama_pemesanan" class="form-label">Lama Pemesanan (Hari)</label>
                <input type="text" class="form-control" id="lama_pemesanan" name="lama_pemesanan" readonly>
            </div>

            <!-- Jaminan -->
            <div class="col-md-12 mb-3">
                <label class="form-label">Jaminan Identitas</label>
                <input type="file" class="form-control" name="jaminan_identitas" required>
            </div>

            <!-- Informasi Pelanggan -->
            <div class="col-md-12 mb-3">
                <label class="form-label">Pelanggan</label>
                <input type="text" class="form-control" value="<?= esc($pelanggan['nama_pelanggan']) ?>" readonly>
                <input type="hidden" name="pelanggan_id" value="<?= esc($pelanggan['id_pelanggan']) ?>">
            </div>

            <!-- Kendaraan Dipilih -->
            <div class="mb-3">
                <label class="form-label">Kendaraan yang Dipilih</label>
                <input type="hidden" name="kendaraan_id" value="<?= esc($kendaraanDipilih['id_kendaraan']) ?>">

                <div class="card p-3 bg-light border border-primary">
                    <h5 id="ringkasanKendaraan"><?= esc($kendaraanDipilih['nama_kendaraan']) ?></h5>
                    <p>Harga per hari: Rp<?= number_format($kendaraanDipilih['harga_sewa_kendaraan'], 0, ',', '.') ?>
                    </p>
                </div>
            </div>

            <!-- Total Harga -->
            <div class="mb-3">
                <label for="total_harga" class="form-label">Total Harga Yang Harus Anda Bayar</label>
                <input type="text" class="form-control" id="total_harga" name="total_harga" readonly>
            </div>

            <!-- Hidden User ID -->
            <input type="hidden" name="user_id" value="<?= session()->get('user_id') ?>">

            <!-- Tombol -->
            <div class="col-12 pt-2">
                <a href="<?= base_url('/') ?>" class="btn btn-warning">Batal</a>
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tanggalAwalInput = document.getElementById('tanggal_awal');
            const tanggalAkhirInput = document.getElementById('tanggal_akhir');
            const lamaPemesananInput = document.getElementById('lama_pemesanan');
            const totalHargaInput = document.getElementById('total_harga');

            const hargaPerHari = <?= (int)$kendaraanDipilih['harga_sewa_kendaraan'] ?>;

            // Atur batas minimal tanggal awal dan akhir ke hari ini
            const today = new Date().toISOString().split('T')[0];
            tanggalAwalInput.setAttribute('min', today);
            tanggalAkhirInput.setAttribute('min', today);

            tanggalAwalInput.addEventListener('change', function() {
                tanggalAkhirInput.setAttribute('min', tanggalAwalInput.value);
                hitungDurasiDanTotal();
            });

            tanggalAkhirInput.addEventListener('change', hitungDurasiDanTotal);

            function hitungDurasiDanTotal() {
                const tglAwal = new Date(tanggalAwalInput.value);
                const tglAkhir = new Date(tanggalAkhirInput.value);

                if (!isNaN(tglAwal) && !isNaN(tglAkhir)) {
                    if (tglAkhir < tglAwal) {
                        alert('Tanggal akhir tidak boleh sebelum tanggal awal.');
                        tanggalAkhirInput.value = '';
                        lamaPemesananInput.value = '';
                        totalHargaInput.value = '';
                        return;
                    }

                    const selisihHari = Math.floor((tglAkhir - tglAwal) / (1000 * 3600 * 24));
                    let lama = 1;
                    if (selisihHari >= 2) {
                        lama = selisihHari;
                    }

                    const total = lama * hargaPerHari;
                    lamaPemesananInput.value = lama;

                    // Format hanya tampilan (Rp xxx.xxx)
                    totalHargaInput.value = `Rp ${total.toLocaleString('id-ID')}`;
                }
            }
        });
        </script>

        <?= $this->endSection() ?>