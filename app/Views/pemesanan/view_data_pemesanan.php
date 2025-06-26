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
                            <div class="pl-3 mb-4">
                                <a href="<?= base_url('pemesanan/add') ?>" class="btn btn-block btn-primary">Tambah</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th class=" text-center">No</th>
                                        <th class=" text-center">Kode Pemesanan</th>
                                        <th class=" text-center">Tanggal Awal</th>
                                        <th class=" text-center">Tanggal Akhir</th>
                                        <th class=" text-center">Durasi</th>
                                        <th class=" text-center">Total Harga</th>
                                        <th class=" text-center">Ktp/SIM</th>
                                        <th class=" text-center">Pelanggan</th>
                                        <th class=" text-center">Kendaraan</th>
                                        <th class=" text-center">Nota</th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Status Pemesanan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if (!empty($pemesanan) && is_array($pemesanan)): ?>
                                    <?php $no = 1; ?>
                                    <?php foreach ($pemesanan as $data): ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= esc($data['kode_pemesanan']) ?></td>
                                        <!-- <td><?= date('d F Y', strtotime($data['tanggal_pemesanan'])) ?></td> -->
                                        <td><?= date('d F Y', strtotime($data['tanggal_awal'])) ?></td>
                                        <td><?= date('d F Y', strtotime($data['tanggal_akhir'])) ?></td>
                                        <td><?= esc($data['lama_pemesanan']) ?> Hari</td>
                                        <!-- <td><?= date('d F Y', strtotime($data['tanggal_pemesanan'] . ' +' . $data['lama_pemesanan'] . ' days')) ?> -->
                                        </td>
                                        <td><?= nominal($data['total_harga']) ?></td>
                                        <td>
                                            <img src="<?= base_url('uploads/images/' . $data['jaminan_identitas']) ?>"
                                                alt="<?= esc($data['kode_pemesanan']) ?>" width="150px">
                                        </td>

                                        <td><?= esc($data['nama_pelanggan']) ?></td>
                                        <td><?= esc($data['nama_kendaraan']) ?></td>
                                        <td>
                                            <a href="<?= base_url('pemesanan/nota/' . $data['id_pemesanan']) ?>"
                                                class="btn btn-primary">Download Nota</a>
                                        </td>

                                        <td><?= esc($data['status']) ?></td>
                                        <td class="text-center">
                                            <?php if ($data['status_pesan'] === 'pesan'): ?>
                                            <a href="<?= base_url('pemesanan/kembalikan/' . $data['id_pemesanan']) ?>"
                                                class="btn btn-warning btn-sm w-100">
                                                <?= esc($data['status_pesan']) ?>
                                            </a>
                                            <?php else: ?>
                                            <span class="btn btn-success btn-sm w-100" disabled>
                                                <?= esc($data['status_pesan']) ?>
                                            </span>
                                            <?php endif; ?>
                                        </td>
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