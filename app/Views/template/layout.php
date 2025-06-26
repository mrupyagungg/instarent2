<!-- app/Views/layout.php -->
<?= $this->include('template/header') ?>
<!-- Memuat header.php -->

<main>
    <?= $this->renderSection('content') ?>
    <!-- Bagian ini akan diisi oleh konten spesifik halaman -->
</main>


<?= $this->include('template/footer') ?>
<!-- 
    - custom js link
  -->
<script src="./assets/js/script.js"></script>

<!-- 
- ionicon link
-->
<script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>