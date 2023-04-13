<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>
        <div class="section-body">
            <div class="row">

                <div class="col-sm-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <img class="rounded mb-4" height="270" src="<?= base_url('assets/img/buku/') . $image; ?>" alt="">
                            <h4 class="card-title text-dark"><?= $judul_buku ?></h4>
                            <p class="card-text"><?= $deskripsi ?></p>

                            <a class="btn btn-primary mt-2" href="<?= base_url('member/booking/tambahBooking/' . $id); ?>">
                                <i class="fas fw fa-shopping-cart mr-2"></i>Booking
                            </a>

                            <button onclick="window.history.go(-1); return true;" class="btn btn-danger mt-2">
                                <i class="fas fa-undo mr-1"></i>Back
                            </button>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr align="center">
                                    <tr>
                                        <td>Kategori</td>
                                        <td><?php echo $nama_kategori; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Pengarang</td>
                                        <td><?php echo $pengarang; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Penerbit</td>
                                        <td><?php echo $penerbit; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Tahun Terbit</td>
                                        <td><?php echo $tahun_terbit; ?></td>
                                    </tr>
                                    <tr>
                                        <td>ISBN</td>
                                        <td><?php echo $isbn; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Stok</td>
                                        <td><?php echo $stok; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dibooking</td>
                                        <td><?php echo $dibooking; ?></td>
                                    </tr>
                                    <tr>
                                        <td>Dipinjam</td>
                                        <td><?php echo $dipinjam; ?></td>
                                    </tr>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>