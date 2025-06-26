<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<!-- Bootstrap & FontAwesome -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<style>
.step-container.last-step::before {
    display: none !important;
}

.step-container {
    position: relative;
    padding-left: 35px;
    margin-bottom: 30px;
}

.step-container::before {
    content: '';
    position: absolute;
    top: 28px;
    left: 7px;
    width: 2px;
    height: 100%;
    background-color: #ccc;
    z-index: 0;
}

.step-container:last-child::before {
    display: none;
}

.step-radio {
    position: absolute;
    left: 0;
    top: 0;
    z-index: 1;
}

/* Container utama */
.container-custom {
    max-width: 900px;
    margin: 40px auto;
    padding: 0 20px;
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
}

a {
    text-decoration: none;
}


.breadcrumb-item+.breadcrumb-item::before {
    content: none;
}

/* Breadcrumb custom */
.breadcrumb-custom .breadcrumb {
    background-color: transparent;
    padding: 0;
    margin-bottom: 30px;
    font-size: 14px;
}

.breadcrumb-custom .breadcrumb-item+.breadcrumb-item::before {
    content: ">";
    padding: 0 8px;
    color: #888;
}

/* Judul */
.order-history h2 {
    font-weight: 700;
    font-size: 28px;
    margin-bottom: 20px;
    color: #2c3e50;
}

/* Tabel riwayat */
.order-table {
    width: 100%;
    border-collapse: collapse;
    box-shadow: 0 4px 8px rgb(0 0 0 / 0.1);
    border-radius: 8px;
    overflow: hidden;
}

.order-table thead tr {
    background-color: #2980b9;
    color: #fff;
    text-align: left;
    font-weight: 600;
    font-size: 16px;
}

.order-table th,
.order-table td {
    padding: 15px 20px;
    border-bottom: 1px solid #ddd;
}

/* Baris genap warna background */
.order-table tbody tr:nth-child(even) {
    background-color: #f9f9f9;
}

/* Baris hover */
.order-table tbody tr:hover {
    background-color: #d6eaff;
    cursor: default;
}

/* Style untuk kolom kosong */
.order-table td.empty {
    text-align: center;
    font-style: italic;
    color: #888;
}

/* Status styling berdasarkan nilai */
.order-table td.status {
    font-weight: 600;
    text-transform: capitalize;
}

/* Status warna */
.order-table td.status.pending {
    color: #e67e22;
}

.order-table td.status.selesai,
.order-table td.status.completed {
    color: #27ae60;
}

.order-table td.status.batal,
.order-table td.status.cancelled {
    color: #c0392b;
}

.status {
    color: green;
    font-weight: 600;
}
</style>

<div class="container">
    <div class="container-4">
        <div class="container-custom">

            <section class="order-history">
                <h2>Riwayat Pemesanan</h2>

                <table class="order-table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Kode Pemesanan</th>
                            <th>Tanggal</th>
                            <th>Lama Pesan</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Detail</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($riwayat)) : ?>
                        <?php foreach ($riwayat as $i => $r) : ?>
                        <tr>
                            <td><?= $i + 1 ?></td>
                            <td><?= esc($r['kode_pemesanan']) ?></td>
                            <td><?= esc($r['tanggal_pemesanan']) ?></td>
                            <td><?= esc($r['nama_kendaraan']) ?></td>
                            <td>Rp <?= number_format(esc($r['total_harga']), 0, ',', '.') ?></td>
                            <td class="status <?= strtolower($r['status']) ?>"><?= esc($r['status']) ?></td>
                            <td class="text-end">
                                <!-- Tombol yang memicu modal -->
                                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal"
                                    data-bs-target="#modalDetail<?= $i ?>">
                                    <i class="fas fa-eye"></i>
                                </button>
                            </td>
                        </tr>

                        <!-- Modal -->
                        <div class="modal fade" id="modalDetail<?= $i ?>" tabindex="-1"
                            aria-labelledby="modalLabel<?= $i ?>" aria-hidden="true">
                            <div class="modal-dialog modal-lg modal-dialog-centered">
                                <div class="modal-content">
                                    <!-- header -->
                                    <div class="modal-header d-block">
                                        <h3 class="modal-title mb-1" id="modalLabel<?= $i ?>">
                                            #<?= esc($r['kode_pemesanan']) ?>
                                        </h3>
                                        <h5 class="text-muted mb-0">Order Details</h5>
                                        <button type="button" class="btn-close position-absolute top-0 end-0 m-3"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <!-- items -->
                                    <div class="modal-body">
                                        <h5 class="text-muted mb-6">Items</h5>
                                        <div class="row align-items-start">
                                            <!-- Kolom Gambar Kendaraan -->
                                            <div class="col-md-4">
                                                <img src="<?= base_url('uploads/' . esc($r['gambar_kendaraan'])) ?>"
                                                    class="img-fluid rounded shadow-sm mb-2" alt="Gambar Kendaraan"
                                                    style="width: 80%; height: 150px; object-fit: cover;">
                                            </div>


                                            <!-- Kolom Detail Info -->
                                            <div class="col-md-6">
                                                <div class="row">
                                                    <div class="col-sm-5 mb-1">
                                                        <!-- Nama kendaraan ditampilkan blok dan ditebalkan -->
                                                        <p class="mb-1 fw-semibold">
                                                            <?= ucwords(esc($r['merk_kendaraan'] . ' ' . $r['nama_kendaraan'])) ?>
                                                        </p>

                                                        <!-- Harga sewa di bawahnya, dengan sedikit margin atas -->
                                                        <p class="mt-1">Rp
                                                            <?= number_format(esc($r['harga_sewa_kendaraan']), 0, ',', '.') ?>
                                                        </p>
                                                    </div>

                                                    <div class="col-sm-3 mb-2">
                                                        <!-- <p><strong>Lama Pemesanan:</strong></p> -->
                                                        <p><?= esc($r['tahun_kendaraan']) ?></p>
                                                    </div>
                                                    <div class="col-sm-4">
                                                        <!-- <p><strong>Total Harga:</strong></p> -->
                                                        <p><?= esc($r['warna_kendaraan']) ?></p>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>


                                        <div class="modal-body">
                                            <div class="row mb-2">
                                                <div class="col-sm-4 text-muted"><strong>Created At</strong></div>
                                                <?php
                                                $bulanIndo = [
                                                    'January' => 'Januari',
                                                    'February' => 'Februari',
                                                    'March' => 'Maret',
                                                    'April' => 'April',
                                                    'May' => 'Mei',
                                                    'June' => 'Juni',
                                                    'July' => 'Juli',
                                                    'August' => 'Agustus',
                                                    'September' => 'September',
                                                    'October' => 'Oktober',
                                                    'November' => 'November',
                                                    'December' => 'Desember'
                                                ];

                                                $tanggal = date('d', strtotime($r['tanggal_pemesanan']));
                                                $bulan = $bulanIndo[date('F', strtotime($r['tanggal_pemesanan']))];
                                                $tahun = date('Y', strtotime($r['tanggal_pemesanan']));
                                                ?>
                                                <div class="col-sm-4 fw-bold"><?= "$tanggal $bulan $tahun" ?></div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-4 text-muted"><strong>Order Service</strong>
                                                </div>
                                                <div class="col-sm-4 fw-bold">Online</div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-4 text-muted"><strong>Payment Method</strong>
                                                </div>
                                                <div class="col-sm-4 fw-bold">Bank Transfer</div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-4 text-muted"><strong>Status</strong></div>
                                                <div class="col-sm-4 fw-bold"> <?= ucwords(esc($r['status'])) ?>
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                            <hr>
                                            <!-- costumer data -->
                                            <div class="row mb-2">
                                                <div class="col-sm-4 text-muted"><strong>Cosutmer Name</strong>
                                                </div>
                                                <div class="col-sm-4 fw-bold"><?= esc($r['nama_pelanggan']) ?></div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-4 text-muted"><strong>Email</strong></div>
                                                <div class="col-sm-4 text-primary"><?= esc($r['email_pelanggan']) ?>
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                            <div class="row mb-2">
                                                <div class="col-sm-4 text-muted"><strong>Phone</strong></div>
                                                <div class="col-sm-4 fw-bold"><?= esc($r['no_telp_pelanggan']) ?>
                                                </div>
                                                <div class="col-sm-4"></div>
                                            </div>
                                            <hr>
                                            <!-- timeline -->
                                            <h5 class="text-muted mb-3">Items</h5>

                                            <!-- Step 1: Memilih Kendaraan -->
                                            <div class="step-container">
                                                <input type="radio" class="form-check-input step-radio" checked
                                                    disabled>
                                                <div class="row">
                                                    <div class="col-sm-4 text-muted text-success">
                                                        <strong>Memilih Kendaraan</strong><br>
                                                        <small>Pelanggan memilih kendaraan yang tersedia dari
                                                            daftar.</small>
                                                    </div>
                                                    <div class="col-sm-4 text-success">Kendaraan telah dipilih</div>
                                                </div>
                                            </div>

                                            <!-- Step 2: Pembayaran -->
                                            <div class="step-container">
                                                <input type="radio" class="form-check-input step-radio" checked
                                                    disabled>
                                                <div class="row">
                                                    <div class="col-sm-4 text-muted">
                                                        <strong>Pembayaran</strong><br>
                                                        <small>Telah melakukan pembayaran untuk kendaraan yang
                                                            dipilih.</small>
                                                    </div>
                                                    <div class="col-sm-4 text-success">Pembayaran
                                                        <?= ucwords(esc($r['status'])) ?>
                                                    </div>
                                                </div>
                                            </div>


                                            <!-- Step 3: Pengembalian Kendaraan -->
                                            <div class="step-container last-step">
                                                <input type="radio" class="form-check-input step-radio text-success"
                                                    <?= ($r['status_pesan'] == 'Selesai') ? 'checked' : '' ?> disabled>
                                                <div class="row">
                                                    <div class="col-sm-4 text-muted">
                                                        <strong>Pengembalian Kendaraan</strong><br>
                                                        <small>Kendaraan dikembalikan sesuai waktu dan kondisi yang
                                                            telah disepakati.</small>
                                                    </div>
                                                    <div class="col-sm-4 text-success">
                                                        <?= ucwords(esc($r['status_pesan'])) ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <hr>
                                            <!-- payment -->
                                            <h5 class="text-muted mb-3">Payment</h5>

                                            <!-- Subtotal -->
                                            <div class="mb-3">
                                                <div class="row">
                                                    <div class="col-sm-4 text-muted">
                                                        <strong>Total</strong><br>
                                                        <small>Biaya sewa kendaraan</small>
                                                    </div>
                                                    <div class="col-sm-4 fw-bold">
                                                        Rp.
                                                        <?= number_format(esc($r['total_harga']), 0, ',', '.') ?>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php endforeach ?>
                        <?php else : ?>
                        <tr>
                            <td colspan="7" class="empty">Belum ada pemesanan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </section>
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<?= $this->endSection() ?>