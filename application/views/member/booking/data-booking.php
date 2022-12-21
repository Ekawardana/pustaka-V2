<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Booking</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col">

                    <div class="card">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-header">
                            <h4>Keranjang Booking</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Buku</th>
                                            <th>Penulis</th>
                                            <th>penerbit</th>
                                            <th>Tahun</th>
                                            <th>Pilihan</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($temp as $t) : ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td>
                                                    <img src="<?= base_url('assets/img/buku/' . $t['image']); ?>" class="avatar" alt="No Picture" height="75">
                                                </td>
                                                <td nowrap><?= $t['penulis']; ?></td>
                                                <td nowrap><?= $t['penerbit']; ?></td>
                                                <td nowrap><?= substr($t['tahun_terbit'], 0, 4); ?></td>
                                                <td nowrap>
                                                    <a href="<?= base_url('member/home/detailbuku/' . $t['id_buku']); ?>"><i class="btn btn-outline-info fas fw fa-search"></i></a>

                                                    <a href="<?= base_url('member/booking/hapusbooking/' . $t['id_buku']); ?>" onclick="return confirm('Yakin tidak Jadi Booking '.$t['judul_buku'])">
                                                        <i class="btn btn-outline-danger fas fw fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                    <tr>
                                        <td colspan="3">
                                            <a class="btn btn-outline-primary" href="<?= base_url('member/home'); ?>"><span class="fas fw fa-shopping-cart"></span> Lanjutkan Booking</a>

                                            <a class="btn btn-outline-success" href="<?= base_url() . 'member/booking/bookingSelesai/' . $this->session->userdata('id_user'); ?>"><span class="fas fw fa-vote-yea"></span> Selesaikan Booking</a>
                                        </td>
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
<!-- End Main Content -->