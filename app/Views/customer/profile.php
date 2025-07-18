<?= $this->extend('template/layout') ?>
<?= $this->section('content') ?>

<!-- Bootstrap CSS & Custom -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
<link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>">
<style>
.modal-content {
    animation: fadeSlideIn 0.4s ease-in-out;
}

@keyframes fadeSlideIn {
    0% {
        opacity: 0;
        transform: scale(0.95);
    }

    100% {
        opacity: 1;
        transform: scale(1);
    }
}
</style>

<body>



    <!-- MAIN CONTENT -->
    <main class="container my-5">
        <article>

            <!-- Tombol Kembali -->
            <a href="<?= base_url('/customer/dashboard') ?>" class="btn btn-secondary mb-3">
                <i class="fas fa-arrow-left"></i> Kembali
            </a>

            <!-- Form Edit Profil -->
            <form action="/customer/updateProfile" method="post">
                <?= csrf_field() ?>

                <div class="card mt-2">
                    <div class="card-header bg-primary text-white">
                        <h4>Edit Profil Pelanggan</h4>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nama_pelanggan" class="form-label">Nama</label>
                            <input type="text" name="nama_pelanggan" class="form-control"
                                value="<?= esc($user['nama_pelanggan']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="email_pelanggan" class="form-label">Email</label>
                            <input type="email" name="email_pelanggan" class="form-control"
                                value="<?= esc($user['email_pelanggan']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="no_telp_pelanggan" class="form-label">No. Telepon</label>
                            <input type="text" name="no_telp_pelanggan" class="form-control"
                                value="<?= esc($user['no_telp_pelanggan']) ?>">
                        </div>
                        <div class="mb-3">
                            <label for="alamat_pelanggan" class="form-label">Alamat</label>
                            <textarea name="alamat_pelanggan"
                                class="form-control"><?= esc($user['alamat_pelanggan']) ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jenis Kelamin</label><br>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin_pelanggan" id="laki"
                                    value="Laki-laki"
                                    <?= $user['jenis_kelamin_pelanggan'] == 'Laki-laki' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="laki">Laki-laki</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="jenis_kelamin_pelanggan"
                                    id="perempuan" value="Perempuan"
                                    <?= $user['jenis_kelamin_pelanggan'] == 'Perempuan' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="perempuan">Perempuan</label>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer text-end">
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-save"></i> Simpan Perubahan
                        </button>
                        <a href="<?= base_url('logout') ?>" class="btn btn-danger">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </div>
                </div>
            </form>

        </article>
    </main>

    <!-- Modal Success -->
    <?php if (session()->getFlashdata('success')) : ?>
    <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content shadow rounded-4 border-0">

                <div class="modal-body text-center py-5">
                    <div class="mb-3">
                        <i class="fas fa-check-circle fa-4x text-success"></i>
                    </div>
                    <h5 class="fw-bold mb-3 text-success">Berhasil!</h5>
                    <p class="text-muted"><?= session()->getFlashdata('success') ?></p>
                </div>
            </div>
        </div>
    </div>
    <?php endif; ?>


    <!-- Bootstrap JS & Modal Script -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const modalElement = document.getElementById('successModal');
        if (modalElement) {
            const modal = new bootstrap.Modal(modalElement);
            modal.show();
            setTimeout(() => {
                modal.hide();
            }, 3000);
        }
    });
    </script>

    <script src="<?= base_url('assets/js/script.js') ?>"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

</body>

<?= $this->endSection() ?>