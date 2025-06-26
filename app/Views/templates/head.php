<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Webpixels">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <!-- Tambahkan ini di dalam head -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <title>𝙄𝙉𝙎𝙏𝘼𝙍𝙀𝙉𝙏 (𝙈𝙤𝙗𝙞𝙡 & 𝙈𝙤𝙩𝙤𝙧) </title>

    <link rel="stylesheet" href="<?= base_url('assets/vendor/themify-icons/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/font-awesome.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/vendor/jquery-datatable/dataTables.bootstrap4.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/charts-c3/plugin.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/vendor/jvectormap/jquery-jvectormap-2.0.3.css') ?>" />
    <link rel="stylesheet" href="<?= base_url('assets/libs/flatpickr/flatpickr.min.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/notifications/css/lobibox.min.css') ?>" />
    <script src="https://cdn.jsdelivr.net/npm/autonumeric@4.5.4"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="<?= base_url('assets/images/prv/cars.gif') ?>" width="300" height="300"
                    alt="ArrOw"></div>
            <p><b>...</b></p>
        </div>
    </div>
    <?= $this->include('templates/navbar'); ?>



    <div class="main_content" id="main-content">
        <?= $this->include('templates/menu'); ?>


        <div class="page">

            <?= $this->renderSection('content-admin'); ?>

        </div>
    </div>

    <!-- Core -->
    <?= $this->include('templates/script'); ?>
    <?= $this->renderSection('content-script'); ?>


</body>

</html>