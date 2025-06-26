<?php

namespace App\Controllers;

use App\Models\DashboardModel;

class Dashboard extends BaseController
{
    protected $dashboardModel;

    public function __construct()
    {
        $this->dashboardModel = new DashboardModel();
    }

    public function index()
{
    $pemesanan = $this->dashboardModel->getPemesananData();
    $pengeluaran = $this->dashboardModel->getPengeluaranData();
    $waktuData = $this->dashboardModel->getWaktuData();

    // Grafik kendaraan paling sering dipinjam
    $db = \Config\Database::connect();
    $kendaraanTerpinjam = $db->table('pemesanan')
        ->select('kendaraan.nama_kendaraan, COUNT(pemesanan.kendaraan_id) as total_pinjam')
        ->join('kendaraan', 'kendaraan.id_kendaraan = pemesanan.kendaraan_id')
        ->groupBy('pemesanan.kendaraan_id')
        ->orderBy('total_pinjam', 'DESC')
        ->limit(10)
        ->get()
        ->getResultArray();

    $kendaraan_nama = array_column($kendaraanTerpinjam, 'nama_kendaraan');
    $kendaraan_total = array_column($kendaraanTerpinjam, 'total_pinjam');

    $data = [
        'pemesanan' => $pemesanan,
        'pengeluaran' => $pengeluaran,
        'waktu' => $waktuData,
        'title' => 'Dashboard',
        'grafik' => $this->dashboardModel->grafik(),
        'total_pemesanan' => $this->dashboardModel->pemesananPerBulan()->total_pemesanan,
        'total_pengeluaran' => $this->dashboardModel->pengeluaranPerBulan()->total_pengeluaran,
        'data_pemesanan' => $this->dashboardModel->countPemesananPerBulan()->data_pemesanan,
        'data_pengeluaran' => $this->dashboardModel->countPengeluaranPerBulan()->data_pengeluaran,
        'kendaraan_nama' => $kendaraan_nama,
        'kendaraan_total' => $kendaraan_total,
    ];

    return view('dashboard/index', $data);
}

}