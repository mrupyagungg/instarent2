<?php
namespace App\Models;

use CodeIgniter\Model;

class CustomerModel extends Model
{
    protected $table      = 'pelanggan';
    protected $primaryKey = 'id_pelanggan';

    protected $allowedFields = [
        'nama_pelanggan', 
        'kode_pelanggan', 
        'email_pelanggan', 
        'no_telp_pelanggan', 
        'alamat_pelanggan', 
        'jenis_kelamin_pelanggan',
        'user_id'
    ];

        // Validation rules
    protected $validationRules = [
        'nama_pelanggan' => 'permit_empty|min_length[3]',
        'email_pelanggan' => 'permit_empty|valid_email',
        'no_telp_pelanggan' => 'permit_empty|numeric',
        'alamat_pelanggan' => 'permit_empty',
        'jenis_kelamin_pelanggan' => 'permit_empty|in_list[Laki-laki,Perempuan]',
    ];


    // Custom error messages
    protected $validationMessages = [
        'kode_pelanggan' => [
            'is_unique' => 'Kode pelanggan sudah digunakan. Harap coba lagi dengan kode yang berbeda.'
        ],
        'email_pelanggan' => [
            'is_unique' => 'Email pelanggan ini sudah terdaftar.'
        ],
        'nama_pelanggan' => [
            'is_unique' => 'Nama pelanggan ini sudah terdaftar.'
        ]
    ];

    // Timestamps
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Soft deletes
    protected $useSoftDeletes = true;
    protected $deletedField   = 'deleted_at';

    // Get last pelanggan for kode generation
    public function getLastPelanggan()
    {
        // Cek apakah ada pelanggan yang ditemukan
        $lastPelanggan = $this->orderBy('id_pelanggan', 'DESC')->first();
        return $lastPelanggan ? $lastPelanggan : null;
    }
}