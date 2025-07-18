<!-- Optional: Include Bootstrap if not already included -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

<div class="container d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card shadow-lg p-5 text-center border-0 rounded-4" style="max-width: 600px;">
        <div class="mb-4">
            <i class="fas fa-ban fa-5x text-danger"></i>
        </div>
        <h1 class="display-5 fw-bold text-danger">403</h1>
        <h4 class="mb-3">Akses Ditolak</h4>
        <p class="text-muted mb-4">Anda tidak memiliki izin untuk mengakses halaman ini. Silakan kembali ke halaman
            utama atau hubungi administrator jika menurut Anda ini adalah kesalahan.</p>
        <a href="<?= base_url('/customer/dashboard') ?>" class="btn btn-primary px-4">
            <i class="fas fa-home me-2"></i> Kembali ke Beranda
        </a>
    </div>
</div>