<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<style>
/* Semua kolom angka di tabel keuangan diratakan ke kanan */
.table td.text-end,
.table th.text-end {
    text-align: right !important;
}

/* Alternatif: paksa kolom keuangan rata kanan walau tak pakai .text-end */
.table td:nth-child(4),
.table td:nth-child(5),
.table td:nth-child(6),
.table td:nth-child(7),
.table th:nth-child(4),
.table th:nth-child(5),
.table th:nth-child(6),
.table th:nth-child(7) {
    text-align: right !important;
}
</style>

<div class="page-content">
    <div class="container-fluid">

        <!-- Header -->
        <div class="row mb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-0">Buku Besar</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Jurnal</a></li>
                            <li class="breadcrumb-item active">Buku Besar</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>

        <!-- Filter Form -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">
                        <form action="<?= base_url('buku-besar/filter') ?>" method="post">
                            <div class="row g-2 align-items-end">
                                <div class="col-md-3">
                                    <label for="month" class="form-label">Bulan</label>
                                    <select class="form-control" name="month" required>
                                        <option value="" disabled selected>Pilih Bulan</option>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?= $i ?>"><?= format_bulan($i) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="year" class="form-label">Tahun</label>
                                    <select class="form-control" name="year" required>
                                        <option value="" disabled selected>Pilih Tahun</option>
                                        <?php for ($y = date('Y') - 2; $y <= date('Y'); $y++): ?>
                                        <option value="<?= $y ?>"><?= $y ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="id_akun" class="form-label">Akun</label>
                                    <select class="form-control" name="id_akun" required>
                                        <option value="" disabled selected>Pilih Akun</option>
                                        <?php foreach ($list_akun as $list): ?>
                                        <option value="<?= $list['id_akun'] ?>"><?= esc($list['nama_akun']) ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <button type="submit" class="btn btn-dark w-100">
                                        <i class="bx bx-filter me-1"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Table Buku Besar -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow-sm">
                    <div class="card-body">

                        <!-- Judul -->
                        <div class="text-center pb-3">
                            <h5 class="fw-bold mb-0">INSTA RENT</h5>
                            <h5 class="fw-bold">BUKU BESAR</h5>
                            <p class="mb-0"><strong>Periode:</strong> <?= esc($date ?? '-') ?> <?= esc($year ?? '-') ?>
                            </p>
                            <p class="mb-3"><strong>Akun:</strong> <?= esc($nama_akun ?? '-') ?></p>

                            <?php if (isset($buku_besar) && !empty($buku_besar)): ?>
                            <div class="d-flex justify-content-center mb-3">
                                <div class="btn-group">
                                    <a href="<?= base_url('buku-besar/download/pdf/' . $id_akun . '/' . $month . '/' . $year) ?>"
                                        target="_blank" class="btn btn-danger px-4 py-2 fs-6">
                                        <i class="fas fa-file-pdf me-2"></i> Download PDF
                                    </a>
                                    <a href="<?= base_url('buku-besar/download/excel/' . $id_akun . '/' . $month . '/' . $year) ?>"
                                        target="_blank" class="btn btn-success px-4 py-2 fs-6">
                                        <i class="fas fa-file-excel me-2"></i> Download Excel
                                    </a>
                                </div>
                            </div>

                            <?php endif; ?>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-hover align-middle">
                                <thead class="table-light">
                                    <tr>
                                        <th rowspan="2">Tanggal</th>
                                        <th rowspan="2">Nama Akun</th>
                                        <th rowspan="2">REF</th>
                                        <th rowspan="2" class="text-end">Debet</th>
                                        <th rowspan="2" class="text-end">Kredit</th>
                                        <th colspan="2">Saldo</th>
                                    </tr>
                                    <tr>
                                        <th class="text-end">Debet</th>
                                        <th class="text-end">Kredit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $saldo_debet = 0;
                                        $saldo_kredit = 0;
                                        ?>

                                    <!-- Saldo Awal -->
                                    <tr>
                                        <td>-</td>
                                        <td class="bg-light"><b>Saldo Awal</b></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <?php if ($posisi_saldo_normal === 'd'): ?>
                                        <?php $saldo_debet = $saldo_awal; ?>
                                        <td class="bg-light text-end"><b><?= nominal($saldo_awal) ?></b></td>
                                        <td class="text-end">-</td>
                                        <?php else: ?>
                                        <?php $saldo_kredit = $saldo_awal; ?>
                                        <td class="text-end">-</td>
                                        <td class="bg-light text-end"><b><?= nominal($saldo_awal) ?></b></td>
                                        <?php endif; ?>
                                    </tr>

                                    <!-- Data Transaksi -->
                                    <?php if (!empty($buku_besar)): ?>
                                    <?php foreach ($buku_besar as $data): ?>
                                    <tr>
                                        <td><?= esc($data['tanggal']) ?></td>
                                        <td><?= esc($data['nama_akun']) ?></td>
                                        <td><?= esc($data['id_akun']) ?></td>

                                        <?php if ($data['posisi'] === 'd'): ?>
                                        <td class="text-end"><?= nominal($data['nominal']) ?></td>
                                        <td class="text-end">-</td>
                                        <?php $saldo_debet += $data['nominal']; ?>
                                        <?php else: ?>
                                        <td class="text-end">-</td>
                                        <td class="text-end"><?= nominal($data['nominal']) ?></td>
                                        <?php $saldo_kredit += $data['nominal']; ?>
                                        <?php endif; ?>

                                        <td class="text-end"><?= nominal($saldo_debet) ?></td>
                                        <td class="text-end"><?= nominal($saldo_kredit) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="7" class="text-danger">Data tidak ditemukan. Silakan filter
                                            terlebih dahulu.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>

                                <!-- Saldo Akhir -->
                                <?php if (!empty($buku_besar)): ?>
                                <tfoot>
                                    <tr>
                                        <td>-</td>
                                        <td class="bg-light"><b>Saldo Akhir</b></td>
                                        <td>-</td>
                                        <td>-</td>
                                        <td>-</td>
                                        <?php if ($posisi_saldo_normal === 'd'): ?>
                                        <?php $saldo_akhir = $saldo_debet - $saldo_kredit; ?>
                                        <td class="text-end"><b><?= nominal($saldo_akhir) ?></b></td>
                                        <td class="text-end">-</td>
                                        <?php else: ?>
                                        <?php $saldo_akhir = $saldo_kredit - $saldo_debet; ?>
                                        <td class="text-end">-</td>
                                        <td class="text-end"><b><?= nominal($saldo_akhir) ?></b></td>
                                        <?php endif; ?>
                                    </tr>
                                </tfoot>
                                <?php endif; ?>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection(); ?>