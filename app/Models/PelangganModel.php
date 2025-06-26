<?php
namespace App\Models;

use CodeIgniter\Model;

class PelangganModel extends Model
{
    protected $table = 'pelanggan'; // Replace with your actual table name
    protected $primaryKey = 'id_pelanggan'; // Replace with your primary key column name

    protected $allowedFields = [
        'id_pelanggan','kode_pelanggan','kode_pelanggan', 'nama_pelanggan', 'no_telp_pelanggan',
        'email_pelanggan', 'alamat_pelanggan', 'jenis_kelamin_pelanggan'
    ];

    // Define validation rules if needed
    public function rules()
    {
        return [
            'nama_pelanggan' => 'required|max_length[100]',
            'email_pelanggan' => 'required|valid_email',
            'no_telp_pelanggan' => 'required|numeric|max_length[15]',
            'alamat_pelanggan' => 'required',
            'jenis_kelamin_pelanggan' => 'required'
        ];
    }

    // Method to generate a unique kode_pelanggan
    public function getKodePelanggan()
    {
        $lastPelanggan = $this->orderBy('id_pelanggan', 'DESC')->first();
        $newKode = 'PLG -' . str_pad(($lastPelanggan ? (int) substr($lastPelanggan['kode_pelanggan'], 3) + 1 : 1), 4, '0', STR_PAD_LEFT);
        return $newKode;
    }

    public function createPelanggan($data)
    {
        $this->insert($data);
    }

    public function getById($id)
    {
        return $this->find($id);
    }

    public function updatePelanggan($data, $id)
    {
        $this->update($id, $data);
    }

    public function deletePelanggan($id)
    {
        $this->delete($id);
    }

    // Method to get the last inserted pelanggan
    public function getLastPelanggan()
    {
        return $this->orderBy('id_pelanggan', 'DESC')->first();
    }
}