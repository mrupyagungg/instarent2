<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rent Your Favourite Car</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="./favicon.svg" type="image/svg+xml">

    <!-- Custom CSS Link -->
    <link rel="stylesheet" href="<?= base_url('assets/css/stylee.css') ?>">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
</head>

<body>

    <!-- HEADER -->
    <header class="header" data-header>
        <div class="container">

            <div class="overlay" data-overlay></div>

            <!-- Navbar Header -->
            <div class="navbar-header">
                <h3>Instarent</h3>
            </div>

            <!-- Header Actions -->
            <div class="header-actions">
                <div class="header-contact">
                    <a href="tel:88002345678" class="contact-link">081002345678</a>
                    <span class="contact-time">Mon - Sat: 9:00 am - 6:00 pm</span>
                </div>
            </div>

        </div>
    </header>

    <!-- MAIN CONTENT -->
    <main>
        <article>

            <!-- HERO SECTION -->
            <section class="section hero" id="home">
                <div class="container">

                    <!-- Hero Content -->
                    <div class="hero-content">
                        <h2 class="h1 hero-title">Nyari Sewa Kendaraan di Bandung ?</h2>

                        <h3 class="h2 hero-text">Instarent solusinya!</h3>

                        <p class="hero-text">
                            <i data-lucide="map-pin"></i> PBB RUKO R11 BDG, Buah Batu, Bandung, Jawa Barat
                        </p>
                        <script src="https://unpkg.com/lucide@latest"></script>
                        <script>
                        lucide.createIcons();
                        </script>

                    </div>

                    <!-- Hero Banner -->
                    <div class="hero-banner"></div>

                    <!-- Login/Register Options -->
                    <p></p>
                    <a href="/login" class="btn-login">Sign In</a>
                    <a href="/register" class="btn-create">Sign Up</a>

                </div>
            </section>
            <section class="section get-start">
                <div class="container">

                    <h2 class="h2 section-title">Mulai dengan 4 Langkah Sederhana</h2>

                    <ul class="get-start-list">

                        <li>
                            <div class="get-start-card">

                                <div class="card-icon icon-1">
                                    <ion-icon name="person-add-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">1.Buat Profil Anda</h3>

                                <p class="card-text">
                                    Buat akun pribadi anda untuk mulai menggunakan layanan kami dengan mudah dan cepat.
                                </p>

                                <a href="/register" class="card-link">Mulai Sekarang</a>

                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">

                                <div class="card-icon icon-2">
                                    <ion-icon name="car-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">2.Pilih Mobil yang Anda Inginkan</h3>

                                <p class="card-text">
                                    Pilih dari berbagai pilihan mobil yang tersedia sesuai dengan kebutuhan Anda.
                                </p>

                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">

                                <div class="card-icon icon-3">
                                    <ion-icon name="person-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">3.Cocokkan dengan Penjual</h3>

                                <p class="card-text">
                                    Kami akan membantu Anda terhubung dengan penjual yang sesuai.
                                </p>

                            </div>
                        </li>

                        <li>
                            <div class="get-start-card">

                                <div class="card-icon icon-4">
                                    <ion-icon name="card-outline"></ion-icon>
                                </div>

                                <h3 class="card-title">4.Lakukan Transaksi Online</h3>

                                <p class="card-text">
                                    Selesaikan transaksi dengan aman dan nikmati perjalanan Anda dengan mobil pilihan.
                                </p>

                            </div>
                        </li>

                    </ul>

                </div>
            </section>

        </article>
    </main>

    <!-- JS Files -->
    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

</html>