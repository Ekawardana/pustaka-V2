<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Buku</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="bold"><?= $button ?> Data Buku</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= $action; ?>" method="post" enctype='multipart/form-data'>
                                <?php if ($button === "Edit") { ?>
                                    <div class="form-group">
                                        <label for="varchar">Image</label>
                                        <input type="file" name="image" class="dropify" data-default-file='<?= base_url("assets/img/buku/") . $image ?>' id="image" data-allowed-file-extensions="jpg jpeg png" data-max-file-size="1M" data-max-file-size-preview="1M" data-max-width="1000" data-max-height="1000" />
                                        <small class="text-danger">* Max 1 MB</small>
                                        <?= form_error('image', '<small class="text-danger">', '</small>') ?>
                                    </div>
                                <?php } ?>


                                <div class="form-group">
                                    <label for="varchar">Judul Buku</label>
                                    <input type="text" class="form-control" name="judul_buku" id="judul_buku" value="<?= $judul_buku; ?>" />
                                    <?= form_error('judul_buku') ?>
                                </div>

                                <div class="form-group">
                                    <label for="int">Kategori</label>
                                    <select class="form-control" name="id_kategori" id="id_kategori">
                                        <?php if ($button === "Edit") { ?>
                                            <option value="<?= $id_kategori; ?>" selected="selected">
                                                <?= $nama_kategori; ?>
                                            </option>
                                        <?php } else { ?>
                                            <option></option>
                                        <?php } ?>
                                    </select>
                                    <?= form_error('id_kategori') ?>
                                </div>

                                <div class="form-group">
                                    <label for="varchar">Pengarang</label>
                                    <input type="text" class="form-control" name="pengarang" id="pengarang" value="<?= $pengarang; ?>" />
                                    <?= form_error('pengarang') ?>
                                </div>

                                <div class="form-group">
                                    <label for="varchar">Penerbit</label>
                                    <input type="text" class="form-control" name="penerbit" id="penerbit" value="<?= $penerbit; ?>" />
                                    <?= form_error('penerbit') ?>
                                </div>

                                <div class="form-group">
                                    <label for="varchar">Tahun</label>
                                    <input type="number" class="form-control" name="tahun_terbit" id="tahun_terbit" value="<?= $tahun_terbit; ?>" />
                                    <?= form_error('tahun_terbit') ?>
                                </div>

                                <div class="form-group">
                                    <label for="varchar">ISBN</label>
                                    <input type="number" class="form-control" name="isbn" id="isbn" value="<?= $isbn; ?>" />
                                    <?= form_error('isbn') ?>
                                </div>


                                <div class="form-group">
                                    <label for="varchar">Stok</label>
                                    <input type="number" class="form-control" name="stok" id="stok" value="<?= $stok; ?>" />
                                    <?= form_error('stok') ?>
                                </div>

                                <?php if ($button === 'Edit') { ?>
                                    <div class="form-group">
                                        <label for="varchar">deskripsi</label>
                                        <textarea type="text-area" style="height: 100px;" class="form-control" name="deskripsi" id="deskripsi"><?= $deskripsi; ?></textarea>
                                        <?= form_error('deskripsi') ?>
                                    </div>
                                <?php } ?>

                                <?php if ($button === "Edit") { ?>
                                    <input type="hidden" name="id_buku" id="id_buku" value="<?= $id_buku; ?>" />
                                <?php } ?>
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary"><i class="fas fa-<?= $button == "Tambah" ? "plus" : "pencil-alt" ?>"></i> <?= $button ?></button>
                                    <a href="<?= site_url('master/Buku') ?>" class="btn btn-secondary"><i class="fas fa-undo mr-1"></i>Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>