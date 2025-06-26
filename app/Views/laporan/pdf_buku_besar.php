<!DOCTYPE html>
<html>

<head>
    <style>
    body {
        font-family: sans-serif;
        font-size: 12px;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }

    th,
    td {
        border: 1px solid #000;
        padding: 5px;
        text-align: center;
    }
    </style>
</head>

<body>
    <h2 style="text-align:center;">INSTA RENT</h2>
    <h4 style="text-align:center;">LAPORAN LABA RUGI</h4>
    <h3 style="text-align:center;">BUKU BESAR</h3>
    <p><b>Akun:</b> <?= esc($nama_akun) ?> | <b>Periode:</b> <?= esc($date) ?> <?= esc($year) ?></p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Nama Akun</th>
                <th>REF</th>
                <th>Debet</th>
                <th>Kredit</th>
                <th>Saldo Debet</th>
                <th>Saldo Kredit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $saldo_debet = 0;
            $saldo_kredit = 0;
            ?>
            <tr>
                <td>-</td>
                <td><b>Saldo Awal</b></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <?php if ($posisi_saldo_normal == 'd') {
                    $saldo_debet = $saldo_awal;
                    echo "<td><b>" . nominal($saldo_awal) . "</b></td><td>-</td>";
                } else {
                    $saldo_kredit = $saldo_awal;
                    echo "<td>-</td><td><b>" . nominal($saldo_awal) . "</b></td>";
                } ?>
            </tr>

            <?php foreach ($buku_besar as $row): ?>
            <tr>
                <td><?= $row['tanggal'] ?></td>
                <td><?= $row['nama_akun'] ?></td>
                <td><?= $row['id_akun'] ?></td>
                <?php if ($row['posisi'] == 'd'): ?>
                <td><?= nominal($row['nominal']) ?></td>
                <td>-</td>
                <?php $saldo_debet += $row['nominal']; ?>
                <?php else: ?>
                <td>-</td>
                <td><?= nominal($row['nominal']) ?></td>
                <?php $saldo_kredit += $row['nominal']; ?>
                <?php endif; ?>
                <td><?= nominal($saldo_debet) ?></td>
                <td><?= nominal($saldo_kredit) ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <!-- Saldo Akhir -->
        <tfoot>
            <tr>
                <td>-</td>
                <td><b>Saldo Akhir</b></td>
                <td>-</td>
                <td>-</td>
                <td>-</td>
                <?php if ($posisi_saldo_normal == 'd'): ?>
                <?php $saldo_akhir = $saldo_debet - $saldo_kredit; ?>
                <td><b><?= nominal($saldo_akhir) ?></b></td>
                <td>-</td>
                <?php else: ?>
                <?php $saldo_akhir = $saldo_kredit - $saldo_debet; ?>
                <td>-</td>
                <td><b><?= nominal($saldo_akhir) ?></b></td>
                <?php endif; ?>
            </tr>
        </tfoot>
    </table>
</body>

</html>