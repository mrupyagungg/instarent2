"use strict";

// Jalankan setelah DOM selesai dimuat
document.addEventListener("DOMContentLoaded", () => {
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
  };

  if (navToggleBtn && overlay && navbar) {
    navToggleBtn.addEventListener("click", navToggleFunc);
    overlay.addEventListener("click", navToggleFunc);
    navbarLinks.forEach((link) => {
      link.addEventListener("click", navToggleFunc);
    });
  }

  /**
   * header active on scroll
   */
  const header = document.querySelector("[data-header]");
  if (header) {
    window.addEventListener("scroll", function () {
      window.scrollY >= 10
        ? header.classList.add("active")
        : header.classList.remove("active");
    });
  }
});
