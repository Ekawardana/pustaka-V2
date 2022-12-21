<div class="main-content">
    <section class="section">
        <div class="section-body">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h4 class="bold">Detail Anggota</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive d-flex justify-content-center">
                        <table style="width:50%;" class="table table-striped table-bordered">
                            <tr align="center">
                                <td colspan="3">
                                    <img class="rounded" height="270" src="<?= base_url('assets/img/anggota/') . $image; ?>" alt="">
                                </td>
                            </tr>
                            <tr>
                                <td>Nama</td>
                                <td><?= $name; ?></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td><?= $email; ?></td>
                            </tr>
                            <tr>
                                <td>Role</td>
                                <td><?= ucwords($role); ?></td>
                            </tr>
                            <tr>
                                <td>Active</td>
                                <td>
                                    <?= ucwords($is_active == 1 ? "Active" : ""); ?>
                                    <?= ucwords($is_active == 0 ? "Not Active" : ""); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>Tanggal Dibuat</td>
                                <td><?= date('d F Y', $date_created); ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" align="center">
                                    <a href="<?= site_url('master/Anggota') ?>" style="width: 50%;" class="btn btn-dark">OK</a>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>