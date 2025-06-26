<?= $this->extend('template/layout') ?>

<!-- Content section -->
<?= $this->section('content') ?>

<style>
/* General container styling */
#home {
    background-color: #f8f9fa;
    /* Light gray background */
    padding: 2rem 1rem;
    border-radius: 10px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    margin-top: 8rem;
}

/* Form header styling */
.form-header {
    color: #2c3e50;
    /* Dark blue-gray color */
    font-size: 1.5rem;
    font-weight: 700;
    border-bottom: 3px solid #3498db;
    padding-bottom: 0.5rem;
    margin-bottom: 2rem;
    text-align: center;
}

/* Form container */
form {
    background-color: #ffffff;
    padding: 2.5rem;
    border-radius: 12px;
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
}

/* Label styling */
.form-label {
    font-size: 1rem;
    color: #34495e;
    margin-bottom: 0.5rem;
    display: block;
}

/* Input and select fields */
.form-control,
.form-select,
.form-control-plaintext {
    border-radius: 8px;
    border: 1px solid #ced4da;
    padding: 0.75rem;
    font-size: 1rem;
    transition: border-color 0.3s, box-shadow 0.3s;
}

.form-control:focus,
.form-select:focus {
    border-color: #3498db;
    box-shadow: 0 0 8px rgba(52, 152, 219, 0.2);
    outline: none;
}

/* Textarea */
textarea.form-control {
    resize: vertical;
}

/* Radio button styling */
.form-check-inline .form-check-input {
    margin-right: 0.5rem;
}

/* Invalid feedback */
.invalid-feedback {
    font-size: 0.875rem;
    color: #e74c3c;
}

/* Button styling */
.btn {
    border-radius: 8px;
    padding: 0.75rem 1.5rem;
    font-size: 1rem;
    font-weight: 600;
    text-transform: uppercase;
    transition: background-color 0.3s, box-shadow 0.3s;
}

.btn-primary {
    background-color: #3498db;
    border: none;
    color: #ffffff;
}

.btn-primary:hover {
    background-color: #2980b9;
    box-shadow: 0 4px 8px rgba(41, 128, 185, 0.3);
}

.btn-warning {
    background-color: #f39c12;
    border: none;
    color: #ffffff;
}

.btn-warning:hover {
    background-color: #e67e22;
    box-shadow: 0 4px 8px rgba(230, 126, 34, 0.3);
}

/* Button container */
.d-flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
}

/* Responsive design */
@media (max-width: 768px) {
    form {
        padding: 1.5rem;
    }

    .form-header {
        font-size: 1.25rem;
    }

    .form-control,
    .form-select,
    .btn {
        font-size: 0.875rem;
    }

    .btn {
        padding: 0.5rem 1rem;
    }
}

/* Enhancing accessibility */
.form-control:focus-visible {
    outline: 2px solid #3498db;
}
</style>
<!-- Material Icons CDN -->
<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

<!-- Home Content -->
<div id="home">
    <div class="container mt-5">
        <!-- Vehicle Details -->
        <div class=" row">
            <div class="col-md-8 offset-md-2">
                <!-- Booking Form -->
                <h4 class="form-header mt-4 text-center">Form Pemesanan Kendaraan</h4>
                <form action="" method="POST" class="needs-validation row g-3">
                    <div class="col-md-12 mb-3">
                        <label class="form-label">ID Pelanggan</label>
                        <input type="text" class="form-control" name="id_pelanggan"
                            value="<?= esc($id_pelanggan ?? '') ?>" readonly>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Kode Pelanggan</label>
                        <input type="text" class="form-control" name="kode_pelanggan"
                            value="<?= esc($kode_pelanggan ?? '') ?>" readonly>
                    </div>

                    <!-- Nama Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nama Pelanggan</label>
                        <input class="form-control" type="text" id="name" name="name"
                            value="<?= esc(session()->get('username')) ?>" disabled>
                        <?php if (isset($validation)): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('ussername') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Email Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Email Pelanggan</label>
                        <input class="form-control" type="email" id="email" name="email"
                            value="<?= esc(session()->get('email')) ?>" disabled>
                        <?php if (isset($validation)): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('email') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Nomor Telepon Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Nomor Telepon Pelanggan</label>
                        <input type="number" class="form-control" name="no_telp_pelanggan" autocomplete="on"
                            maxlength="13">
                        <?php if (isset($validation)): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('no_telp_pelanggan') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Alamat Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Alamat Pelanggan</label>
                        <textarea type="text" class="form-control" name="alamat_pelanggan" rows="3"
                            autocomplete="off"></textarea>
                        <?php if (isset($validation)): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('alamat_pelanggan') ?></div>
                        <?php endif; ?>
                    </div>

                    <!-- Jenis Kelamin Pelanggan -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Jenis Kelamin Pelanggan</label>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="jenis_kelamin_pelanggan" id="laki-laki"
                                value="Laki-Laki" autocomplete="off">
                            <label for="laki-laki" class="form-check-label">Laki-Laki</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input type="radio" class="form-check-input" name="jenis_kelamin_pelanggan" id="perempuan"
                                value="Perempuan" autocomplete="off">
                            <label for="perempuan" class="form-check-label">Perempuan</label>
                        </div>
                        <?php if (isset($validation)): ?>
                        <div class="invalid-feedback"> <?= $validation->getError('jenis_kelamin_pelanggan') ?></div>
                        <?php endif; ?>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tempat</label>
                        <select class="form-select" name="place">
                            <option value="bandara">Bandara</option>
                            <option value="kosan">Kost</option>
                            <option value="toko">Datang Ketoko</option>
                        </select>
                    </div>
                    <!-- Tanggal Sewa -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tanggal Sewa</label>
                        <input type="date" class="form-control" name="rental-date">
                    </div>
                    <!-- Tanggal Sewa -->
                    <div class="col-md-12 mb-3">
                        <label class="form-label">Tanggal Sewa</label>
                        <input type="date" class="form-control" name="rental-date">
                    </div>


                    <div class="col-md-12 mb-3">
                        <label class="form-label">Keterangan Tambahan</label>
                        <textarea class="form-control" name="additional"
                            placeholder="Masukkan Permintaan Khusus Anda"></textarea>
                    </div>

                    <!-- Buttons -->
                    <div class="d-flex justify-content-between mt-4">
                        <a href="<?= base_url('pelanggan') ?>" class="btn btn-warning">Batal</a>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- End content section -->
<?= $this->endSection() ?>