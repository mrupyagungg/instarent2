<?php

namespace App\Models;

use CodeIgniter\Model;

class KendaraanModel extends Model
{
    protected $returnType = 'array';
    protected $table = 'kendaraan';
    protected $primaryKey = 'id_kendaraan';
    protected $allowedFields = [
        'kode_kendaraan',
        'jenis_kendaraan',
        'nama_kendaraan',
        'merk_kendaraan',
        'tahun_kendaraan',
        'warna_kendaraan',
        'harga_sewa_kendaraan',
        'status_kendaraan',
        'gambar_kendaraan'
    ];

    // Aturan validasi untuk model kendaraan
    public function rules()
    {
        return [
            'jenis_kendaraan' => [
                'label' => 'Jenis Kendaraan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'nama_kendaraan' => [
                'label' => 'Nama Kendaraan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'merk_kendaraan' => [
                'label' => 'Merk Kendaraan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'tahun_kendaraan' => [
                'label' => 'Tahun Kendaraan',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} mohon diisi',
                    'numeric' => '{field} harus berupa angka',
                ],
            ],
            'warna_kendaraan' => [
                'label' => 'Warna Kendaraan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'harga_sewa_kendaraan' => [
                'label' => 'Harga Sewa Kendaraan',
                'rules' => 'required|numeric',
                'errors' => [
                    'required' => '{field} mohon diisi',
                    'numeric' => '{field} harus berupa angka',
                ],
            ],
            'gambar_kendaraan' => [
                'label' => 'Gambar Kendaraan',
                'rules' => 'uploaded[gambar_kendaraan]|mime_in[gambar_kendaraan,image/jpg,image/jpeg,image/png]|max_size[gambar_kendaraan,2048]',
                'errors' => [
                    'uploaded' => '{field} mohon diunggah',
                    'mime_in' => '{field} harus berupa file gambar (jpg, jpeg, png)',
                    'max_size' => '{field} tidak boleh lebih dari 2MB',
                ],
            ],
        ];
    }

    // Mengambil data kendaraan berdasarkan ID
    public function getById($id)
    {
        return $this->where(['id_kendaraan' => $id])->first();
    }

    // Menghasilkan kode kendaraan baru
    public function getKodeKendaraan()
    {
        $builder = $this->db->table($this->table);
        $builder->selectMax('kode_kendaraan');
        $query = $builder->get()->getRow();

        $kode_kendaraan = 'KND-';
        $kode = $query->kode_kendaraan ? substr($query->kode_kendaraan, -3) : 0;
        $nomor = str_pad(((int) $kode + 1), 3, "0", STR_PAD_LEFT);
        return $kode_kendaraan . $nomor;
    }

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

    // Menyimpan data kendaraan baru
    public function createKendaraan($data)
    {
        return $this->insert($data);
    }

    // Mengupdate data kendaraan
    public function updateKendaraan($data, $id)
    {
        return $this->update($id, $data);
    }

    // Menghapus data kendaraan
    public function deleteKendaraan($id)
    {
        return $this->delete($id);
    }
}