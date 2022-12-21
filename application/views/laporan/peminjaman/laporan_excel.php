<?php
header("Content-type: application/vnd-ms-excel");
header("Content-Disposition: attachment; filename=$title.xls");
header("Pragma: no-cache");
header("Expires: 0");
?>

<h3>
    <center>Laporan Data Peminjaman E-Perpus</center>
</h3>

<br>

<table>
    <tr>
        <th>No</th>
        <th>Nama Member</th>
        <th>Judul Buku</th>
        <th>Tanggal Pinjam</th>
        <th>Tanggal Kembali </th>
        <th>Tanggal Dikembalikan</th>
        <th>Total Denda</th>
        <th>Status</th>
    </tr>
    <?php
    $no = 1;
    foreach ($pinjam as $p) {
    ?>
        <tr>
            <th scope="row"><?= $no++; ?></th>
            <td><?= $p['name']; ?></td>
            <td><?= $p['judul_buku']; ?></td>
            <td><?= $p['tgl_pinjam']; ?></td>
            <td><?= $p['tgl_kembali']; ?></td>
            <td><?= $p['tgl_pengembalian']; ?></td>
            <td><?= $p['total_denda']; ?></td>
            <td><?= $p['status']; ?></td>
        </tr>
    <?php
    }
    ?>
</table>