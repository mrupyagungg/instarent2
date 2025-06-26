<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="ThemeMakker">
    <link rel="icon" href="favicon.ico" type="image/x-icon">
    <title> INSTARENT | Sign In</title>
    <link rel="stylesheet" href="<?= base_url('assets/vendor/themify-icons/themify-icons.css') ?>">
    <link rel="stylesheet" href="<?= base_url('assets/vendor/fontawesome/css/font-awesome.min.css') ?>">

    <link rel="stylesheet" href="<?= base_url('assets/css/main.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.css') ?>" type="text/css">
    <link rel="stylesheet" href="<?= base_url('assets/css/bootstrap.min.css') ?>" type="text/css">
</head>

<body class="theme-indigo">
    <!-- Page Loader -->
    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="m-t-30"><img src="<?= base_url('assets/images/brand/icon_black.svg') ?>" width="48" height="48"
                    alt="ArrOw"></div>
            <p>Please wait...</p>
        </div>
    </div>
    <!-- WRAPPER -->
    <div id="wrapper">
        <div class="vertical-align-wrap">
            <div class="vertical-align-middle auth-main">
                <div class="auth-box">
                    <div class="top">
                        <!-- logo image -->
                        <img src="<?= base_url('assets/images/brand/instarentlogopng.png') ?>" alt="Lucid"
                            style="width: 150px; height: auto;">

                        <!-- <strong>INSTARENT</strong> <span></span> -->
                    </div>
                    <div class="card">
                        <div class="header">
                            <p class="lead justify-content-center">Sign In</p>
                        </div>
                        <div class="body pt-0 mt-0">
                            <?php if (session()->getFlashdata('msg')) : ?>
                            <div class="alert alert-danger"><?= session()->getFlashdata('msg') ?></div>
                            <?php endif; ?>
                            <form class="custom-form mt-4 pt-2" action="<?= base_url('login/auth') ?>" method="post">
                                <div class="form-group">
                                    <label for="signin-email" class="control-label">Ussername</label>
                                    <input type="test" name="username" class="form-control"
                                        value="<?= set_value('username') ?>" placeholder="Enter username">
                                </div>
                                <div class="form-group">
                                    <label for="signin-password" class="control-label ">Password</label>
                                    <input type="password" class="form-control" name="password"
                                        placeholder="Enter password" aria-label="Password"
                                        aria-describedby="password-addon">
                                </div>
                                <button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button><br>
                                <div class="footer">
                                    <p class="text-center">Don't have an account? <a
                                            href="<?= base_url('register') ?>">Sign Up</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END WRAPPER -->

    <!-- Core -->
    <script src="<?= base_url('assets/bundles/libscripts.bundle.js') ?>"></script>
    <script src="<?= base_url('assets/bundles/vendorscripts.bundle.js') ?>"></script>

    <script src="<?= base_url('assets/js/theme.js') ?>"></script>
</body>

</html>