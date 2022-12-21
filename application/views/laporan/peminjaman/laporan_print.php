<html>

<head>
    <title></title>
</head>

<body>
    <style>
        .table-data {
            width: 100%;
            border-collapse: collapse;
        }

        .table-data tr th,
        .table-data tr td {
            border: 1px solid black;
            font-size: 11pt;
            font-family: Verdana, Geneva, Tahoma, sans-serif;
            padding: 10px 10px 10px 10px;
        }

        h3 {
            font-family: Verdana, Geneva, Tahoma, sans-serif;
        }
    </style>

    <h3>
        <center>Laporan Data Peminjaman</center>
    </h3>
    <br>
    <table class="table-data">
        <thead>
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
        </thead>
        <tbody>
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
        </tbody>
    </table>

    <script type="text/javascript">
        window.print();
    </script>

</body>

</html>