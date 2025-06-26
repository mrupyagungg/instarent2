<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\PemesananModel;

class Riwayat extends BaseController
{
    public function index()
    {
        // Cek apakah user sudah login
        $userId = session()->get('user_id');
        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Silakan login terlebih dahulu.');
        }

        // Koneksi ke database
        $db = \Config\Database::connect();

        // Ambil data riwayat pemesanan user
        $riwayat = $db->table('pemesanan')
            ->select('
                pemesanan.*,
                kendaraan.nama_kendaraan,
                kendaraan.gambar_kendaraan,
                kendaraan.merk_kendaraan,
                kendaraan.harga_sewa_kendaraan,
                kendaraan.jenis_kendaraan,
                kendaraan.warna_kendaraan,
                kendaraan.tahun_kendaraan,
                pelanggan.nama_pelanggan,
                pelanggan.email_pelanggan,
                pelanggan.no_telp_pelanggan
            ')
            ->join('kendaraan', 'kendaraan.id_kendaraan = pemesanan.kendaraan_id')
            ->join('pelanggan', 'pelanggan.user_id = pemesanan.user_id')
            ->where('pemesanan.user_id', $userId)
            ->orderBy('pemesanan.tanggal_pemesanan', 'DESC')
            ->get()
            ->getResultArray();

        // Kirim ke view
        return view('riwayat/index', [
            'riwayat' => $riwayat
        ]);
    }
}