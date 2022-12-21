<!-- Login -->
<form action="<?= base_url('member/authm'); ?>" class="modal-part" method="post" id="modal-login-part">
    <div class="form-group">
        <label>Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="Email" id="email" name="email">
        </div>
    </div>
    <div class="form-group">
        <label>Password</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <input type="password" class="form-control" placeholder="Password" id="password" name="password">
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Log in</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
<!-- End Login -->

<!-- Daftar Anggota -->
<form action="<?= base_url('member/authm/daftar'); ?>" class="modal-part" method="post" id="modal-daftar-part">
    <div class="form-group">
        <label>Email</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-envelope"></i>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="Masukan Email" id="email" name="email">
        </div>
    </div>

    <div class="form-group">
        <label>Nama</label>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-user"></i>
                </div>
            </div>
            <input type="text" class="form-control" placeholder="Masukan Nama" id="name" name="name">
        </div>
    </div>


    <div class="form-group">
        <label>Password</label>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-lock"></i>
                </div>
            </div>
            <input type="password" class="form-control" placeholder="Password" id="password1" name="password1">
        </div>
        <div class="input-group">
            <div class="input-group-prepend">
                <div class="input-group-text">
                    <i class="fas fa-key"></i>
                </div>
            </div>
            <input type="password" class="form-control" placeholder="Ulangi Password" id="password2" name="password2">
        </div>
    </div>


    <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Daftar</button>
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
    </div>
</form>
<!-- End Daftar Anggota -->