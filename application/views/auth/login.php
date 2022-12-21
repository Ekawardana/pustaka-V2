<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <link rel="icon" href="<?= base_url('assets') ?>/img/books.png" type="image/icon type">
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/bootstrap.min.css" />
    <link rel="stylesheet" href="<?= base_url('assets') ?>/vendor/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/style.css" />
    <link rel="stylesheet" href="<?= base_url('assets') ?>/css/components.css" />
    <title>Login</title>
    <!-- /END GA -->
</head>

<body>
    <div id="app">
        <section class="section">
            <div class="container mt-5">
                <div class="row">
                    <div class="col-12 col-sm-8 offset-sm-2 col-md-6 offset-md-3 col-lg-6 offset-lg-3 col-xl-4 offset-xl-4">
                        <div class="login-brand">
                            <h1><i class="fas fa-book" style="font-size:2.5rem;"></i>E-Perpus</h1>
                        </div>

                        <!-- Message -->
                        <?= $this->session->flashdata('message') ?>

                        <div class="card card-primary">
                            <div class="card-header">
                                <h4>Login Admin</h4>
                            </div>

                            <div class="card-body">
                                <form method="POST" action="<?= base_url('auth'); ?>" class="needs-validation" novalidate="">
                                    <div class="form-group">
                                        <label for="email">Email</label>
                                        <input id="email" type="email" class="form-control" name="email" tabindex="1" required autofocus>
                                        <div class="invalid-feedback">
                                            Please fill in your email
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="d-block">
                                            <label for="password" class="control-label">Password</label>
                                            <div class="float-right">
                                            </div>
                                        </div>
                                        <input id="password" type="password" class="form-control" name="password" tabindex="2" required>
                                        <div class="invalid-feedback">
                                            please fill in your password
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
                                            Login
                                        </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                        <div class="mt-2 text-muted text-center">
                            Bukan Admin? <a href="<?= base_url('member/home') ?>">Login Member</a>
                        </div>
                        <div class="simple-footer">
                            Copyright &copy; <?= date('Y') ?> Eka Wardana
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <!-- General JS Scripts -->
    <script src="<?= base_url('assets') ?>/js/jquery-3.3.1.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/popper.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/bootstrap.min.js"></script>
    <script src="<?= base_url('assets') ?>/js/jquery.nicescroll.min.js"></script>

    <script src="<?= base_url('assets') ?>/js/stisla.js"></script>
    <script src="<?= base_url('assets') ?>/js/scripts.js"></script>
    <script src="<?= base_url('assets') ?>/js/custom.js"></script>
</body>

</html>