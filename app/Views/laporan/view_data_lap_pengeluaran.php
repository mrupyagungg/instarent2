<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Laporan Pengeluaran</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:
                                    void(0);">Pengeluaran Kas</a></li>
                            <li class="breadcrumb-item active">Laporan Pengeluaran</li>
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
                        <div class="row">
                            <form action="<?= base_url('laporan-pengeluaran/filter') ?>" method="post">
                                <div class="row">
                                    <div class="form-group col-md-2 mb-1">
                                        <select class="form-control" name="month" required>
                                            <option value="" disabled selected>Bulan</option>
                                            <?php for ($i = 1; $i < 13; $i++) { ?>
                                                <option value="<?= $i ?>"><?= format_bulan($i) ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-2 mb-1">
                                        <select class="form-control" name="year" required>
                                            <option value="" disabled selected>Tahun</option>
                                            <option value="2022">2022</option>
                                            <option value="2023">2023</option>
                                            <option value="2024">2024</option>
                                        </select>
                                    </div>
                                    <div class="col-md-2">
                                        <button type="submit" class="btn btn-dark waves-effect waves-light">
                                            <i class="bx bx-loader bx-spin font-size-16 align-middle me-2"></i> Filter
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="pb-2">
                                <div class="row">
                                    <div class="col-sm-12" style="background-color:white;" align="center">
                                        <b>PODA RENT</b>
                                    </div>
                                    <div class="col-sm-12" style="background-color:white;" align="center">
                                        <b>LAPORAN PENGELUARAN KAS</b>
                                    </div>
                                    <div class="col-sm-12" style="background-color:white;" align="center">
                                        <b>Periode <?= $date ?> <?= $year ?></b>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

                        <div class="table-responsive">
                            <table id="jurnal" class="table align-middle dt-responsive nowrap table-striped" style="border-collapse: collapse;width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengeluaran as $data) : ?>
                                        <tr>
                                            <td> <?= $no++ ?> </td>
                                            <td> <?= format_date($data['tanggal']) ?> </td>
                                            <td> <?= $data['keterangan'] ?> </td>
                                            <td> <?= nominal($data['jumlah']) ?> </td>
                                        </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table responsive -->
                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<?= $this->endSection('content-admin'); ?>