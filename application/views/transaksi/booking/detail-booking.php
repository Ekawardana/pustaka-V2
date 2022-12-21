<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <div class="section-body">
            <div class="row">
                <div class="col">
                    <table>
                        <?php foreach ($agt_booking as $ab) : ?>
                            <tr>
                                <td>Data Anggota</td>
                                <td>:</td>
                                <th>
                                    <div class="text-primary" style="font-weight: 900;"><?= $ab['name']; ?></div>
                                </th>
                            </tr>
                            <tr>
                                <td>ID Booking</td>
                                <td>:</td>
                                <th><?= $ab['id_booking']; ?></th>
                            </tr>
                        <?php endforeach; ?>

                        <div class="table-responsive mt-3">
                            <table class="table table-hover mt-4">
                                <thead>
                                    <tr>
                                        <th>No.</th>
                                        <th>ID Buku</th>
                                        <th>Judul Buku</th>
                                        <th>Pengarang</th>
                                        <th>Penerbit</th>
                                        <th>Tahun</th>
                                    </tr>
                                </thead>
                                <?php $no = 1;
                                foreach ($detail as $d) : ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $d['id_buku']; ?></td>
                                        <td><?= $d['judul_buku']; ?></td>
                                        <td><?= $d['pengarang']; ?></td>
                                        <td><?= $d['penerbit']; ?></td>
                                        <td><?= $d['tahun_terbit']; ?></td>
                                    </tr>
                                <?php $no++;
                                endforeach; ?>
                                <tr>
                                    <td align="center" colspan="6">
                                        <a href="#" onclick="window.history.go(-1)" class="btn btn-outline-danger">
                                            <i class="fas fa-fw fa-undo"></i> Kembali
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </table>
                </div>
            </div>
        </div>

    </section>
</div>
<!-- End content -->