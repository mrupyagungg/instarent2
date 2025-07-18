<!-- Detail CSS -->
<link rel="stylesheet" href="<?= base_url('assets/css/detail.css') ?>">

<!-- GSAP Animation Library -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>

<!-- Bootstrap 4.5.2 (jika dipakai) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-LtrjvnR4Twt/qOuYxk3UV9zUjPAF0hQy8eoaG5q9cQ/i6dv3v5x0E0EEe5zj9s5V" crossorigin="anonymous">
</script>

<!-- Bootstrap 5.3.3 Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-...your-integrity..." crossorigin="anonymous"></script>

<!-- Ionicons -->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<!-- Footer -->
<footer class="footer">
    <div class="container">
        <div class="footer-top">
            <div class="footer-column">
                <h3 class="footer-title-insta">Instarent</h3>
                <p class="footer-description">Sewa mobil terbaik untuk kebutuhan perjalanan Anda. Nyaman, mudah, dan
                    terpercaya.</p>
            </div>

            <div class="footer-column">
                <h4 class="footer-title">Quick Links</h4>
                <ul class="footer-links">
                    <li><a href="/customer/dashboard" class="footer-link">Home</a></li>
                    <li><a href="/garasi" class="footer-link">Explore Cars</a></li>
                    <li><a href="/about" class="footer-link">About Us</a></li>
                </ul>
            </div>

            <div class="footer-column">
                <h4 class="footer-title">Contact Us</h4>
                <p><i class="material-icons">phone</i> 8 800 234 56 78</p>
                <p><i class="material-icons">email</i> support@instarent.com</p>
                <p><i class="material-icons">location_on</i> Bandung, Indonesia</p>
            </div>

            <div class="footer-column">
                <h4 class="footer-title">Payment</h4>
                <div class="payment-icons">
                    <img src="<?= base_url('assets/images/Logo Bank Pembayaran.png') ?>" alt="BCA"
                        style="max-width: 100px;">
                </div>
            </div>
        </div>
    </div>
</footer>

<!-- Toggle Hamburger Script -->
<script>
document.addEventListener("DOMContentLoaded", function() {
    const toggleBtn = document.querySelector('[data-nav-toggle-btn]');
    const navbar = document.querySelector('[data-navbar]');
    if (toggleBtn && navbar) {
        toggleBtn.addEventListener('click', function() {
            navbar.classList.toggle('active');
        });
    }
});
</script>