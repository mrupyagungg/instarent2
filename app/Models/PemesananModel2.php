<?php

namespace App\Model;

use CodeIgniter\Model;

class PemesananModel2 extends Model
{
    protected $table = 'pemesanan';
    protected $primaryKey = 'id_pemesanan';
    protected $allowedFields = ['kode_pemesanan', 'lama_pemesanan', 'tanggal_pemesanan', 'total_harga', 'plat_nomor', 'jaminan_identitas', 'pelanggan_id', 'kendaraan_id', 'persetujuan'];

    public function rules()
    {
        return [
            'tanggal_pemesanan' => [
                'label' => 'Tanggal Pemesanan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'lama_pemesanan' => [
                'label' => 'Lama Pemesanan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'pelanggan_id' => [
                'label' => 'Pelanggan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'kendaraan_id' => [
                'label' => 'Kendaraan',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            // 'plat_nomor' => [
            //     'label' => 'Plat Nomor',
            //     'rules' => 'required',
            //     'errors' => [
            //         'required' => '{field} mohon diisi',
            //     ],
            // ],
            'jaminan_identitas' => [
                'label' => 'Jaminan Identitas',
                'rules' => [
                    'uploaded[jaminan_identitas]',
                    'is_image[jaminan_identitas]',
                    'mime_in[jaminan_identitas,image/jpg,image/jpeg,image/png,image/gif]',
                    'max_size[jaminan_identitas,1024]',
                ],
                'errors' => [
                    'uploaded' => '{field} mohon diisi',
                    'is_image' => '{field} harus berupa gambar',
                    'mime_in' => '{field} harus berformat jpg, jpeg, png, gif',
                    'max_size' => '{field} melebihi 1MB',
                ],
            ],
        ];
    }

    public function getAll()
{
    return $this->select('pemesanan.*, kendaraan.nama_kendaraan, kendaraan.jenis_kendaraan, kendaraan.gambar_kendaraan')
                ->join('kendaraan', 'kendaraan.id_kendaraan = pemesanan.kendaraan_id', 'left')
                ->findAll();
}


    public function getKodePemesanan()
    {
        $builder = $this->db->table('pemesanan');
        $builder->selectMax('kode_pemesanan');
        $query = $builder->get()->getResult();
        foreach ($query as $data):
            $jml_data = $data->kode_pemesanan;
        endforeach;
        $kode_pemesanan = 'PMS-';
        $kode = $jml_data ? substr($jml_data, -3) : 0;
        $nomor = str_pad(((int) $kode + 1), 3, "0", STR_PAD_LEFT);
        $kode_pemesanan = $kode_pemesanan . $nomor;
        return $kode_pemesanan;
    }

    public function getById($id)
    {
        return $this->where(['id_pemesanan' => $id])->first();
    }

    public function createPemesanan($data)
    {
        $query = $this->db->table('pemesanan')->insert($data);
        return $query;
    }

    public function updatePemesanan($data, $kode_pemesanan)
    {
        $query = $this->db->table('pemesanan')->update($data, ['kode_pemesanan' => $kode_pemesanan]);
        return $query;
    }

    public function deletePemesanan($id)
    {
        $query = $this->db->table('pemesanan')->delete(['id_pemesanan' => $id]);
        return $query;
    }
}

