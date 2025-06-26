<?=$this->extend('templates/head');?>
<?=$this->section('content-admin');?>

<div class="page-content">
    <div class="container-fluid">


        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Transaksi Pemesanan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Pemesanan</a></li>
                            <li class="breadcrumb-item active">Transaksi Pemesanan</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>


        <div class="row clearfix">
            <div class="col-lg-12">
                <div class="card">
                    <div class="body">
                        <div class="row">

                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Pelanggan</th>
                                        <th>Nama Pelanggan</th>
                                        <th>No Telp</th>
                                        <th>Email</th>
                                        <th>Alamat</th>
                                        <th>Jenis Kelamin</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pelanggan) && is_array($pelanggan)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pelanggan as $data): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($data['kode_pelanggan']) ?></td>
                                        <td><?= esc($data['nama_pelanggan']) ?></td>
                                        <td><?= esc($data['no_telp_pelanggan']) ?></td>
                                        <td><?= esc($data['email_pelanggan']) ?></td>
                                        <td><?= esc($data['alamat_pelanggan']) ?></td>
                                        <td><?= esc($data['jenis_kelamin_pelanggan']) ?></td>

                                    </tr>
                                    <?php endforeach; ?>
                                    <?php else: ?>
                                    <tr>
                                        <td colspan="12">No data available</td>
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


<?=$this->endSection('content-admin');?>