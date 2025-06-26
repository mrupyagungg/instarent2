<?= $this->extend('templates/head'); ?>
<?= $this->section('content-admin'); ?>
<div class="page-content">
    <div class="container-fluid">

        <!-- Page Title -->
        <div class="row pt-5 pb-2">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
                </div>
            </div>
        </div>
        <!-- End Page Title -->

        <div class="row">
            <?php 
            $cards = [
                ["title" => "Total Pemesanan", "value" => nominal($total_pemesanan)],
                ["title" => "Total Pengeluaran", "value" => nominal($total_pengeluaran)],
                ["title" => "Transaksi Pemesanan", "value" => "$data_pemesanan Transaksi"],
                ["title" => "Transaksi Pengeluaran", "value" => "$data_pengeluaran Transaksi"]
            ];
            ?>

            <?php foreach ($cards as $card) : ?>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body text-center">
                        <h4 class="card-title mb-4"><b><?= $card['title'] ?> (<?= date('F Y') ?>)</b></h4>
                        <h3 class="text-dark"><?= $card['value'] ?></h3>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
        <div class="card mt-4 shadow-sm">
            <div class="card-body">
                <h4 class="card-title text-center mb-4">Kendaraan yang Paling Sering Dipinjam</h4>
                <div id="chart-kendaraan" style="height: 400px;"></div>
            </div>
        </div>

    </div>
</div>
<?= $this->endSection(); ?>

<?= $this->section('content-script'); ?>
<!-- JavaScript Chart -->
<script>
var options = {
    series: [{
            name: 'Pemesanan',
            data: <?= json_encode($pemesanan); ?>
        },
        {
            name: 'Pengeluaran',
            data: <?= json_encode($pengeluaran); ?>
        }
    ],
    chart: {
        type: 'bar',
        height: 350
    },
    plotOptions: {
        bar: {
            horizontal: false,
            columnWidth: '55%',
            endingShape: 'rounded'
        }
    },
    dataLabels: {
        enabled: true,
        formatter: val => "Rp" + val.toLocaleString('id-ID'),
        offsetY: -20,
        style: {
            fontSize: '12px',
            colors: ["#304758"]
        }
    },
    stroke: {
        show: true,
        width: 2,
        colors: ['transparent']
    },
    xaxis: {
        categories: <?= json_encode($waktu); ?>
    },
    yaxis: {
        title: {
            text: 'Total Pemesanan & Pengeluaran Per Bulan'
        }
    },
    fill: {
        opacity: 1
    },
    tooltip: {
        y: {
            formatter: val => "Rp" + val.toLocaleString('id-ID')
        }
    }
};

new ApexCharts(document.querySelector("#grafik"), options).render();
</script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    var optionsKendaraan = {
        chart: {
            type: 'bar',
            height: 400
        },
        series: [{
            name: 'Jumlah Dipinjam',
            data: <?= json_encode($kendaraan_total) ?>
        }],
        xaxis: {
            categories: <?= json_encode($kendaraan_nama) ?>,
            labels: {
                rotate: -45,
                style: {
                    fontSize: '12px'
                }
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%',
                endingShape: 'rounded'
            }
        },
        dataLabels: {
            enabled: true
        },
        colors: ['#3b82f6'],
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " kali dipinjam";
                }
            }
        }
    };

    new ApexCharts(document.querySelector("#chart-kendaraan"), optionsKendaraan).render();
});
</script>
<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<?= $this->endSection(); ?>