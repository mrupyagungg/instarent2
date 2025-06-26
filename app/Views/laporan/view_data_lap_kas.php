<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>

<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Laba Rugi</h4>
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="#">Jurnal</a></li>
                            <li class="breadcrumb-item active">Laba Rugi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <!-- Filter -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form action="<?= base_url('laba-rugi/filter') ?>" method="post">
                            <div class="row">
                                <div class="form-group col-md-4 mb-1">
                                    <select class="form-control" name="month" required>
                                        <option value="" disabled selected>Bulan</option>
                                        <?php for ($i = 1; $i <= 12; $i++): ?>
                                        <option value="<?= $i ?>"><?= format_bulan($i) ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4 mb-1">
                                    <select class="form-control" name="year" required>
                                        <option value="" disabled selected>Tahun</option>
                                        <?php for ($y = 2023; $y <= date('Y'); $y++): ?>
                                        <option value="<?= $y ?>"><?= $y ?></option>
                                        <?php endfor; ?>
                                    </select>
                                </div>
                                <div class="col-md-4">
                                    <button type="submit" class="btn btn-dark waves-effect waves-light">
                                        <i class="bx bx-filter font-size-16 align-middle me-2"></i> Filter
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <!-- Report Table -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">

                        <?php if (!empty($date) && !empty($year)): ?>
                        <div class="text-center pb-3">
                            <b>INSTA RENT</b><br>
                            <b>LAPORAN LABA RUGI</b><br>
                            <b>Periode <?= $date ?> <?= $year ?></b><br><br>
                            <a href="<?= base_url("laba-rugi/pdf/$month/$year") ?>" class="btn btn-danger btn-sm">
                                <i class="btn btn-danger btn-lg px-4"></i> Download PDF
                            </a>
                            <a href="<?= base_url("laba-rugi/excel/$month/$year") ?>" class="btn btn-success btn-sm">
                                <i class="btn btn-success btn-lg px-4"></i> Download Excel
                            </a>
                        </div>
                        <?php endif; ?>

                        <div class="table-responsive mt-3">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>Keterangan</th>
                                        <th class="text-center">Nominal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pendapatan) || !empty($beban)): ?>
                                    <tr>
                                        <td><b>Pendapatan</b></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                        $total_pendapatan = 0;
                                        foreach ($pendapatan as $pen):
                                            $total_pendapatan += $pen['nominal'];
                                        ?>
                                    <tr>
                                        <td><?= $pen['nama_akun'] ?></td>
                                        <td class="text-center"><?= nominal($pen['nominal']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td><b>Total Pendapatan</b></td>
                                        <td class="text-center"><b><?= nominal($total_pendapatan) ?></b></td>
                                    </tr>

                                    <tr>
                                        <td><b>Beban</b></td>
                                        <td></td>
                                    </tr>
                                    <?php
                                        $total_beban = 0;
                                        foreach ($beban as $beb):
                                            $total_beban += $beb['nominal'];
                                        ?>
                                    <tr>
                                        <td><?= $beb['nama_akun'] ?></td>
                                        <td class="text-center"><?= nominal($beb['nominal']) ?></td>
                                    </tr>
                                    <?php endforeach; ?>
                                    <tr>
                                        <td><b>Total Beban</b></td>
                                        <td class="text-center"><b><?= nominal($total_beban) ?></b></td>
                                    </tr>

                                    <?php $laba_bersih = $total_pendapatan - $total_beban; ?>
                                    <tr>
                                        <td><b><?= $laba_bersih >= 0 ? 'Laba Bersih' : 'Rugi Bersih' ?></b></td>
                                        <td class="text-center"><b><?= nominal($laba_bersih) ?></b></td>
                                    </tr>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="2" class="text-center">Silakan pilih bulan dan tahun untuk
                                            menampilkan data.</td>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<?= $this->endSection('content-admin'); ?>