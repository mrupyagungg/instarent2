<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Pembayaran Berhasil</title>
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
    * {
        font-family: 'Poppins', sans-serif;
    }

    body {
        background: linear-gradient(to right, #e0ffe0, #f0fff0);
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
        margin: 0;
    }

    .success-box {
        background: #fff;
        padding: 40px;
        border-radius: 16px;
        text-align: center;
        box-shadow: 0 8px 24px rgba(0, 128, 0, 0.15);
        max-width: 480px;
        width: 90%;

        /* Animasi muncul */
        opacity: 0;
        transform: scale(0.9);
        animation: fadeInScale 0.6s ease-out forwards;
    }

    @keyframes fadeInScale {
        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .checkmark {
        width: 80px;
        height: 80px;
        margin: 0 auto 20px;
    }

    .checkmark-circle {
        stroke-dasharray: 166;
        stroke-dashoffset: 166;
        stroke-width: 6;
        stroke-miterlimit: 10;
        stroke: #2ecc71;
        fill: none;
        animation: stroke 0.6s ease-in-out forwards;
    }

    .checkmark-check {
        transform-origin: 50% 50%;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        stroke-width: 6;
        stroke: #2ecc71;
        fill: none;
        animation: stroke 0.4s 0.6s ease-in-out forwards;
    }

    @keyframes stroke {
        to {
            stroke-dashoffset: 0;
        }
    }

    .success-box h1 {
        color: #2ecc71;
        font-size: 2rem;
        margin-bottom: 10px;
    }

    .success-box p {
        color: #444;
        margin-bottom: 5px;
    }

    .btn-custom {
        margin-top: 20px;
        display: inline-block;
        padding: 12px 24px;
        font-weight: 600;
        border-radius: 8px;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .btn-success-custom {
        background-color: #2ecc71;
        color: #fff;
    }

    .btn-success-custom:hover {
        background-color: #27ae60;
        text-decoration: none;
    }

    .btn-info-custom {
        background-color: #3498db;
        color: #fff;
        margin-left: 10px;
    }

    .btn-info-custom:hover {
        background-color: #2980b9;
        text-decoration: none;
    }
    </style>
</head>

<body>

    <div class="success-box">
        <!-- SVG Checkmark with animation -->
        <svg class="checkmark" viewBox="0 0 52 52">
            <circle class="checkmark-circle" cx="26" cy="26" />
            <path class="checkmark-check" fill="none" d="M14 27l7 7 16-16" />
        </svg>

        <h1>Pembayaran Berhasil!</h1>
        <p>Kode Pemesanan Anda:</p>
        <p><strong><?= esc($kode_pemesanan) ?></strong></p>
        <p>Terima kasih telah melakukan pembayaran.</p>
        <p>Pemesanan Anda sedang diproses.</p>
        <div class="mt-4">
            <a href="<?= base_url('customer/dashboard') ?>" class="btn-custom btn-success-custom">Kembali ke Beranda</a>
            <a href="<?= base_url('payment/download_invoice/' . esc($kode_pemesanan)) ?>"
                class="btn-custom btn-info-custom">Download Nota PDF</a>
        </div>
    </div>

</body>

</html>