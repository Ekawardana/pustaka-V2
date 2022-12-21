<!-- Footer -->
<footer class="main-footer">
    <div class="footer-right">
        Copyright © <?= date('Y') ?>
        <div class="bullet"></div>
        Eka Wardana
    </div>
</footer>
</div>
</div>

<!-- General JS Scripts -->
<script src="<?= base_url('assets') ?>/js/jquery-3.3.1.min.js"></script>
<script src="<?= base_url('assets') ?>/js/popper.min.js"></script>
<script src="<?= base_url('assets') ?>/js/tooltip.js"></script>
<script src="<?= base_url('assets') ?>/js/bootstrap.min.js"></script>
<script src="<?= base_url('assets') ?>/js/jquery.nicescroll.min.js"></script>
<script src="<?= base_url('assets') ?>/js/moment.min.js"></script>
<script src="<?= base_url('assets') ?>/js/stisla.js"></script>

<!-- JS Libraies -->


<!-- Template JS File -->
<script src="<?= base_url('assets') ?>/js/scripts.js"></script>
<script src="<?= base_url('assets') ?>/js/custom.js"></script>

<!-- My Scripts -->
<script>
    const modal = $('#modal-login-part');
    const modalDaftar = $('#modal-daftar-part');

    $('#modal-login').fireModal({
        title: 'Login Anggota',
        body: modal,
    });

    $('#modal-daftar').fireModal({
        title: 'Daftar Anggota',
        body: modalDaftar
    });
</script>
<script>
    $('.alert').alert().delay(3000).slideUp('slow');
</script>

</body>

</html>