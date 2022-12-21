<!-- Main Content -->
<div class="main-content">

    <section class="section">
        <div class="section-header">
            <h1>Anggota</h1>
        </div>


        <div class="section-body">
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="flash-data" data-flashdata="<?= $this->session->flashdata('message'); ?>"></div>
                        <div class="card-header">
                            <h4>Data Anggota</h4>
                            <div class="card-header-action">
                                <?= anchor(site_url('master/Anggota/add'), '<i class="fas fa-plus"></i> Tambah', 'class="btn btn-primary"'); ?>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-hover" id="myTable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Image</th>
                                            <th>Nama</th>
                                            <th>Email</th>
                                            <th>Role</th>
                                            <th>Action</th>
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