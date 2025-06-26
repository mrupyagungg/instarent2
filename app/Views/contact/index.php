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

        <section class="section contact">
            <div class="container">
                <h2 class="h2 section-title">Hubungi Kami</h2>
                <div class="contact-content">
                    <div class="contact-map">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3151.8354345093666!2d144.9537353153159!3d-37.81627977975198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6ad642af0f11fd81%3A0xf5778a462c5d3aa!2sMelbourne%20Central!5e0!3m2!1sen!2sau!4v1630213896794!5m2!1sen!2sau"
                            width="100%" height="400" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
                    </div>
                    <div class="contact-form">
                        <form action="#" method="POST">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="message">Pesan</label>
                                <textarea id="message" name="message" rows="4" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Kirim</button>
                        </form>
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