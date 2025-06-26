<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<!-- FontAwesome CDN -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />

<div class="container mt-4">

    <?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="container mt-4">
        <section id="featured-car">
            <h2 class="text-center mb-4 mt-4 text-dark fw-bold">Garasi Kendaraan</h2>

            <!-- Search & Filter -->
            <div class="d-flex flex-wrap justify-content-center gap-3 mb-4">
                <input type="search" id="searchInput" class="form-control w-auto" placeholder="Cari kendaraan..."
                    onkeyup="filterKendaraanBySearch()" style="min-width: 250px; max-width: 300px;">

                <div class="btn-group" role="group" aria-label="Filter kendaraan">
                    <button type="button" class="btn btn-outline-primary"
                        onclick="filterKendaraan('all')">Semua</button>
                    <button type="button" class="btn btn-outline-primary"
                        onclick="filterKendaraan('mobil')">Mobil</button>
                    <button type="button" class="btn btn-outline-primary"
                        onclick="filterKendaraan('motor')">Motor</button>
                </div>
            </div>

            <h3 class="mb-3">Kendaraan Ready</h3>

            <div class="row row-cols-1 row-cols-md-3 g-4" id="kendaraan-list-ready">
                <?php foreach ($kendaraan_ready as $kendaraan): ?>
                <div class="col kendaraan-item" data-type="<?= esc(strtolower($kendaraan['jenis_kendaraan'])) ?>">
                    <div class="card h-100 shadow-sm">
                        <img src="<?= base_url('uploads/' . esc($kendaraan['gambar_kendaraan'])) ?>"
                            class="card-img-top" alt="Gambar <?= esc($kendaraan['nama_kendaraan']) ?>"
                            style="width: 100%; height: 250px; object-fit: cover; border-bottom: 1px solid #dee2e6;">


                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">
                                <a href="<?= base_url('detail/' . esc($kendaraan['id_kendaraan'])) ?>"
                                    class="text-decoration-none text-dark">
                                    <?= esc(ucwords($kendaraan['merk_kendaraan'])) ?>
                                    <?= esc(ucwords($kendaraan['nama_kendaraan'])) ?>
                                </a>
                            </h5>

                            <p class="card-text mb-1"><small class="text-muted">Tahun:
                                    <?= esc($kendaraan['tahun_kendaraan']) ?></small></p>

                            <ul class="list-inline mb-3">
                                <li class="list-inline-item">
                                    <i class="fas fa-gas-pump"></i> Bensin
                                </li>
                                <li class="list-inline-item">
                                    <i class="fas fa-car"></i> <?= esc(ucwords($kendaraan['merk_kendaraan'])) ?>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fas fa-palette"></i> <?= esc(ucwords($kendaraan['warna_kendaraan'])) ?>
                                </li>
                                <li class="list-inline-item">
                                    <i class="fas fa-info-circle"></i>
                                    <?php 
                                    $status = strtolower($kendaraan['status_kendaraan']);
                                    if ($status === 'ready') {
                                        echo '<span class="badge bg-success">Ready</span>';
                                    } elseif ($status === 'not ready') {
                                        echo '<span class="badge bg-danger">Tidak Tersedia</span>';
                                    } else {
                                        echo '<span class="badge bg-secondary">' . esc(ucwords($kendaraan['status_kendaraan'])) . '</span>';
                                    }
                                ?>
                                </li>
                            </ul>
                            <div class="mt-auto d-flex justify-content-between align-items-center">
                                <span class="fw-bold text-primary">
                                    Rp <?= number_format($kendaraan['harga_sewa_kendaraan'], 0, ',', '.') ?> / day
                                </span>
                                <div>
                                    <?php if (isset($pelanggan) && $pelanggan): ?>
                                    <a href="<?= base_url('pemesanan/add_data_pemesanan/' . esc($kendaraan['id_kendaraan'])) ?>"
                                        class="btn btn-success btn-sm me-2">
                                        Rent now
                                    </a>
                                    <?php else: ?>
                                    <a href="<?= base_url('detail/' . esc($kendaraan['id_kendaraan'])) ?>"
                                        class="btn btn-primary btn-sm me-2">
                                        Rent now
                                    </a>
                                    <?php endif; ?>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
    </div>
</div>

<!-- Bootstrap JS (for future optional use) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

<script>
function filterKendaraan(type) {
    const items = document.querySelectorAll('.kendaraan-item');
    items.forEach(item => {
        if (type === 'all' || item.dataset.type === type) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });

    // Clear search input when filtering
    document.getElementById('searchInput').value = '';
}

function filterKendaraanBySearch() {
    const input = document.getElementById('searchInput').value.toLowerCase();
    const items = document.querySelectorAll('.kendaraan-item');

    items.forEach(item => {
        const text = item.querySelector('.card-title a').textContent.toLowerCase();
        if (text.includes(input)) {
            item.style.display = '';
        } else {
            item.style.display = 'none';
        }
    });
}
</script>

<?= $this->endSection() ?>