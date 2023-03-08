<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?= base_url('assets') ?>/img/books.png" type="image/icon type">
    <title>E-Perpus | <?= $title ?></title>

    <!-- General CSS Files -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/fontawesome/css/all.min.css">

    <!-- CSS Libraries -->

    <!-- Template CSS -->
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/style.css">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/mystyle.css" />
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/components.css">
    <!-- Start GA -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-94034622-3"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-94034622-3');
    </script>
    <!-- /END GA -->
</head>

<body class="layout-3">
    <div id="app">
        <div class="main-wrapper container">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar container">
                <a href="<?= base_url('member/home') ?>" class="navbar-brand sidebar-gone-hide">E-Perpus</a>
                <a href="#" class="nav-link sidebar-gone-show" data-toggle="sidebar">
                    <i class="fas fa-bars"></i>
                </a>
                <div class="nav-collapse mr-auto">
                    <?php
                    if (!empty($this->session->userdata('email'))) { ?>

                    <?php } else { ?>
                        <a class="sidebar-gone-show nav-collapse-toggle nav-link" href="#">
                            <i class="fas fa-ellipsis-v"></i>
                        </a>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="modal-daftar">
                                    <i class="fas fa-user-plus mr-1"></i>Daftar
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link" id="modal-login">
                                    <i class="fas fa-sign-in-alt mr-1"></i>Login
                                </a>
                            </li>
                        </ul>
                    <?php } ?>
                </div>

                <!-- Search -->
                <form action="" method="post" class="form-inline ml-auto">
                    <ul class="navbar-nav">
                        <li>
                            <a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i class="fas fa-search"></i></a>
                        </li>
                    </ul>
                    <div class="search-element">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search" data-width="250" name="keyword" autocomplete="off">
                        <button class="btn" type="submit">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </form>
                <!-- End Search -->

                <ul class="navbar-nav navbar-right">
                    <li class="dropdown">
                        <?php
                        if (!empty($this->session->userdata('email'))) { ?>
                            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                                <img alt="image" src="<?= base_url('assets/img/profile/') . $user['image'] ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">Hi, <?= $user['name'] ?></div>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right">
                                <a href="<?= base_url('member/myProfile') ?>" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profile
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?= base_url('member/authm/logout') ?>" class="dropdown-item has-icon text-danger">
                                    <i class="fas fa-sign-out-alt"></i> Logout
                                </a>
                            </div>
                        <?php } else { ?>
                            <a href="" class="nav-link  nav-link-lg nav-link-user">
                                <img alt="image" src="<?= base_url('assets/img/profile/') . 'default.png' ?>" class="rounded-circle mr-1">
                                <div class="d-sm-none d-lg-inline-block">Hi, <?= $pengunjung ?></div>
                            </a>
                        <?php } ?>
                    </li>
                </ul>
            </nav>

            <nav class="navbar navbar-secondary navbar-expand-lg">
                <div class="container">
                    <ul class="navbar-nav">
                        <li class="nav-item <?= (strpos(current_url(), "home") !== false) ? "active" : ""; ?>">
                            <a href="<?= base_url('member/home') ?>" class="nav-link">
                                <span><i class="fas fa-book"></i>Daftar Buku</span>
                            </a>
                        </li>
                        <?php
                        if (!empty($this->session->userdata('email'))) { ?>
                            <li class="nav-item <?= (strpos(current_url(), "booking") !== false) ? "active" : ""; ?>">
                                <a class="nav-link" href="<?= base_url('member/booking'); ?>">
                                    <span><i class="fas fa-shopping-cart"></i>Booking
                                        <b>
                                            <?= $this->BookingModel->getDataWhere('temp', ['email_user' => $this->session->userdata('email')])->num_rows(); ?>
                                        </b>Buku
                                    </span>
                                </a>
                            </li>

                            <li class="nav-item <?= (strpos(current_url(), "myProfile") !== false) ? "active" : ""; ?>">
                                <a href="<?= base_url('member/myProfile') ?>" class="nav-link">
                                    <span><i class="fas fa-user"></i>My Profile</span>
                                </a>
                            </li>

                            <?php if ($items > 0) : ?>
                                <li class="nav-item">
                                    <a href="<?= base_url('member/booking/info') ?>" class="mt-3 btn btn-primary">
                                        <span><i class="fas fa-info-circle mr-1"></i>Info Booking</span>
                                    </a>
                                </li>
                            <?php endif ?>

                        <?php } ?>
                    </ul>
                </div>
            </nav>