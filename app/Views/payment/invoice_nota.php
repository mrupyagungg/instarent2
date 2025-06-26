<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Struk Pembayaran</title>
    <style>
    body {
        font-family: 'Courier New', Courier, monospace;
        font-size: 12px;
        width: 300px;
        /* ukuran struk standar */
        margin: 0 auto;
    }

    .center {
        text-align: center;
    }

    .line {
        border-top: 1px dashed #000;
        margin: 10px 0;
    }

    .row {
        display: flex;
        justify-content: space-between;
    }

    .bold {
        font-weight: bold;
    }

    .footer {
        text-align: center;
        margin-top: 20px;
    }
    </style>
</head>

<body>

    <div class="center bold">INSTARRENT</div>
    <div class="center">Jl. Raya Bandung No.1</div>
    <div class="center">Telp: 0812-3456-7890</div>

    <div class="line"></div>

    <div class="row">
        <span>Kode</span>
        <span><?= esc($kode_pemesanan) ?></span>
    </div>
    <div class="row">
        <span>Nama</span>
        <span><?= esc($nama_pelanggan) ?></span>
    </div>
    <div class="row">
        <span>Tanggal</span>
        <span><?= esc($tanggal_pemesanan) ?></span>
    </div>

    <div class="line"></div>

    <div class="row bold">
        <span>Deskripsi</span>
        <span>Harga</span>
    </div>
    <div class="row">
        <span>Sewa Kendaraan</span>
        <span>Rp<?= number_format($total_harga, 0, ',', '.') ?></span>
    </div>

    <div class="line"></div>

    <div class="row bold">
        <span>Total</span>
        <span>Rp<?= number_format($total_harga, 0, ',', '.') ?></span>
    </div>

    <div class="footer">
        <p>Terima kasih atas pembayaran Anda</p>
    </div>

</body>

</html>