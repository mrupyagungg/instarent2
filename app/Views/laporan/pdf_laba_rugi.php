<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Laporan Laba Rugi - <?= $date ?> <?= $year ?></title>
    <style>
    body {
        font-family: Arial, sans-serif;
        font-size: 12px;
        margin: 40px;
    }

    h2,
    h4 {
        text-align: center;
        margin: 0;
    }

    .text-right {
        text-align: right;
    }

    .text-left {
        text-align: left;
    }

    .text-center {
        text-align: center;
    }

    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }

    th,
    td {
        padding: 6px 8px;
        border: 1px solid #000;
    }

    .no-border {
        border: none !important;
    }

    .bold {
        font-weight: bold;
    }
    </style>
</head>

<body>

    <h2 style="text-align:center;">INSTA RENT</h2>
    <h4 style="text-align:center;">LAPORAN LABA RUGI</h4>
    <p class="text-center">Periode: <?= $date ?> <?= $year ?></p>

    <table>
        <thead>
            <tr>
                <th class="text-left">Keterangan</th>
                <th class="text-right">Nominal</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="bold">Pendapatan</td>
                <td></td>
            </tr>
            <?php foreach ($pendapatan as $p): ?>
            <tr>
                <td><?= $p['nama_akun'] ?></td>
                <td class="text-right"><?= nominal($p['nominal']) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td class="bold">Total Pendapatan</td>
                <td class="text-right bold"><?= nominal($total_pendapatan) ?></td>
            </tr>

            <tr>
                <td class="bold">Beban</td>
                <td></td>
            </tr>
            <?php foreach ($beban as $b): ?>
            <tr>
                <td><?= $b['nama_akun'] ?></td>
                <td class="text-right"><?= nominal($b['nominal']) ?></td>
            </tr>
            <?php endforeach; ?>
            <tr>
                <td class="bold">Total Beban</td>
                <td class="text-right bold"><?= nominal($total_beban) ?></td>
            </tr>

            <tr>
                <td class="bold"><?= $laba_bersih >= 0 ? 'Laba Bersih' : 'Rugi Bersih' ?></td>
                <td class="text-right bold"><?= nominal($laba_bersih) ?></td>
            </tr>
        </tbody>
    </table>

</body>

</html>