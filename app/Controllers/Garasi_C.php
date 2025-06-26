<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Garasi_C extends Controller
{
    // Method untuk mendapatkan kendaraan yang tersedia (belum dipesan)
     public function getAvailable()
    {
        $db = \Config\Database::connect();
        $builder = $db->table('kendaraan');
        $builder->select('kendaraan.*');
        $builder->whereNotIn('id_kendaraan', function ($subQuery) {
            return $subQuery->select('kendaraan_id')
                ->from('pemesanan')
                ->where('status_pesan', 'pesan'); // kendaraan yang sedang dipesan akan disembunyikan
        });

        // Hanya tampilkan kendaraan yang ready (opsional)
        $builder->where('status_kendaraan', 'ready');

        return $builder->get()->getResultArray();
    }   

   public function index()
    {
        // Ambil kendaraan yang ready (tersedia)
        $kendaraan_ready = $this->getAvailable();

        // Ambil kendaraan yang sedang dipesan (Not Ready)
        $db = \Config\Database::connect();
        $builder = $db->table('kendaraan');
        $builder->select('kendaraan.*');
        $builder->join('pemesanan', 'pemesanan.kendaraan_id = kendaraan.id_kendaraan', 'inner');
        $builder->where('pemesanan.status', 'approve');
        $builder->where('pemesanan.tanggal_awal <=', date('Y-m-d'));
        $builder->where('pemesanan.tanggal_akhir >=', date('Y-m-d'));
        $kendaraan_dipesan = $builder->get()->getResultArray();

        // ✅ Tambahkan pengecekan pelanggan dari session
        $user_id = session()->get('user_id');
        $pelanggan = null;
        if ($user_id) {
            $pelangganModel = new \App\Models\PelangganModel();
            $pelanggan = $pelangganModel->where('user_id', $user_id)->first();
        }

        $data = [
            'kendaraan_ready'   => $kendaraan_ready,
            'kendaraan_dipesan' => $kendaraan_dipesan,
            'pelanggan'         => $pelanggan, // dikirim ke view
        ];

        return view('garasi/index', $data);
    }

}