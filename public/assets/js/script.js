'use strict';

/**
 * navbar toggle
 */

const overlay = document.querySelector("[data-overlay]");
const navbar = document.querySelector("[data-navbar]");
const navToggleBtn = document.querySelector("[data-nav-toggle-btn]");
const navbarLinks = document.querySelectorAll("[data-nav-link]");

const navToggleFunc = function () {
  navToggleBtn.classList.toggle("active");
  navbar.classList.toggle("active");
  overlay.classList.toggle("active");
}

navToggleBtn.addEventListener("click", navToggleFunc);
overlay.addEventListener("click", navToggleFunc);

navbarLinks.forEach(link => {
  link.addEventListener("click", navToggleFunc);
});

/**
 * header active on scroll
 */

const header = document.querySelector("[data-header]");

window.addEventListener("scroll", function () {
  if (window.scrollY >= 10) {
    header.classList.add("active");
  } else {
    header.classList.remove("active");
  }
});

/**
 * Button change after success alert
 */

document.addEventListener("DOMContentLoaded", () => {
  // Periksa apakah session flash data `success` ada
  const successAlert = document.getElementById('success-alert');
  if (successAlert) {
    const btnSimpan = document.getElementById('btnSimpan');
    if (btnSimpan) {
      // Ubah tombol "Simpan" menjadi tombol "Lanjut"
      btnSimpan.innerHTML = '<i class="fas fa-arrow-right"></i> Lanjut';
      btnSimpan.classList.remove('btn-success');
      btnSimpan.classList.add('btn-primary');
      btnSimpan.type = 'button';
      btnSimpan.onclick = function() {
        // Arahkan pengguna ke halaman pemesanan
        window.location.href = "<?= base_url('pemesanan/create/' . esc($kendaraan['id_kendaraan'])) ?>";
      };
    }
  }

  // Auto-hide alert
  setTimeout(() => {
    if (successAlert) {
      successAlert.style.display = 'none';
    }
  }, 4000);
});

/**
 * Client-side validation for pelanggan form
 */

const pelangganForm = document.getElementById('pelangganForm');
if (pelangganForm) {
  pelangganForm.addEventListener('submit', function(event) {
    const formValid = pelangganForm.checkValidity();
    if (!formValid) {
      event.preventDefault();
      alert('Mohon lengkapi semua data sebelum melanjutkan!');
    }
  });
}

/**
 * Feedback group cycle
 */

const feedbackGroups = document.querySelectorAll(".col .feedback-group");
if (feedbackGroups.length > 0) {
  let currentIndex = 0;

  // Fungsi untuk mengatur grup feedback aktif
  const showNextFeedback = () => {
    feedbackGroups[currentIndex].classList.remove("active");

    // Tentukan indeks grup berikutnya
    currentIndex = (currentIndex + 1) % feedbackGroups.length;

    // Tambahkan class "active" ke grup berikutnya
    feedbackGroups[currentIndex].classList.add("active");
  };

  // Set grup pertama sebagai aktif
  feedbackGroups[currentIndex].classList.add("active");

  // Ganti grup feedback setiap 4 detik
  setInterval(showNextFeedback, 4000);
}
