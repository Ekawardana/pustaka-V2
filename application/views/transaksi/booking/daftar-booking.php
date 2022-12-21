<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <div class="card-body">
                            <div class="table-responsive text-center">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>ID Booking</th>
                                            <th>Tanggal Booking</th>
                                            <th>ID Member</th>
                                            <th>Denda/Buku/Hari</th>
                                            <th>Lama Pinjam</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($booking as $bo) : ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td>
                                                    <a class="btn btn-outline-primary" href="<?= base_url('transaksi/booking/bookingDetail/' . $bo['id_booking']); ?>">
                                                        <?= $bo['id_booking']; ?>
                                                    </a>
                                                </td>
                                                <td><?= $bo['tgl_booking']; ?></td>
                                                <td><?= $bo['id_user']; ?></td>

                                                <form action="<?= base_url('transaksi/pinjam/pinjamAct/' . $bo['id_booking']); ?>" method="post">
                                                    <td>
                                                        <input class="form-check-user rounded-sm" style="width:100px" type="text" name="denda" id="denda" value="5000">
                                                        <?= form_error(); ?>
                                                    </td>
                                                    <td>
                                                        <input class="form-check-user rounded-sm" style="width:100px" type="text" name="lama" id="lama" value="3">
                                                        <?= form_error(); ?>
                                                    </td>
                                                    <td nowrap>
                                                        <button type="submit" class="btn btn-sm btn-primary">
                                                            <i class="fas fa-fw fa-cart-plus"></i> Pinjam
                                                        </button>
                                                    </td>
                                                </form>
                                            </tr>
                                        <?php $no++;
                                        endforeach ?>
                                        <tr class="mt-3">
                                            <td align="center" colspan="7">
                                                <a href="<?= base_url('transaksi/booking'); ?>" class="btn btn-outline-secondary">
                                                    <i class="fas fa-fw fa-redo"></i> Refresh
                                                </a>
                                            </td>
                                        </tr>
                                    </tbody>
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