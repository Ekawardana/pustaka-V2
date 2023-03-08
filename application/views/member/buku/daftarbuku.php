 <!-- Main Content -->
 <div class="main-content">
     <section class="section">
         <div class="section-header">
             <h1>Daftar Buku</h1>
         </div>

         <div class="section-body">
             <div class="row d-flex justify-content-center">
                 <div class="col-6">
                     <?= $this->session->flashdata('message'); ?>
                     <?php if (empty($buku)) : ?>
                         <div class="alert alert-danger alert-dismissible fade show" role="alert">Oops! Buku ga ditemukan. <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>
                     <?php endif; ?>
                 </div>
             </div>


             <div class="row">
                 <?php foreach ($buku as $buku) : ?>
                     <div class="col-md-2 col-md-4">
                         <div class="card">
                             <div class="card-body">
                                 <div class="d-flex justify-content-center">
                                     <table style="width:100%;" class="table table-striped table-bordered">
                                         <tr align="center">
                                             <td colspan="3">
                                                 <img class="rounded" height="270" src="<?= base_url('assets/img/buku/') . $buku->image; ?>" style="max-width:100%; maxheight: 100%; height: 200px; width: 180px" alt="">
                                             </td>
                                         </tr>
                                         <tr>
                                             <td>Pengarang</td>
                                             <td><?= $buku->pengarang ?></td>
                                         </tr>
                                         <tr>
                                             <td>Penerbit</td>
                                             <td><?= $buku->penerbit ?></td>
                                         </tr>
                                         <tr>
                                             <td>Tahun Terbit</td>
                                             <td><?= $buku->tahun_terbit ?></td>
                                         </tr>
                                         <tr>
                                             <td colspan="3" align="center">
                                                 <a href="<?= base_url('member/home/detailBuku/' . $buku->id_buku) ?>" style="width: 40%;" class="btn btn-outline-warning">
                                                     <i class='fas fw fa-search mr-1'></i>Detail
                                                 </a>
                                             </td>
                                         </tr>
                                         <?php if ($buku->stok < 1) : ?>
                                             <tr>
                                                 <td colspan="3" align="center">
                                                     <i class='btn btn-outline-primary fas fw fa-shopping-cart'> Booking &nbsp;&nbsp; 0</i>
                                                 </td>
                                             </tr>
                                         <?php else : ?>
                                             <tr>
                                                 <td colspan="3" align="center">
                                                     <a class='btn btn-outline-primary' href='<?= site_url('member/booking/tambahBooking/' . $buku->id_buku) ?>'><i class='fas fw fa-shopping-cart mr-1'></i>Booking</a>
                                                 </td>
                                             </tr>
                                         <?php endif ?>
                                     </table>
                                 </div>
                             </div>
                         </div>
                     </div>
                 <?php endforeach ?>
             </div>
         </div>
     </section>
 </div>