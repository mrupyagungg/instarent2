<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center
                    justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Transaksi Pengeluaran</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:
                                    void(0);">Pengeluaran</a></li>
                            <li class="breadcrumb-item active">Transaksi Pengeluaran</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="row">
                            <div class="pl-3 mb-4">
                                <a href="<?= base_url('pengeluaran/add') ?>"
                                    class="btn btn-block btn-primary">Tambah</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Transaksi</th>
                                        <th>Tanggal</th>
                                        <th>Keterangan</th>
                                        <th>Jumlah</th>
                                        <th class="text-center"><i class="fa fa-cog fa-spin"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($pengeluaran as $data) : ?>
                                    <tr>
                                        <td> <?= $no++ ?> </td>
                                        <td> <?= $data['kode_transaksi'] ?> </td>
                                        <td> <?= format_date($data['tanggal']) ?> </td>
                                        <td> <?= $data['keterangan'] ?> </td>
                                        <td> <?= nominal($data['jumlah']) ?> </td>
                                        <td class="text-center">
                                            <a href="<?= base_url('pengeluaran/edit/' . $data['kode_transaksi']) ?>"
                                                type="button" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- end row -->
    </div> <!-- container-fluid -->
</div>
<!-- End Page-content -->

<?= $this->endSection('content-admin'); ?>