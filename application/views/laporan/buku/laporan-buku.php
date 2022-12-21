<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1><?= $title ?></h1>
        </div>

        <a href="<?= base_url('laporan/LaporanBuku/laporan_print'); ?>" class="btn btn-warning mb-3"><i class="fas fa-print"></i> Print</a>
        <a href="<?= base_url('laporan/LaporanBuku/laporan_pdf'); ?>" class="btn btn-danger mb-3"><i class="far fa-file-pdf"></i> Download Pdf</a>
        <a href="<?= base_url('laporan/LaporanBuku/laporan_excel'); ?>" class="btn btn-success mb-3"><i class="far fa-file-excel"></i> Export ke Excel</a>

        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Gambar</th>
                                            <th>Judul Buku</th>
                                            <th>Kategori</th>
                                            <th>Pengarang</th>
                                            <th>Penerbit</th>
                                            <th>Stok</th>
                                        </tr>
                                    </thead>
                                    <tbody>

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