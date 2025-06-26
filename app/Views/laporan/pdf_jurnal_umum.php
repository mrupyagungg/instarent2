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

    .text-end {
        text-align: right;
    }
    </style>
</head>

<body>
    <h2 style="text-align:center;">INSTA RENT</h2>
    <h4 style="text-align:center;">LAPORAN LABA RUGI</h4>
    <h3 style="text-align:center;">JURNAL UMUM</h3>
    <p><b>Periode:</b> <?= format_bulan($month) ?> <?= $year ?></p>

    <table>
        <thead>
            <tr>
                <th>Tanggal</th>
                <th>Keterangan</th>
                <th>Ref</th>
                <th>Debit</th>
                <th>Kredit</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalDebit = 0;
            $totalKredit = 0;
            ?>

            <?php foreach ($jurnal as $item): ?>
            <?php
                if ($item['posisi'] === 'd') {
                    $totalDebit += $item['nominal'];
                } else {
                    $totalKredit += $item['nominal'];
                }
            ?>
            <tr>
                <td><?= format_date($item['tanggal']) ?></td>
                <td style="<?= $item['posisi'] === 'k' ? 'padding-left: 30px;' : '' ?>">
                    <?= $item['transaksi'] ?>
                </td>
                <td><?= $item['id_akun'] ?></td>
                <td class="text-end"><?= $item['posisi'] === 'd' ? nominal($item['nominal']) : '-' ?></td>
                <td class="text-end"><?= $item['posisi'] === 'k' ? nominal($item['nominal']) : '-' ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>

        <?php if (!empty($jurnal)): ?>
        <tfoot>
            <tr>
                <td colspan="3"><b>Total</b></td>
                <td class="text-end"><b><?= nominal($totalDebit) ?></b></td>
                <td class="text-end"><b><?= nominal($totalKredit) ?></b></td>
            </tr>
        </tfoot>
        <?php endif; ?>
    </table>
</body>

</html>