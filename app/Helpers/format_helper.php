<?php

if (!function_exists('format_bulan')) {
    function format_bulan($bulan)
    {
        $bulan = str_pad($bulan, 2, "0", STR_PAD_LEFT);
        $bulanIndonesia = [
            '01' => 'Januari', '02' => 'Februari', '03' => 'Maret',
            '04' => 'April', '05' => 'Mei', '06' => 'Juni',
            '07' => 'Juli', '08' => 'Agustus', '09' => 'September',
            '10' => 'Oktober', '11' => 'November', '12' => 'Desember',
        ];
        return $bulanIndonesia[$bulan] ?? 'Tidak Valid';
    }
}


if (!function_exists('format_rupiah')) {
    function format_rupiah($angka)
    {
        if (!is_numeric($angka)) return 'Rp 0';
        return 'Rp ' . number_format($angka, 0, ',', '.');
    }
}

if (!function_exists('nominal')) {
    function nominal($angka)
    {
        return format_rupiah($angka);
    }
}

if (!function_exists('format_indo')) {
    function format_indo($tanggal)
    {
        if (!$tanggal || !strtotime($tanggal)) return 'Tanggal Tidak Valid';

        $bulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $tahun = substr($tanggal, 0, 4);
        $bulan = (int) substr($tanggal, 5, 2);
        $hari = substr($tanggal, 8, 2);

        return "{$hari} {$bulanIndonesia[$bulan - 1]} {$tahun}";
    }
}

if (!function_exists('format_indo2')) {
    function format_indo2($tanggal)
    {
        if (!$tanggal || !strtotime($tanggal)) return 'Tanggal Tidak Valid';

        $bulanIndonesia = [
            'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
            'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
        ];

        $tahun = substr($tanggal, 0, 4);
        $bulan = (int) substr($tanggal, 5, 2);

        return "{$bulanIndonesia[$bulan - 1]} {$tahun}";
    }
}

if (!function_exists('format_date')) {
    function format_date($tanggal)
    {
        return date("d-m-Y", strtotime($tanggal));
    }
}

if (!function_exists('bulan')) {
    function bulan($bulan)
    {
        $bulanInggris = [
            'January' => 'Januari', 'February' => 'Februari', 'March' => 'Maret',
            'April' => 'April', 'May' => 'Mei', 'June' => 'Juni',
            'July' => 'Juli', 'August' => 'Agustus', 'September' => 'September',
            'October' => 'Oktober', 'November' => 'November', 'December' => 'Desember',
        ];
        return $bulanInggris[$bulan] ?? 'Tidak Valid';
    }
}

if (!function_exists('replace_nominal')) {
    function replace_nominal($angka)
    {
        return str_replace('.', '', $angka);
    }
}

?>