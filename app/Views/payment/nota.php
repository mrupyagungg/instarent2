<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Nota Bukti Bayar</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        width: 600px;
        margin: 0 auto;
        padding: 20px;
        font-size: 13px;
    }

    h2 {
        text-align: center;
        margin-bottom: 20px;
    }

    .header {
        display: flex;
        justify-content: space-between;
        margin-bottom: 30px;
    }

    .company-info {
        line-height: 1.5;
        margin-right: 20px;
    }

    .company-info img {
        width: 90px;
        margin-bottom: 10px;
    }

    .company-info h3 {
        margin: 0;
        padding: 0;
    }

    .company-info strong {
        font-size: 14px;
    }

    .company-info p {
        margin: 5px 0;
    }

    .right-info {
        text-align: right;
    }

    .right-info p {
        margin: 5px 0;
    }

    table {
        width: 110%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 8px;
        text-align: left;
    }

    th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    .price {
        text-align: right;
    }

    .total {
        font-weight: bold;
    }

    .note {
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <div class="header">
        <div class="company-info">
            <?php if (!empty($logo)): ?>
            <img src="<?= $logo ?>" alt="Logo Instarent">
            <?php endif; ?>
            <h3>Instarent</h3>
            <strong>Rental Kendaraan Bandung</strong><br>
            PBB Ruko R.11 Buah Batu, Bandung, Jawa Barat <br>
            Sukapura, Kec. Dayeuhkolot, Kabupaten Bandung, Jawa Barat <br>
            No. Telp: 0811 504 100
        </div>

        <div class="right-info">
            <h2>NOTA BUKTI BAYAR</h2>
            <!-- <p><strong>No. Pembayaran:</strong> <?= esc($kode_pemesanan) ?></p> -->
        </div>
    </div>

    <p><strong>Tanggal Pembayaran: </strong> <?= esc($tanggal_pemesanan) ?></p>
    <p><strong>No. Pembayaran: </strong>INS/INV/<?= esc($kode_pemesanan) ?></p>
    <p><strong>Nama Pelanggan: </strong> <?= esc($nama_pelanggan) ?></p>
    <p><strong>Email: </strong> <?= esc($email_pelanggan) ?></p>
    <p><strong>No. Telp: </strong> <?= esc($no_telp_pelanggan) ?></p>

    <table>
        <thead>
            <tr>
                <th>No.</th>
                <th>Deskripsi</th>
                <th>Kendaraan</th>
                <th>Tanggal Awal</th>
                <th>Tanggal Akhir</th>
                <th>Durasi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Pembayaran untuk Pemesanan Kendaraan<br><?= esc($jenis_kendaraan) ?></td>
                <td><?= esc($nama_kendaraan) ?></td>
                <td><?= esc($tanggal_awal) ?></td>
                <td><?= esc($tanggal_akhir) ?></td>
                <td><?= esc($lama_pemesanan) ?> Hari</td>
                <td class="price"><?= number_format($total_harga, 0, ',', '.') ?></td>
            </tr>
        </tbody>
    </table>

    <p class="note"><strong>Keterangan: </strong><br>1. Pengembalian Harus sesuai dengan waktu yang di tentukan Tidak
        boleh lewat dari tanggal akgir <br>2. Apabila Terjadi Kerusakan Harap mengganti</p>

</body>

</html>