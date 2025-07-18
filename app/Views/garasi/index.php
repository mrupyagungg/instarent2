<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<!-- Bootstrap CSS & FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<style>
.card:hover {
    transform: scale(1.x 02);
    transition: 0.3s;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
}

.card-title a:hover {
    color: #0d6efd;
}

.badge {
    font-size: 0.75rem;
    padding: 0.4em 0.6em;
}

.sidebar-filter {
    position: sticky;
    top: 90px;
    z-index: 100;
}

@media (max-width: 768px) {
    .sidebar-filter {
        position: static;
        margin-bottom: 1rem;
    }
}
</style>

<div class="container mt-5">
    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <h2 class="text-center fw-bold text-primary mb-4">Garasi Kendaraan</h2>

    <div class="row">
        <!-- Sidebar Filter -->
        <div class="col-md-3 mt-5">
            <div class="bg-white border rounded p-4 shadow-sm sidebar-filter">
                <h5 class="mb-4 text-primary">Filter Pencarian</h5>

                <!-- Jenis -->
                <div class="mb-3">
                    <label for="jenisFilter" class="form-label fw-semibold">Jenis Kendaraan</label>
                    <select id="jenisFilter" class="form-select rounded">
                        <option value="">Semua</option>
                        <option value="mobil">Mobil</option>
                        <option value="motor">Motor</option>
                    </select>
                </div>

                <!-- Tahun -->
                <div class="mb-3">
                    <label for="tahunFilter" class="form-label fw-semibold">Tahun</label>
                    <select id="tahunFilter" class="form-select rounded">
                        <option value="">Semua</option>
                        <?php foreach (range(date('Y'), 2000) as $tahun): ?>
                        <option value="<?= $tahun ?>"><?= $tahun ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Harga -->
                <div class="mb-3">
                    <label class="form-label fw-semibold">Kisaran Harga (Rp)</label>
                    <div class="input-group mb-2">
                        <span class="input-group-text rounded-start">Min</span>
                        <input type="number" id="minHarga" class="form-control rounded-end" placeholder="0">
                    </div>
                    <div class="input-group">
                        <span class="input-group-text rounded-start">Max</span>
                        <input type="number" id="maxHarga" class="form-control rounded-end"
                            placeholder="Contoh: 500000">
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-grid gap-2 mt-4">
                    <button class="btn btn-primary rounded-pill" onclick="applyFilters()">Terapkan</button>
                    <button class="btn btn-outline-secondary rounded-pill" onclick="resetFilters()">Reset</button>
                </div>
            </div>
        </div>

        <!-- Kendaraan List -->
        <div class="col-md-9">
            <div class="mb-4 d-flex justify-content-end">
                <input type="search" id="searchInput" class="form-control shadow-sm w-50"
                    placeholder="Cari nama kendaraan..." onkeyup="applyFilters()">
            </div>

            <div class="row g-4" id="kendaraan-list-ready">
                <?php foreach ($kendaraan_ready as $kendaraan): ?>
                <div class="col-12 kendaraan-item" data-type="<?= esc(strtolower($kendaraan['jenis_kendaraan'])) ?>"
                    data-tahun="<?= esc($kendaraan['tahun_kendaraan']) ?>"
                    data-harga="<?= esc($kendaraan['harga_sewa_kendaraan']) ?>"
                    data-nama="<?= esc(strtolower($kendaraan['merk_kendaraan'] . ' ' . $kendaraan['nama_kendaraan'])) ?>">

                    <div class="card border rounded shadow-sm overflow-hidden">
                        <div class="row g-0">
                            <!-- Gambar -->
                            <div class="col-md-3">
                                <img src="<?= base_url('uploads/' . esc($kendaraan['gambar_kendaraan'])) ?>"
                                    class="img-fluid h-100 w-100 object-fit-cover" style="object-fit: cover;"
                                    alt="Gambar <?= esc($kendaraan['nama_kendaraan']) ?>">
                            </div>

                            <!-- Info kendaraan -->
                            <div class="col-md-6">
                                <div class="card-body d-flex flex-column h-100">
                                    <h5 class="card-title mb-2">
                                        <a href="<?= base_url('detail/' . esc($kendaraan['id_kendaraan'])) ?>"
                                            class="text-decoration-none text-dark">
                                            <?= esc(ucwords($kendaraan['merk_kendaraan'] . ' ' . $kendaraan['nama_kendaraan'])) ?>
                                        </a>
                                    </h5>

                                    <p class="text-muted mb-1">
                                        <i class="fas fa-calendar-alt me-1"></i> Tahun:
                                        <?= esc($kendaraan['tahun_kendaraan']) ?>
                                    </p>

                                    <ul class="list-unstyled small mb-3">
                                        <li>
                                            <i class="fas fa-car me-2 text-secondary"></i>
                                            <?= esc($kendaraan['merk_kendaraan']) ?>
                                        </li>
                                        <li>
                                            <i class="fas fa-palette me-2 text-secondary"></i>
                                            <?= esc($kendaraan['warna_kendaraan']) ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Harga dan tombol -->
                            <div class="col-md-3 d-flex flex-column justify-content-center align-items-center bg-light">
                                <div class="p-3 text-center">
                                    <span class="fw-bold text-primary d-block mb-2">
                                        Rp <?= number_format($kendaraan['harga_sewa_kendaraan'], 0, ',', '.') ?>
                                        <small class="text-muted">/ hari</small>
                                    </span>
                                    <?php if (isset($pelanggan) && $pelanggan): ?>
                                    <a href="<?= base_url('pemesanan/add_data_pemesanan/' . esc($kendaraan['id_kendaraan'])) ?>"
                                        class="btn btn-success btn-sm w-100">Sewa</a>
                                    <?php else: ?>
                                    <a href="<?= base_url('detail/' . esc($kendaraan['id_kendaraan'])) ?>"
                                        class="btn btn-outline-primary btn-sm w-100">Detail</a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                <?php endforeach; ?>
            </div>
        </div>


    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<!-- Filter Script -->
<script>
function applyFilters() {
    const jenis = document.getElementById('jenisFilter').value;
    const tahun = document.getElementById('tahunFilter').value;
    const minHarga = parseInt(document.getElementById('minHarga').value) || 0;
    const maxHarga = parseInt(document.getElementById('maxHarga').value) || Infinity;
    const search = document.getElementById('searchInput').value.toLowerCase();

    document.querySelectorAll('.kendaraan-item').forEach(item => {
        const itemJenis = item.dataset.type;
        const itemTahun = item.dataset.tahun;
        const itemHarga = parseInt(item.dataset.harga);
        const itemNama = item.dataset.nama;

        const cocokJenis = !jenis || itemJenis === jenis;
        const cocokTahun = !tahun || itemTahun === tahun;
        const cocokHarga = itemHarga >= minHarga && itemHarga <= maxHarga;
        const cocokNama = itemNama.includes(search);

        item.style.display = (cocokJenis && cocokTahun && cocokHarga && cocokNama) ? '' : 'none';
    });
}

function resetFilters() {
    document.getElementById('jenisFilter').value = '';
    document.getElementById('tahunFilter').value = '';
    document.getElementById('minHarga').value = '';
    document.getElementById('maxHarga').value = '';
    document.getElementById('searchInput').value = '';
    applyFilters();
}
</script>

<?= $this->endSection() ?>