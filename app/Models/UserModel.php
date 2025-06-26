<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'user_id';
    protected $allowedFields = ['username', 'email', 'password', 'role'];

    // Menambahkan fungsi untuk mendapatkan ID pengguna terakhir
    public function getLastUserId()
    {
        // Mengambil pengguna terakhir berdasarkan urutan ID (misalnya 'id')
        return $this->orderBy('user_id', 'DESC')->first(); // Ganti 'id' dengan nama kolom primary key yang sesuai
    }
}