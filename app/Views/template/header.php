<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>𝙄𝙉𝙎𝙏𝘼𝙍𝙀𝙉𝙏 (𝙈𝙤𝙗𝙞𝙡 & 𝙈𝙤𝙩𝙤𝙧)</title>
    <!-- 
    - favicon
  -->
    <link rel="shortcut icon" href="<?= base_url('assets/images/brand/instarentlogopng.png') ?>" type="image/svg+xml">

    <!-- 
    - custom css link
  -->
    <link rel="stylesheet" href="<?= base_url('assets/css/stylee.css') ?>">
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
</head>

<style>
.navbar-header h3 {
    font-family: 'Lobster', cursive;
    font-size: 35px;
    color: black;
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
                <div class="header-contact" style="position: relative;">
                    <a href="#" class="contact-link" id="dropdownToggle"><?= esc(session()->get('username')) ?></a>
                    <span class="contact-time"><?= esc(session()->get('email')) ?></span>

                    <!-- Dropdown content -->
                    <div id="dropdownMenu" class="dropdown-menu"
                        style="display: none; position: absolute; top: 100%; right: 0; background: white; box-shadow: 0 2px 5px rgba(0,0,0,0.2); padding: 10px; border-radius: 5px; z-index: 999;">
                        <a href="/profile" class="dropdown-item">Profil</a>
                        <a href="/logout" class="dropdown-item">Logout</a>
                    </div>
                </div>
            </div>

            <style>
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
            <script>
            document.getElementById('dropdownToggle').addEventListener('click', function(e) {
                e.preventDefault();
                const dropdown = document.getElementById('dropdownMenu');
                dropdown.style.display = dropdown.style.display === 'block' ? 'none' : 'block';
            });

            // Klik di luar dropdown untuk menutup
            document.addEventListener('click', function(e) {
                const toggle = document.getElementById('dropdownToggle');
                const menu = document.getElementById('dropdownMenu');
                if (!toggle.contains(e.target) && !menu.contains(e.target)) {
                    menu.style.display = 'none';
                }
            });
            </script>


        </div>
    </header>