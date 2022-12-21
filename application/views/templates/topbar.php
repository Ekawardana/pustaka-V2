<!-- Topbar -->
<nav class="navbar navbar-expand-lg main-navbar">
    <form class="form-inline mr-auto">
        <ul class="navbar-nav mr-3">
            <li>
                <a href="#" data-toggle="sidebar" class="nav-link nav-link-lg">
                    <i class="fas fa-bars"></i></a>
            </li>
        </ul>
    </form>
    <ul class="navbar-nav navbar-right">
        <li class="dropdown">
            <a href="#" data-toggle="dropdown" class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                <img alt="image" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" width="30" class="rounded-circle mr-1" />
                <div class="d-sm-none d-lg-inline-block">Hai, <?= ucwords($user['name']); ?></div>
            </a>
            <div class="dropdown-menu dropdown-menu-right">
                <a href="<?= base_url('Profile') ?>" class="dropdown-item has-icon">
                    <i class="far fa-user"></i> My Profile
                </a>
                <div class="dropdown-divider"></div>
                <a href="<?= base_url('auth/logout'); ?>" class="dropdown-item has-icon text-danger">
                    <i class="fas fa-sign-out-alt"></i> Logout
                </a>
            </div>
        </li>
    </ul>
</nav>
<!-- End Topbar -->