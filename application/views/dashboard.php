<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Data Booking</h1>
        </div>
        <!-- Card Total -->
        <div class="row">

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-info">
                        <i class="far fa-user"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Member</h4>
                        </div>
                        <div class="card-body">
                            <?= $this->UserModel->cekUser(['role' => 'member'])->num_rows();
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-warning">
                        <i class="fas fa-book"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Buku</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $where = ['stok != 0'];
                            $totalstok = $this->BukuModel->total('stok', $where);
                            echo $totalstok;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-success">
                        <i class="fas fa-cart-arrow-down"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Booking</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $where = ['dibooking != 0'];
                            $totalstok = $this->BukuModel->total('dibooking', $where);
                            echo $totalstok;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
                <div class="card card-statistic-1">
                    <div class="card-icon bg-danger">
                        <i class="fas fa-shopping-basket"></i>
                    </div>
                    <div class="card-wrap">
                        <div class="card-header">
                            <h4>Total Dipinjam</h4>
                        </div>
                        <div class="card-body">
                            <?php
                            $where = ['dipinjam != 0'];
                            $totalstok = $this->BukuModel->total('dipinjam', $where);
                            echo $totalstok;
                            ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Card Total -->

        <!-- Card Admin -->
        <div class="row">

            <div class="col-lg-5 col-md-12 col-12 col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Admin Info</h4>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled list-unstyled-border">
                            <?php foreach ($admin as $a) : ?>
                                <li class="media">
                                    <img class="mr-3 rounded-circle" width="50" src="<?= base_url('assets/img/profile/') . $a['image']; ?>" alt="avatar">
                                    <div class="media-body">
                                        <?php if ($a['email'] == $this->session->userdata('email')) : ?>
                                            <div class="float-right text-primary">Online</div>
                                        <?php endif; ?>
                                        <div class="media-title"><?= $a['name'] ?></div>
                                        <span class="text-small text-muted"><?= date('d F Y', $a['date_created']); ?></span>
                                    </div>
                                </li>
                            <?php endforeach ?>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
        <!-- End Card Admin -->

</div>
</section>
</div>