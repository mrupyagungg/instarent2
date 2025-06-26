<?= $this->extend('template/layout') ?>
<!-- Content section -->
<?= $this->section('content') ?>

<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/detail.css') ?>">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-KyZXEJpP3p5q7jD5k2f2lCZ5TO9p4a9z2emMZ4vh6dZQp+djlG1+OG0gd3cnSxd3" crossorigin="anonymous">
<!-- <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"> -->


<!-- Home Content -->
<div id="home">
    <!-- Menampilkan Flash Message -->

    <div class="breadcrumb">
        <div class="breadcrumb-item active">
            <span>Registrasi</span>
        </div>
        <div class="breadcrumb-item">
            <a href="<?= base_url('pemesanan/add_data_pemesanan') ?>">Pesan</a>
        </div>
        <div class="breadcrumb-item">
            <a href="<?= base_url('bayar') ?>">Bayar</a>
        </div>
    </div>


    <div class="container">
        <?php if (session()->getFlashdata('success')): ?>
        <div class="custom-alert fade-in" id="success-alert">
            <strong>Success!</strong> <?= session()->getFlashdata('success') ?>
        </div>
        <?php endif; ?>
        <?php if (session()->getFlashdata('error')): ?>
        <div class="alert-danger fade-in" id="error-alert">
            <strong>Error!</strong> <?= session()->getFlashdata('error') ?>
        </div>
        <?php endif; ?>
        <!-- Header Title -->
        <h2 class="mb-4">Detail <?= esc($kendaraan['jenis_kendaraan']) ?></h2>

        <div class="row">

            <!-- Column 1: Data Kendaraan -->
            <div class="col">
                <h4 class="form-header">Spesifikasi</h4>
                <img src="<?= base_url('uploads/' . esc($kendaraan['gambar_kendaraan'], 'url')) ?>" alt="Detail Mobil"
                    class="img-fluid detail-img">
                <br>
                <h2 class="mb-4 justify-content-center"> <?= strtoupper(esc($kendaraan['merk_kendaraan'])) ?>
                    <?= strtoupper(esc($kendaraan['nama_kendaraan'])) ?></h2><br>
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

            <!-- Column 2: Input Pelanggan -->
            <div class="col">
                <h4 class="form-header">Input Pelanggan</h4>



                <!-- Form Input Pelanggan -->
                <form action="/customer/store" method="post" id="pelangganForm">
                    <?= csrf_field() ?>
                    <div class="form-group">
                        <label for="nama_pelanggan">Nama Pelanggan</label>
                        <input type="text" class="form-control" id="nama_pelanggan" name="nama_pelanggan"
                            value="<?= old('nama_pelanggan', session()->get('username')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="email_pelanggan">Email</label>
                        <input type="email" class="form-control" id="email_pelanggan" name="email_pelanggan"
                            value="<?= old('email_pelanggan', session()->get('email')) ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="no_telp_pelanggan">No Telepon</label>
                        <input type="number" class="form-control" id="no_telp_pelanggan" name="no_telp_pelanggan"
                            value="<?= old('no_telp_pelanggan') ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="alamat_pelanggan">Alamat</label>
                        <textarea class="form-control" id="alamat_pelanggan" name="alamat_pelanggan"
                            required><?= old('alamat_pelanggan') ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="jenis_kelamin_pelanggan">Jenis Kelamin</label>
                        <select class="form-control" id="jenis_kelamin_pelanggan" name="jenis_kelamin_pelanggan"
                            required>
                            <option value="">-- Pilih --</option>
                            <option value="Laki-laki"
                                <?= old('jenis_kelamin_pelanggan') === 'Laki-laki' ? 'selected' : '' ?>>
                                Laki-laki
                            </option>
                            <option value="Perempuan"
                                <?= old('jenis_kelamin_pelanggan') === 'Perempuan' ? 'selected' : '' ?>>
                                Perempuan
                            </option>
                        </select>
                    </div>

                    <!-- Tombol Simpan -->
                    <?php if (!session()->getFlashdata('success')): ?>
                    <button type="submit"
                        class="btn btn-success btn-block rounded-pill shadow-sm d-flex align-items-center justify-content-center"
                        id="btnSimpan">
                        <span>Simpan Data</span>
                    </button>
                    <?php endif; ?>
                </form>
            </div>


            <!-- Column 3: Booking Information -->
            <div class="col">
                <h4 class="form-header">Detail Pesanan</h4>
                <form action="/pemesanan/store" method="post" enctype="multipart/form-data">
                    <?= csrf_field() ?>

                    <!-- Kendaraan ID -->
                    <div class="form-group">
                        <label for="kendaraan_id">ID Kendaraan</label>
                        <input type="text" class="form-control" value="<?= esc($kendaraan['kode_kendaraan']) ?>"
                            disabled>
                        <input type="hidden" name="kendaraan_id" value="<?= esc($kendaraan['kode_kendaraan']) ?>">
                    </div>

                    <!-- Pelanggan ID -->
                    <div class="form-group">
                        <label for="customer_id">ID Pelanggan</label>
                        <input type="text" class="form-control" value="<?= esc(session()->get('username')) ?>" disabled>
                        <input type="hidden" name="pelanggan_id" value="<?= esc(session()->get('username')) ?>">
                    </div>

                    <!-- Tanggal Awal -->
                    <div class="mb-3">
                        <label for="tanggal_awal" class="form-label"><strong>Tanggal Awal:</strong></label>
                        <input type="date" id="tanggal_awal" name="tanggal_awal" class="form-control"
                            placeholder="dd/mm/yyyy" required>
                    </div>

                    <!-- Tanggal Akhir -->
                    <div class="mb-3">
                        <label for="tanggal_akhir" class="form-label"><strong>Tanggal Akhir:</strong></label>
                        <input type="date" id="tanggal_akhir" name="tanggal_akhir" class="form-control"
                            placeholder="dd/mm/yyyy" required>
                    </div>

                    <!-- Total Harga -->
                    <div class="mb-3">
                        <label for="total_harga" class="form-label"><strong>Total Harga:</strong></label>
                        <input type="text" id="total_harga" class="form-control"
                            value="<?= 'Rp ' . number_format($kendaraan['harga_sewa_kendaraan'], 0, ',', '.') ?>"
                            disabled>
                        <input type="hidden" name="total_harga" value="<?= $kendaraan['harga_sewa_kendaraan'] ?>">
                    </div>

                    <!-- Lama Pemesanan -->
                    <div class="mb-3">
                        <label for="lama_pemesanan" class="form-label"><strong>Lama Pemesanan (Hari):</strong></label>
                        <input type="number" id="lama_pemesanan" name="lama_pemesanan" class="form-control" required>
                    </div>

                    <!-- Jaminan Identitas -->
                    <div class="mb-3">
                        <label for="jaminan_identitas" class="form-label"><strong>Jaminan Identitas
                                (KTP/SIM):</strong></label>
                        <input type="file" id="jaminan_identitas" name="jaminan_identitas" class="form-control"
                            accept="image/*" required>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </form>

                <!-- Contact Information -->
                <p class="mt-3 text-center">atau hubungi</p>
                <p class="text-center text-muted">0822-2123-2123</p>
            </div>



        </div>
    </div>

    <!-- JavaScript -->
    <script>
    // Validasi client-side
    const pelangganForm = document.getElementById('pelangganForm');
    pelangganForm.addEventListener('submit', function(event) {
        const formValid = pelangganForm.checkValidity();
        if (!formValid) {
            event.preventDefault();
            alert('Mohon lengkapi semua data sebelum melanjutkan!');
        }
    });

    // Auto-hide alert
    const successAlert = document.getElementById('success-alert');
    if (successAlert) {
        setTimeout(() => successAlert.style.display = 'none', 4000);
    }
    </script>

    <script>
    // Setelah halaman dimuat
    document.addEventListener("DOMContentLoaded", function() {
        // Temukan elemen alert
        const successAlert = document.getElementById('success-alert');
        const errorAlert = document.getElementById('error-alert');

        // Fungsi untuk menghilangkan alert setelah 4 detik
        if (successAlert) {
            setTimeout(() => {
                successAlert.style.display = 'none';
            }, 4000); // 4 detik
        }

        if (errorAlert) {
            setTimeout(() => {
                errorAlert.style.display = 'none';
            }, 4000); // 4 detik
        }
    });
    </script>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const tanggalAwalInput = document.getElementById('tanggal_awal');
        const tanggalAkhirInput = document.getElementById('tanggal_akhir');
        const totalHargaInput = document.getElementById('total_harga');
        const lamaPemesananInput = document.getElementById('lama_pemesanan');
        const hargaPerHari = <?= esc($kendaraan['harga_sewa_kendaraan']) ?>; // Harga per hari

        // Function to format Rupiah
        function formatRupiah(value) {
            value = value.replace(/[^0-9]/g, ''); // Remove non-numeric characters
            return 'Rp ' + value.replace(/\B(?=(\d{3})+(?!\d))/g, '.'); // Format value to Rupiah
        }

        // Function to calculate and update total price and booking duration
        function calculateTotalHarga() {
            const tanggalAwal = new Date(tanggalAwalInput.value); // Convert to Date
            const tanggalAkhir = new Date(tanggalAkhirInput.value); // Convert to Date

            if (tanggalAwal && tanggalAkhir && tanggalAwal <= tanggalAkhir) {
                const durasi = Math.ceil((tanggalAkhir - tanggalAwal) / (1000 * 60 * 60 * 24)) + 1;
                const totalHarga = durasi * hargaPerHari;

                // Update total price and booking duration
                totalHargaInput.value = formatRupiah(totalHarga.toString());
                lamaPemesananInput.value = durasi; // Set the number of days
            } else {
                totalHargaInput.value = formatRupiah(hargaPerHari.toString());
                lamaPemesananInput.value = ''; // Clear the duration if invalid
            }
        }

        // Event listeners for date input changes
        tanggalAwalInput.addEventListener('change', calculateTotalHarga);
        tanggalAkhirInput.addEventListener('change', calculateTotalHarga);
    });
    </script>

    <!-- End content section -->
    <?= $this->endSection() ?>