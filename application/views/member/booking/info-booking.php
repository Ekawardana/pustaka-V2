<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Booking Info</h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col">

                    <div class="card">
                        <?= $this->session->flashdata('message'); ?>
                        <div class="card-header">
                            <?php foreach ($useraktif as $u) : ?>
                                Terima Kasih&nbsp;<div class="text-primary" style="font-weight:bold;"><?= $u->name ?></div>, Buku Yang ingin Anda Pinjam Adalah Sebagai berikut:
                            <?php endforeach; ?>
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
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $no = 1;
                                        foreach ($items as $i) : ?>
                                            <tr>
                                                <td><?= $no; ?></td>
                                                <td>
                                                    <img src="<?= base_url('assets/img/buku/' . $i['image']); ?>" class="avatar" alt="No Picture" height="75">
                                                </td>
                                                <td nowrap><?= $i['pengarang']; ?></td>
                                                <td nowrap><?= $i['penerbit']; ?></td>
                                                <td nowrap><?= substr($i['tahun_terbit'], 0, 4); ?></td>
                                            </tr>
                                        <?php $no++;
                                        endforeach; ?>
                                    </tbody>
                                    <tr>
                                        <td colspan="3">
                                            <a class="btn btn-danger" href="<?= base_url('member/booking/pdf'); ?>"><span class="far fa-file-pdf mr-1"></span>Pdf</a>
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