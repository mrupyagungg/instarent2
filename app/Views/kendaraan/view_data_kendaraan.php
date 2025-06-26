<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Master Data Kendaraan</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Kendaraan</a></li>
                            <li class="breadcrumb-item active">Master Data Kendaraan</li>
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
                                <a href="<?= base_url('kendaraan/add') ?>" class="btn btn-block btn-primary">Tambah</a>
                            </div>
                        </div>

                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-hover js-basic-example dataTable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Kode Kendaraan</th>
                                        <th>Jenis</th>
                                        <th>Nama</th>
                                        <th>Merk</th>
                                        <th>Tahun</th>
                                        <th>Warna</th>
                                        <th>Harga</th>
                                        <th>Gambar</th>
                                        <th class="text-center"><i class="fa fa-cog fa-spin"></i></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    foreach ($kendaraan as $data): ?>
                                    <tr>
                                        <td> <?= $no++ ?> </td>
                                        <td> <?= $data['kode_kendaraan'] ?> </td>
                                        <td> <?= $data['jenis_kendaraan'] ?> </td>
                                        <td> <?= $data['nama_kendaraan'] ?> </td>
                                        <td> <?= $data['merk_kendaraan'] ?> </td>
                                        <td> <?= $data['tahun_kendaraan'] ?> </td>
                                        <td> <?= $data['warna_kendaraan'] ?> </td>
                                        <td> <?= nominal($data['harga_sewa_kendaraan']) ?> </td>
                                        <td>
                                            <?php if (!empty($data['gambar_kendaraan'])): ?>
                                            <img src="<?= base_url('uploads/' . $data['gambar_kendaraan']) ?>"
                                                alt="Gambar Kendaraan" style="width: 100px; height: auto;">
                                            <?php else: ?>
                                            <span>No Image</span>
                                            <?php endif; ?>
                                        </td>

                                        <td class="text-center">
                                            <a href="<?= base_url('kendaraan/edit/' . $data['id_kendaraan']) ?>"
                                                type="button" class="btn btn-sm btn-warning">
                                                <i class="fa fa-edit"></i>Edit
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

<script>
function deleteConfirm(e) {
    var tomboldelete = document.getElementById('btn-delete')
    id = e.getAttribute('data-id');
    kode = e.getAttribute('data-kode');

    var url3 = "<?= base_url('kendaraan/delete/') ?>";
    var url4 = url3.concat("/", id);
    tomboldelete.setAttribute("href", url4); //akan meload kontroller delete

    var pesan = "Data dengan Kode <b>"
    var pesan2 = " </b>akan dihapus"
    var res = kode;
    document.getElementById("text").innerHTML = pesan.concat(res, pesan2);

    var myModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
        keyboard: false
    });

    myModal.show();
}
</script>

<div id="deleteModal" class="modal fade" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" role="dialog"
    aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-primary">
                <h5 class="modal-title mt-0 text-white">Apa Kamu Yakin?</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p id="text"></p>
                <p>Data yang dihapus tidak akan bisa dikembalikan.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                    <i class="mdi mdi-close-thick"></i> Batal
                </button>
                <a href="#" class="btn btn-danger" id="btn-delete">
                    <i class="mdi mdi-trash-can"></i> Hapus
                </a>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection('content-admin'); ?>