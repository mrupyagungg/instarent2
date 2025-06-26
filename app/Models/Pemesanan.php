<?php

namespace App\Models;

use CodeIgniter\Model;

class Pemesanan extends Model
{
    protected $table = 'pemesanan'; // Nama tabel
    protected $primaryKey = 'id_pemesanan'; // Primary key

    // Kolom yang diizinkan untuk operasi mass-assignment
    protected $allowedFields = [
        'kode_pemesanan',
        'tanggal_awal',
        'tanggal_akhir',
        'lama_pemesanan',
        'total_harga',
        'jaminan_identitas',
        'pelanggan_id',
        'kendaraan_id',
        'status',
        'status_pesan',
        'user_id',
    ];

    // Timestamps otomatis
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';

    // Aturan validasi
    protected $validationRules = [
        'tanggal_awal'     => 'required|valid_date',
        'tanggal_akhir'     => 'required|valid_date',
        'lama_pemesanan'   => 'required|integer',
        'total_harga'      => 'required|integer',
        'jaminan_identitas'=> 'required',
        'pelanggan_id'     => 'required|integer',
        'kendaraan_id'     => 'required|integer',
    ];

    // Pesan validasi khusus
    protected $validationMessages = [
        'tanggal_awal' => [
            'required' => 'Tanggal awal wajib diisi.',
        ],
        'tanggal_akhir' => [
            'required' => 'Tanggal akhir wajib diisi.',
        ],
        'pelanggan_id' => [
            'required' => 'ID pelanggan wajib diisi.',
        ],
        'kendaraan_id' => [
            'required' => 'ID kendaraan wajib diisi.',
        ],
    ];

    // Callback sebelum insert atau update
    protected $beforeInsert = ['generateKodePemesanan', 'validateDateRange', 'checkPelangganKendaraan'];
    protected $beforeUpdate = ['validateDateRange', 'checkPelangganKendaraan'];

    /**
     * Generate kode_pemesanan secara otomatis dan berurutan.
     */
    protected function generateKodePemesanan(array $data)
    {
        $db = \Config\Database::connect();
        $lastKode = $db->table($this->table)
            ->selectMax('kode_pemesanan')
            ->get()
            ->getRow();
    
        if ($lastKode && $lastKode->kode_pemesanan) {
            $lastNumber = (int) substr($lastKode->kode_pemesanan, 4);
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }
    
        $data['data']['kode_pemesanan'] = 'PMS-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        return $data;
    }
    

    /**
     * Validasi range tanggal.
     */
   protected function validateDateRange(array $data)
{
    // Jangan jalankan kalau tidak ada field tanggal
    if (!isset($data['data']['tanggal_awal']) || !isset($data['data']['tanggal_akhir'])) {
        return $data;
    }

    $tanggalAwal = strtotime($data['data']['tanggal_awal']);
    $tanggalAkhir = strtotime($data['data']['tanggal_akhir']);

    if ($tanggalAwal >= $tanggalAkhir) {
        throw new \RuntimeException('Tanggal akhir harus lebih besar dari tanggal awal.');
    }

    return $data;
}


    /**
     * Validasi keberadaan pelanggan dan kendaraan di database.
     */
   protected function checkPelangganKendaraan(array $data)
{
    $db = \Config\Database::connect();

    // Validasi pelanggan hanya jika field-nya dikirim
    if (isset($data['data']['pelanggan_id'])) {
        $pelangganExists = $db->table('pelanggan')
            ->where('id_pelanggan', $data['data']['pelanggan_id'])
            ->countAllResults();

        if ($pelangganExists == 0) {
            throw new \RuntimeException('Pelanggan tidak ditemukan dalam database.');
        }
    }

    // Validasi kendaraan hanya jika field-nya dikirim
    if (isset($data['data']['kendaraan_id'])) {
        $kendaraanExists = $db->table('kendaraan')
            ->where('id_kendaraan', $data['data']['kendaraan_id'])
            ->countAllResults();

        if ($kendaraanExists == 0) {
            throw new \RuntimeException('Kendaraan tidak ditemukan dalam database.');
        }
    }

    return $data;
}

public function updateStatusOnly($id, $status)
{
    return $this->skipValidation()
                ->protect(false)
                ->where('id_pemesanan', $id)
                ->set(['status_pesan' => $status])
                ->update();
}


}