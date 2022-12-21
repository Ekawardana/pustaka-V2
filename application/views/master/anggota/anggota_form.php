<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Anggota</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="bold"><?= $button ?> Data Anggota</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= $action; ?>" method="post" enctype="multipart/form-data">
                                <?php if ($button === "Edit") { ?>
                                    <div class="form-group">
                                        <label for="varchar">Image</label>
                                        <input type="file" name="image" class="dropify" data-default-file='<?= base_url("assets/img/anggota/") . $image ?>' id="image" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="1M" data-max-file-size-preview="1M" data-max-width="1000" data-max-height="1000" />
                                        <small class="text-danger">* Max 1 MB</small>
                                        <?= form_error('image', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                <?php } ?>
                                <div class="form-group">
                                    <label for="varchar">Nama</label>
                                    <input type="text" class="form-control" name="name" id="name" value="<?= $name; ?>" />
                                    <?= form_error('name') ?>
                                </div>
                                <div class="form-group">
                                    <label for="varchar">Email</label>
                                    <input type="text" class="form-control" name="email" id="email" value="<?= $email; ?>" />
                                    <?= form_error('email') ?>
                                </div>
                                <div class="form-group">
                                    <label for="varchar"><?= $button === "Edit" ? "Ganti" : "" ?> Password <?= $button === "Edit" ? "(Optional)" : "" ?></label>
                                    <input type="password" class="form-control" name="password" id="password" />
                                    <?= form_error('password') ?>
                                </div>
                                <?php if ($button === "Edit") { ?>
                                    <div class="form-group">
                                        <label for="varchar">Konfirmasi Ganti Password</label>
                                        <input type="password" class="form-control" name="konfirmasi_ganti_password" />
                                        <?= form_error('konfirmasi_ganti_password') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($button === "Edit") { ?>
                                    <div class="form-group">
                                        <label for="varchar">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            <option></option>
                                            <option value="admin" <?= $role == 'admin' ? "selected" : "" ?>>Admin</option>
                                            <option value="member" <?= $role == 'member' ? "selected" : "" ?>>Member</option>
                                        </select>
                                        <?= form_error('role') ?>
                                    </div>
                                <?php } else { ?>
                                    <div class="form-group">
                                        <label for="varchar">Role</label>
                                        <select class="form-control" name="role" id="role">
                                            <option></option>
                                            <option value="admin">Admin</option>
                                            <option value="member">Member</option>
                                        </select>
                                        <?= form_error('role') ?>
                                    </div>
                                <?php } ?>
                                <?php if ($button === "Edit") { ?>
                                    <div class="form-group">
                                        <label for="varchar">Active</label>
                                        <div class="custom-switches-stacked mt-2">
                                            <label class="custom-switch">
                                                <input type="radio" name="is_active" value="1" <?= $is_active == 1 ? "checked" : "" ?> class="custom-switch-input" />
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">Active</span>
                                            </label>
                                            <label class="custom-switch">
                                                <input type="radio" name="is_active" value="0" <?= set_value('is_active', $is_active) == 0 ? "checked" : ""; ?> class="custom-switch-input" />
                                                <span class="custom-switch-indicator"></span>
                                                <span class="custom-switch-description">No Active</span>
                                            </label>
                                        </div>

                                    </div>
                                <?php } ?>
                                <input type="hidden" name="id" value="<?= $id; ?>" />
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-<?= $button == "Tambah" ? "plus" : "pencil-alt" ?>"></i> <?= $button ?>
                                    </button>
                                    <a href="<?= site_url('master/Anggota') ?>" class="btn btn-secondary"><i class="fas fa-undo"></i> Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>