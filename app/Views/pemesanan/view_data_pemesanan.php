<?=$this->extend('templates/head');?>
<?=$this->section('content-admin');?>

<!-- Select2 CSS -->
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

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
                            <!-- Tombol Tambah (Trigger Modal) -->
                            <div class="pl-3 mb-4">
                                <button class="btn btn-block btn-primary" data-toggle="modal"
                                    data-target="#tambahPemesananModal">
                                    Tambah
                                </button>
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
                                            <?php if ($data['status_pesan'] === 'pinjam'): ?>
                                            <a href="<?= base_url('pemesanan/kembalikan/' . $data['id_pemesanan']) ?>"
                                                class="btn btn-danger btn-sm w-100">
                                                Kembalikan
                                            </a>
                                            <?php else: ?>
                                            <span class="btn btn-success btn-sm w-100" disabled>
                                                <?= esc(ucfirst($data['status_pesan'])) ?>
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
                <!-- Modal Tambah Pemesanan -->
                <div class="modal fade" id="tambahPemesananModal" tabindex="-1" role="dialog"
                    aria-labelledby="modalLabelTambah" aria-hidden="true">
                    <div class="modal-dialog modal-lg" role="document">
                        <form action="<?= base_url('pemesanan/add') ?>" method="post" enctype="multipart/form-data">
                            <div class="modal-content">
                                <div class="modal-header bg-primary text-white">
                                    <h5 class="modal-title" id="modalLabelTambah">Tambah Pemesanan</h5>
                                    <button type="button" class="close text-white" data-dismiss="modal"
                                        aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                                <div class="modal-body">
                                    <!-- Kode Pemesanan -->
                                    <div class="form-group">
                                        <label class="form-label">Kode Pemesanan</label>
                                        <input type="text" class="form-control" value="<?= esc($kode_pemesanan) ?>"
                                            disabled>
                                        <input type="hidden" name="kode_pemesanan" value="<?= esc($kode_pemesanan) ?>">
                                    </div>

                                    <!-- Tanggal Pemesanan -->
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Pemesanan</label>
                                        <input type="date" class="form-control" name="tanggal_pemesanan"
                                            value="<?= date('Y-m-d') ?>" readonly>
                                    </div>

                                    <!-- Nama Pelanggan -->
                                    <div class="form-group">
                                        <label for="nama_pelanggan">Nama Pelanggan</label>
                                        <input type="text" class="form-control" id="nama_pelanggan"
                                            name="nama_pelanggan" required autocomplete="off"
                                            value="<?= old('nama_pelanggan') ?>">
                                        <input type="hidden" name="id_pelanggan" id="id_pelanggan"
                                            value="<?= old('id_pelanggan') ?>">
                                        <small id="status_pelanggan" class="form-text text-muted"></small>
                                    </div>

                                    <!-- Kendaraan -->
                                    <div class="form-group">
                                        <label for="nama_kendaraan">Kendaraan</label>
                                        <select name="kendaraan_id" id="kendaraan_id" class="form-control" required>
                                            <option value="">Pilih Kendaraan</option>
                                            <?php foreach ($kendaraan as $k): ?>
                                            <option value="<?= $k['id_kendaraan'] ?>"
                                                data-harga="<?= $k['harga_sewa_kendaraan'] ?>"
                                                <?= old('kendaraan_id') == $k['id_kendaraan'] ? 'selected' : '' ?>>
                                                <?= esc($k['nama_kendaraan']) ?> -
                                                Rp<?= number_format($k['harga_sewa_kendaraan'], 0, ',', '.') ?>/hari
                                            </option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>

                                    <!-- Tanggal -->
                                    <div class="form-group">
                                        <label class="form-label">Tanggal Awal</label>
                                        <input type="date" class="form-control" name="tanggal_awal" id="tanggal_awal"
                                            value="<?= old('tanggal_awal') ?>" required>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Tanggal Akhir</label>
                                        <input type="date" class="form-control" name="tanggal_akhir" id="tanggal_akhir"
                                            value="<?= old('tanggal_akhir') ?>" required>
                                    </div>

                                    <!-- Durasi dan Total -->
                                    <div class="form-group">
                                        <label for="lama_pemesanan" class="form-label">Lama Pemesanan (Hari)</label>
                                        <input type="number" class="form-control" id="lama_pemesanan"
                                            name="lama_pemesanan" value="<?= old('lama_pemesanan') ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="total_harga" class="form-label">Total Harga</label>
                                        <input type="text" class="form-control" id="total_harga" name="total_harga"
                                            value="<?= old('total_harga') ?>" readonly>
                                    </div>

                                    <!-- Upload -->
                                    <div class="mb-3">
                                        <label for="jaminan_identitas" class="form-label"><strong>Jaminan Identitas
                                                (KTP/SIM):</strong></label>
                                        <input type="file" id="jaminan_identitas" name="jaminan_identitas"
                                            class="form-control" accept="image/*" required>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    let hargaPerHari = 0;

    const kendaraanSelect = document.getElementById('kendaraan_id');
    const tanggalAwal = document.getElementById('tanggal_awal');
    const tanggalAkhir = document.getElementById('tanggal_akhir');
    const lamaPemesanan = document.getElementById('lama_pemesanan');
    const totalHarga = document.getElementById('total_harga');

    if (kendaraanSelect && tanggalAwal && tanggalAkhir && lamaPemesanan && totalHarga) {
        kendaraanSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            hargaPerHari = parseInt(selectedOption.getAttribute('data-harga')) || 0;
            hitungDurasiDanTotal();
        });

        tanggalAwal.addEventListener('change', hitungDurasiDanTotal);
        tanggalAkhir.addEventListener('change', hitungDurasiDanTotal);

        function hitungDurasiDanTotal() {
            const tglAwalVal = tanggalAwal.value;
            const tglAkhirVal = tanggalAkhir.value;

            if (tglAwalVal && tglAkhirVal) {
                const dateAwal = new Date(tglAwalVal);
                const dateAkhir = new Date(tglAkhirVal);

                let durasi = Math.floor((dateAkhir - dateAwal) / (1000 * 60 * 60 * 24));
                durasi = durasi < 0 ? 0 : durasi;
                durasi = Math.max(1, durasi); // minimal 1 hari

                lamaPemesanan.value = durasi;

                const total = durasi * hargaPerHari;
                totalHarga.value = total;
            }
        }
    }
});
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const inputNama = document.getElementById('nama_pelanggan');
    const statusPelanggan = document.getElementById('status_pelanggan');
    const inputIdPelanggan = document.getElementById('id_pelanggan');

    inputNama.addEventListener('input', function() {
        const nama = inputNama.value.trim();

        if (nama.length > 0) {
            fetch(`<?= base_url('pemesanan/cariPelanggan') ?>?nama=${encodeURIComponent(nama)}`)
                .then(response => response.json())
                .then(data => {
                    if (data.status === 'found') {
                        statusPelanggan.textContent = "✅ Pelanggan tersedia";
                        statusPelanggan.style.color = "green";
                        inputIdPelanggan.value = data.id;
                    } else {
                        statusPelanggan.textContent = "❌ Pelanggan tidak ditemukan";
                        statusPelanggan.style.color = "red";
                        inputIdPelanggan.value = "";
                    }
                })
                .catch(error => {
                    statusPelanggan.textContent = "⚠️ Terjadi kesalahan";
                    statusPelanggan.style.color = "orange";
                    inputIdPelanggan.value = "";
                });
        } else {
            statusPelanggan.textContent = "";
            inputIdPelanggan.value = "";
        }
    });
});
</script>


<!-- Inisialisasi Select2 -->
<script>
$(document).ready(function() {
    $('#id_pelanggan').select2({
        placeholder: "Pilih atau cari pelanggan...",
        allowClear: true,
        width: '100%' // agar menyesuaikan lebar form-control
    });
});
</script>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Select2 JS -->
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<?=$this->endSection('content-admin');?>