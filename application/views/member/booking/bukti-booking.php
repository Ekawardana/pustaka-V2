<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $title; ?></title>
    <style>
        #table {
            font-family: "Nunito", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table2 {
            font-family: "Nunito", Arial, Helvetica, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }

        #table td,
        #table th {
            border: 1px solid #ddd;
            padding: 8px;
        }

        #table tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        #table tr:hover {
            background-color: #ddd;
        }

        #table th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: #2190c4;
            color: white;
        }

        #table2 th {
            padding-top: 10px;
            padding-bottom: 10px;
            text-align: left;
            background-color: white;
            color: black;
        }
    </style>
</head>

<body>
    <div style="text-align:center">
        <h3>Bukti Booking</h3>
    </div>


    <table id="table2">
        <?php
        foreach ($useraktif as $u) :
        ?>
            <tr>
                <th>Nama Anggota : <?= $u->name; ?></th>
            </tr>
            <tr>
                <th>Buku Yang dibooking</th>
            </tr>
        <?php endforeach; ?>
    </table>

    <table id="table">
        <thead>
            <tr>
                <th>No.</th>
                <th>Buku</th>
                <th>Penulis</th>
                <th>penerbit</th>
                <th>Tahun</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <?php
                $no = 1;
                foreach ($items as $i) {
                ?>
            <tr>
                <td><?= $no; ?></td>
                <td> <?= $i['judul_buku']; ?></td>
                <td><?= $i['pengarang']; ?></td>
                <td><?= $i['penerbit']; ?></td>
                <td><?= $i['tahun_terbit']; ?></td>
            </tr>
        <?php $no++;
                } ?>
        </tr>
        </tbody>
    </table>
</body>

</html>