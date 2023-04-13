<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Detail Anggota</h1>
        </div>

        <div class="section-body">
            <div class="row">

                <div class="col-sm-6">
                    <div class="card text-center">
                        <div class="card-body">
                            <img class="rounded mb-4" height="270" src="<?= base_url('assets/img/profile/') . $image; ?>" alt="">
                            <h4 class="card-title text-dark"><?= $name ?></h4>
                            <p class="card-text"><?= $email ?></p>
                            <a href="<?= base_url('master/Anggota') ?>" style="width: 30%;" class="btn btn-primary mt-2"><i class="fas fa-undo mr-1"></i>Back</a>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6 col-lg-6">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <tr align="center">
                                    <tr>
                                        <td>Role</td>
                                        <td><?= ucfirst($role); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Active</td>
                                        <?php if ($is_active == 1) : ?>
                                            <td>Active</td>
                                        <?php else : ?>
                                            <td>Not Active</td>
                                        <?php endif; ?>
                                    </tr>
                                    <tr>
                                        <td>Date Created</td>
                                        <td><?= date('d F Y', $date_created); ?></td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

    </section>
</div>