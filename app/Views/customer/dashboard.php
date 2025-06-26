<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title; ?></title>
    <link rel="icon" type="image/x-icon" href="<?= base_url('assets/icons/favicon.ico'); ?>">
    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/brand/instarentlogopng.png') ?>" type="image/svg+xml">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="<?= base_url('assets/css/stylee.css') ?>">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"
        integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous">
    </script>
    <script src="<?= base_url('assets/js/script.js') ?>"></script>

    <!-- 
    - google font link
  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600&family=Open+Sans&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Lobster&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

</head>

<style>
a {
    text-decoration: none;
}

.navbar-header h3 {
    font-family: 'Lobster', cursive;
    font-size: 35px;
    color: black;
    outline: none;
}

.hero-forms {
    /* max-width: 500px; */
    background: rgba(255, 255, 255, 0.47);
    padding: 10px;
    border-radius: 10px;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
    margin: 50px auto;
}

.input-wrapper {
    margin-bottom: 10px;
}

.input-label {
    font-weight: bold;
    margin-bottom: 5px;
    display: block;
}

.input-field {
    width: 100%;
    padding: 10px;
    border: 1px solid #ced4da;
    border-radius: 5px;
    transition: all 0.3s ease;
}

.input-field:focus {
    border-color: #007bff;
    box-shadow: 0 0 5px rgba(0, 123, 255, 0.3);
    outline: none;
}

.info-box {
    background-color: #d4f4fc;
    /* Warna biru muda */
    padding: 15px 15px;
    /* Ruang di dalam box */
    border-radius: 5px;
    /* Agar sudutnya sedikit melengkung */
    border-left: 4px solid #007bff;
    /* Garis kiri berwarna biru */

}

.btn {
    display: inline-block;
    padding: 10px 24px;
    background-color: #007bff;
    /* Biru bootstrap */
    color: white;
    font-weight: 600;
    text-decoration: none;
    border-radius: 6px;
    box-shadow: 0 4px 6px rgba(0, 123, 255, 0.3);
    transition: background-color 0.3s ease, box-shadow 0.3s ease;
    cursor: pointer;
    user-select: none;
}

.btn:hover,
.btn:focus {
    color: #fff;
    background-color: #0056b3;
    box-shadow: 0 6px 10px rgba(0, 86, 179, 0.4);
    text-decoration: none;
    outline: none;
}

.btn:active {
    background-color: #004494;
    box-shadow: 0 3px 6px rgba(0, 68, 148, 0.5);
    transform: translateY(1px);
}

.dropdown-item {
    display: block;
    padding: 8px 12px;
    color: #333;
    text-decoration: none;
}

.dropdown-item:hover {
    background-color: #f0f0f0;
}
</style>

<body?>

    <!-- 
    - #HEADER
  -->

    <header class="header" data-header>
        <div class="container">

            <div class="overlay" data-overlay></div>

            <div class="navbar-header">
                <h3>instarent</h3>
            </div>

            <nav class="navbar" data-navbar>
                <ul class="navbar-list">

                    <li>
                        <a href="/customer/dashboard" class="navbar-link" data-nav-link>Home</a>
                    </li>

                    <li>
                        <a href="/garasi" class="navbar-link" data-nav-link>Garasi</a>
                    </li>

                    <li>
                        <a href="/about" class="navbar-link" data-nav-link>About us</a>
                    </li>

                    <li>
                        <a href="/contact" class="navbar-link" data-nav-link>Contact us</a>
                    </li>
                    <li>
                        <a href="/riwayat" class="navbar-link" data-nav-link>Riwayat</a>
                    </li>

                </ul>

            </nav>

            <div class="header-actions">
                <div class="header-actions">
                    <div class="header-contact dropdown">
                        <a href="#" class="contact-link dropdown-toggle" id="userDropdown" data-toggle="dropdown"
                            aria-haspopup="true" aria-expanded="false">
                            <?= esc(session()->get('username')) ?>
                        </a>
                        <span class="contact-time d-block"><?= esc(session()->get('email')) ?></span>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="/profile">Profil</a>
                            <a class="dropdown-item" href="/logout">Logout</a>
                        </div>
                    </div>
                </div>

                <!-- Bootstrap 4 CDN -->
                <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

                <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>



                <button class="nav-toggle-btn" data-nav-toggle-btn aria-label="Toggle Menu">
                    <span class="one"></span>
                    <span class="two"></span>
                    <span class="three"></span>
                </button>

            </div>

        </div>
    </header>

    <main>
        <article>

            <!-- 
        - #HERO
      -->

            <section class="section hero" id="home">
                <div class="container">
                    <!-- Tampilkan pesan welcome jika username ada di session -->

                    <div class="hero-content">
                        <h2 class="h1 hero-title">
                            <?= session()->get('username') ? 'Selamat Datang  ' . esc(session()->get('username')) : 'Welcome, Guest'; ?>
                        </h2>

                        <h3 class="h2 hero-text">Instarent solusi terbaik </h3>

                        <p class="hero-text">
                            <i data-lucide="map-pin"></i> PBB Ruko R.11 Buah Batu, Bandung, Jawa Barat
                        </p>

                        <script src="https://unpkg.com/lucide@latest"></script>
                        <script>
                        lucide.createIcons();
                        </script>


                    </div>

                    <div class="hero-banner"></div>
                    <!-- <button type="submit" class="btn"></button> -->
                    <a class="view-more-btn" href="#featured-car">SELENGKAPNYA</a>
                </div>

            </section>

            <!-- 
        - #FEATURED CAR
      -->

            <section class="section featured-car" id="featured-car">
                <div class="container">
                    <div class="container text-center">
                        <div class="row">
                            <div class="col-6">
                                <div class="info-box">
                                    <h2 class="h2 section-title">Keterangan</h2>
                                    <p>
                                        Sistem pemakaian pertanggal mulai pk. 00.00 sampai 24.00
                                        (Mulai dipakai kapan saja berakhir pk. 00.00 itu sudah hitungan sehari).
                                    </p>
                                </div>
                            </div>
                            <div class="col-6">
                                <h2 class="h2 section-title">Syarat</h2>
                                <div class="accordion accordion-flush" id="accordionFlushExample">

                                    <!-- Mahasiswa -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="false" aria-controls="flush-collapseOne">
                                                Mahasiswa
                                            </button>
                                        </h2>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <ul style="list-style: disc; margin-left: 20px; text-align: left;">
                                                    <li>Kartu Tanda Mahasiswa (KTM)</li>
                                                    <li>KTP</li>
                                                    <li>SIM A/B/C</li>
                                                    <li>Menitipkan KTM Fisik</li>
                                                </ul>
                                            </div>
                                        </div>

                                    </div>

                                    <!-- Umum -->
                                    <div class="accordion-item">
                                        <h2 class="accordion-header">
                                            <button class="accordion-button collapsed" type="button"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo"
                                                aria-expanded="false" aria-controls="flush-collapseTwo">
                                                Umum
                                            </button>
                                        </h2>
                                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="accordion-body">
                                                <ul>
                                                    <li>KTP/Kartu Tanda Pengenal</li>
                                                    <li></li>
                                                    <li>SIM A/B/C</li>
                                                    <li>Fotocopy Identitas</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="title-wrapper">
                        <h2 class="h2 section-title">Pilih Kendaraan</h2>

                        <a href="/garasi" class="featured-car-link">
                            <span>View more</span>
                            <ion-icon name="arrow-forward-outline"></ion-icon>
                        </a>
                    </div>

                    <ul class="featured-car-list">
                        <?php foreach (array_slice($kendaraans, 3, 6) as $kendaraan): ?>
                        <li>
                            <div class="featured-car-card">

                                <figure class="card-banner">
                                    <img src="<?= base_url('uploads/' . esc($kendaraan['gambar_kendaraan'])) ?>"
                                        alt="Car Image">
                                </figure>

                                <div class="card-content">

                                    <div class="card-title-wrapper">
                                        <h3 class="h3 card-title">
                                            <a href="#"><?= esc(ucwords($kendaraan['nama_kendaraan'])) ?></a>
                                        </h3>

                                        <data class="year" value="<?= esc($kendaraan['tahun_kendaraan']) ?>">
                                            <?= esc($kendaraan['tahun_kendaraan']) ?>
                                        </data>
                                    </div>

                                    <ul class="card-list">

                                        <li class="card-list-item">
                                            <ion-icon name="flash-outline"></ion-icon>
                                            <span class="card-item-text">
                                                Bensin
                                            </span>
                                        </li>
                                        <li class="card-list-item">
                                            <ion-icon name="car-sport-outline"></ion-icon>
                                            <span class="card-item-text">
                                                <?= esc(ucwords($kendaraan['merk_kendaraan'])) ?></span>
                                        </li>

                                    </ul>

                                    <div class="card-price-wrapper">
                                        <p class="card-price">
                                            <strong>
                                                <?= number_format($kendaraan['harga_sewa_kendaraan'], 2) ?>
                                            </strong> / day
                                        </p>
                                        <!-- <button class="btn fav-btn" aria-label="Add to favourite list">
                                            <ion-icon name="heart-outline"></ion-icon>
                                        </button> -->

                                        <a href="<?= base_url('detail/' . esc($kendaraan['id_kendaraan'])) ?>"
                                            class="btn">
                                            Rent now
                                        </a>
                                    </div>

                                </div>

                            </div>

                        </li>

                        <?php endforeach; ?>

                    </ul>

                </div>

                <div class="container">
                    <a href="<?= base_url('garasi') ?>" class=" view-more-btn">
                        View More <ion-icon name="arrow-forward-outline"></ion-icon>
                    </a>
                </div>
            </section>

            <section class="section get-start">
                <div class="container">
                    <h2 class="h2 section-title">Ulasan dari Pelanggan </h2>
                    <div class="row">
                        <!-- Ulasan 1 -->
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body text-center d-flex flex-column align-items-center">
                                    <h5 class="card-title mb-4">Budi Santoso</h5>
                                    <img src="<?= base_url('assets/images/gif/face1.gif') ?>" width="250" height="200"
                                        alt="ArrOw">
                                    <h5 class="card-title text-success mt-3">Traveller</h5>
                                    <p class="card-text text-center">"Layanan yang luar biasa! Prosesnya cepat dan
                                        mudah. Pasti akan menggunakan layanan ini lagi."</p>
                                    <small class="text-muted">★★★★★</small>
                                </div>

                            </div>
                        </div>
                        <!-- Ulasan 2 -->
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body text-center d-flex flex-column align-items-center">
                                    <h5 class="card-title mb-4">Fachri Afif</h5>
                                    <img src="<?= base_url('assets/images/gif/face2.gif') ?>" width="250" height="200"
                                        alt="Car Image" class="rounded-circle mx-auto d-block mb-2">
                                    <h5 class="card-title text-warning">Student</h5>
                                    <p class="card-text">"Sangat puas dengan pelayanan dan kualitasnya. Mobil bersih dan
                                        nyaman digunakan."</p>
                                    <small class="text-muted">★★★★★</small>
                                </div>
                            </div>
                        </div>
                        <!-- Ulasan 3 -->
                        <div class="col-md-4">
                            <div class="card text-center">
                                <div class="card-body text-center d-flex flex-column align-items-center">
                                    <h5 class=" card-title mb-4">Angel Putri</h5>
                                    <img src="<?= base_url('assets/images/gif/face3.gif') ?>" width="250" height="200"
                                        alt="Car Image" class="rounded-circle mx-auto d-block mb-2">
                                    <h5 class="card-title text-danger">Student</h5>
                                    <p class="card-text">"Harga terjangkau dan pelayanan kualitas terbaik. Sangat
                                        dekat dengan kampus Telkom University!"</p>
                                    <small class="text-muted">★★★★☆</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>


            <!-- footer -->
            <link rel="stylesheet" href="<?= base_url('assets/css/detail.css') ?>">

            <footer class="footer">

                <div class="container">

                    <!-- Footer Top Section -->
                    <div class="footer-top">
                        <div class="footer-column">
                            <h3 class="footer-title-insta">Instarent</h3>
                            <p class="footer-description">Sewa mobil terbaik untuk kebutuhan perjalanan Anda. Nyaman,
                                mudah, dan
                                terpercaya.</p>
                        </div>

                        <div class="footer-column">
                            <h4 class="footer-title">Quick Links</h4>
                            <ul class="footer-links">
                                <li><a href="/customer/dashboard" class="footer-link">Home</a></li>
                                <li><a href="/customer/detail" class="footer-link">Explore Cars</a></li>
                                <li><a href="/about" class="footer-link">About Us</a></li>
                            </ul>
                        </div>

                        <div class="footer-column">
                            <h4 class="footer-title">Contact Us</h4>
                            <p><i class="material-icons">phone</i> 8 800 234 56 78</p>
                            <p><i class="material-icons">email</i> support@instarent.com</p>
                            <p><i class="material-icons">location_on</i> Bandung, Indonesia</p>
                        </div>

                        <!-- Payment Methods -->
                        <div class="footer-colum">
                            <h4 class="footer-title">Payment</h4>
                            <div class="payment-icons">
                                <div>
                                    <div class="payment-icons">
                                        <img src="<?= base_url('assets/images/Logo Bank Pembayaran.png') ?>" alt="BCA">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>

            <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

            <!-- js -->
            <script src="./assets/js/script.js"></script>

            <!-- link icon -->
            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
            <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

            </body>

</html>