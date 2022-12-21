<!-- Main Content -->
<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>
        <?= $this->session->flashdata('message'); ?>
        <div class="row mt-4">

            <!-- Card profile -->
            <div class="col-12 col-md-12 col-lg-6">

                <div class="card text-center">
                    <div class="card-body">
                        <img class="rounded mb-4" height="270" src="<?= base_url('assets/img/profile/') . $user['image']; ?>" alt="">
                        <h4 class="card-title text-dark"><?= $user['name'] ?></h4>
                        <div class="table-responsive text-left">
                            <table class="table table-bordered table-hover">
                                <tr align="center">
                                <tr>
                                    <td>Email</td>
                                    <td>: <?= $user['email']; ?></td>
                                </tr>
                                <tr>
                                    <td>Role</td>
                                    <td>: <?= ucwords($user['role']); ?></td>
                                </tr>
                                <tr>
                                    <td>Tanggal Daftar</td>
                                    <td>: <?= date('d F Y', $user['date_created']); ?></td>
                                </tr>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End card profile -->

            <div class="col-12 col-md-12 col-lg-6">
                <!-- Card ubah profile -->
                <div class="card">
                    <?= form_open_multipart('member/myProfile/editProfile'); ?>
                    <div class="card-header">
                        <h4>Ubah Data</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12 col-12">
                                <label>Nama</label>
                                <input type="hidden" name="email" id="email" value="<?= $user['email']; ?>" class="form-control">
                                <input type="text" name="name" id="name" value="<?= $user['name']; ?>" class="form-control">
                                <?= form_error('name', '<small class="text-danger">', '</small>') ?>
                            </div>
                            <div class="form-group col-md-12 col-12">
                                <label for="image">Foto</label>
                                <div class="custom-file">
                                    <input type="file" class="custom-file-input" name="image" id="image">
                                    <label class="custom-file-label" for="customFile">Pilih foto</label>
                                </div>
                                <small class="text-danger">* Max 1 MB</small>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                    </div>
                    </form>
                </div>
                <!-- End ubah profile -->

                <!-- Ubah password -->
                <div class="card">
                    <form method="post" action="<?= base_url('member/myProfile/ubahPassword'); ?>">
                        <div class="card-header">
                            <h4>Ubah Password</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12 col-12">
                                    <label>Password Lama</label>
                                    <input type="password" class="form-control" name="currentpassword" id="currentpassword">
                                    <?= form_error('currentpassword', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Password Baru</label>
                                    <input type="password" class="form-control" name="newpassword1" id="newpassword1">
                                    <?= form_error('newpassword1', '<small class="text-danger">', '</small>'); ?>
                                </div>
                                <div class="form-group col-md-12 col-12">
                                    <label>Ulangi Password</label>
                                    <input type="password" class="form-control" name="newpassword2" id="newpassword2">
                                    <?= form_error('newpassword2', '<small class="text-danger">', '</small>'); ?>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Simpan</button>
                        </div>
                    </form>
                </div>
                <!-- End ubah password -->

            </div>

        </div>
    </section>
</div>