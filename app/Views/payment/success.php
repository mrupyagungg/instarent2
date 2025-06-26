<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <style>
    body {
        background-color: #f0fff0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        flex-direction: column;
    }

    .success-box {
        background: #ffffff;
        padding: 30px;
        border-radius: 12px;
        text-align: center;
        box-shadow: 0px 4px 10px rgba(0, 128, 0, 0.2);
    }

    .success-box h1 {
        color: green;
    }

    .btn-download {
        margin-top: 15px;
        background-color: rgb(255, 0, 0);
        color: white;
        text-decoration: none;
        padding: 10px 20px;
        border-radius: 5px;
        font-weight: bold;
    }

    .btn-download:hover {
        background-color: rgb(179, 0, 0);
        text-decoration: none;
        col
    }
    </style>
</head>

<body>

    <div class="success-box">
        <h1>✅ Pembayaran Berhasil!</h1>
        <p>Kode Pemesanan Anda: <strong><?= esc($kode_pemesanan) ?></strong></p>
        <p>Terima kasih telah melakukan pembayaran. Pemesanan Anda sedang diproses.</p>
        <a href="<?= base_url('customer/dashboard') ?>" class="btn btn-success mt-3">Kembali ke Beranda</a>
        <!-- Tombol untuk download nota -->
        <a href="<?= base_url('payment/download_invoice/' . esc($kode_pemesanan)) ?>" class="btn btn-info">Download
            Nota
            PDF</a>
    </div>

</body>

</html>