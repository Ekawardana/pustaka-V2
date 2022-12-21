<div class="main-content">
    <section class="section">
        <div class="section-header">
            <h1>Kategori</h1>
        </div>
        <div class="section-body">
            <div class="row">
                <div class="col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="bold"><?= $button ?> Data Kategori</h4>
                        </div>
                        <div class="card-body">
                            <form action="<?= $action; ?>" method="post">
                                <div class="form-group">
                                    <label for="varchar">Nama Kategori</label>
                                    <input type="text" class="form-control" name="nama_kategori" placeholder="Masukan Kategori..." id="nama_kategori" value="<?= $nama_kategori; ?>" />
                                    <?= form_error('nama_kategori') ?>
                                </div>

                                <input type="hidden" name="id_kategori" value="<?= $id_kategori; ?>" />
                                <div class="text-right">
                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-<?= $button == "Tambah" ? "plus" : "pencil-alt" ?>">
                                        </i> <?= $button ?>
                                    </button>
                                    <a href="<?= site_url('master/Kategori') ?>" class="btn btn-secondary"><i class="fas fa-undo"></i> Batal</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>