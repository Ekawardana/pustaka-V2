<div class="main-sidebar">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="<?= base_url('dashboard') ?>"><i class="fas fa-book mr-2" style="font-size:1rem;"></i>E-Perpus</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="<?= base_url('dashboard') ?>">EPUS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Role: <?= strtoupper($user['role']); ?></li>
            <li class="<?= (strpos(current_url(), "dashboard") !== false) ? "active" : ""; ?>">
                <a class="nav-link" href="<?= base_url('dashboard') ?>"><i class="fas fa-home"></i> <span>Dashboard</span></a>
            </li>

            <!-- Data Master -->
            <li class="dropdown <?= (strpos(current_url(), "master") !== false) ? "active" : ""; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-book"></i> <span>Kelola Data</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= (strpos(current_url(), "Anggota") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('master/Anggota') ?>"><span>Anggota</span></a>
                    </li>
                    <li class="<?= (strpos(current_url(), "Kategori") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('master/Kategori') ?>"><span>Kategori</span></a>
                    </li>
                    <li class="<?= (strpos(current_url(), "Buku") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('master/Buku') ?>"><span>Buku</span></a>
                    </li>
                </ul>
            </li>
            <!-- End Data Master -->

            <!-- Transaksi -->
            <li class="dropdown <?= (strpos(current_url(), "transaksi") !== false) ? "active" : ""; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-shopping-bag"></i> <span>Transaksi</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= (strpos(current_url(), "Booking") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('transaksi/Booking') ?>"><span>Data Booking</span></a>
                    </li>
                    <li class="<?= (strpos(current_url(), "Pinjam") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('transaksi/Pinjam') ?>"><span>Data Pinjam</span></a>
                    </li>
                </ul>
            </li>
            <!-- end Transaksi -->

            <!-- Laporan -->
            <li class="dropdown <?= (strpos(current_url(), "laporan") !== false) ? "active" : ""; ?>">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-swatchbook"></i><span>Laporan</span></a>
                <ul class="dropdown-menu">
                    <li class="<?= (strpos(current_url(), "LaporanBuku") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('laporan/LaporanBuku') ?>"><span>Laporan Buku</span></a>
                    </li>
                    <li class="<?= (strpos(current_url(), "LaporanAnggota") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('laporan/LaporanAnggota') ?>"><span>Laporan Anggota</span></a>
                    </li>
                    <li class="<?= (strpos(current_url(), "LaporanPinjam") !== false) ? "active" : ""; ?>">
                        <a class="nav-link" href="<?= base_url('laporan/LaporanPinjam') ?>"><span>Laporan Peminjaman</span></a>
                    </li>
                </ul>
            </li>
            <!-- End Laporan -->
            < </ul>
    </aside>
</div>