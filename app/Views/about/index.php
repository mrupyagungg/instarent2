<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<!-- Link Bootstrap & CSS Tambahan -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/detail.css') ?>">
<link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">

<div class="container">
    <style>
    .breadcrumb-item+.breadcrumb-item::before {
        content: none;
    }
    </style>

    <div class="container mt-4">
        <!-- <h2>About</h2> -->
        <section class="section testimonial">
            <div class="container">
                <h2 class="h2 section-title">Tentang Kami</h2>
                <p class="about-text">Kami adalah perusahaan rental mobil yang berdedikasi untuk memberikan pengalaman
                    terbaik bagi pelanggan kami. Dengan berbagai pilihan kendaraan yang terawat dengan baik dan proses
                    penyewaan yang mudah, kami memastikan perjalanan Anda nyaman dan bebas khawatir.</p>

                <div class="about-features">
                    <div class="feature">
                        <i class="fas fa-car"></i>
                        <h3>Kendaraan Berkualitas</h3>
                        <p>Semua mobil kami selalu dalam kondisi prima dengan perawatan rutin.</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-user-check"></i>
                        <h3>Pelayanan Terbaik</h3>
                        <p>Tim kami selalu siap membantu dan memberikan solusi terbaik untuk kebutuhan Anda.</p>
                    </div>
                    <div class="feature">
                        <i class="fas fa-wallet"></i>
                        <h3>Harga Terjangkau</h3>
                        <p>Kami menawarkan harga yang kompetitif tanpa mengurangi kualitas layanan.</p>
                    </div>
                </div>
            </div>
        </section>

    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    setTimeout(() => {
        document.getElementById('success-alert')?.remove();
        document.getElementById('error-alert')?.remove();
    }, 4000);
});
</script>

<?= $this->endSection() ?>