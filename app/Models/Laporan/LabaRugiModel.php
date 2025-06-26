<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class LabaRugiModel extends Model
{
    protected $table = 'jurnal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'tanggal', 'id_akun', 'nominal', 'posisi', 'reff', 'transaksi'];

    public function getById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getPendapatan($month = '', $year = '')
    {
        $query = $this->db->table('akun a')
            ->select('a.nama_akun, IFNULL(c.nominal, 0) as nominal')
            ->join('(SELECT b.id_akun, SUM(b.nominal) as nominal FROM jurnal b WHERE MONTH(b.tanggal) = ' . $month . ' AND YEAR(b.tanggal) = ' . $year . ' GROUP BY b.id_akun) c', 'a.id_akun = c.id_akun', 'left')
            ->like('a.id_akun', '4', 'after')
            ->groupBy('a.id_akun')
            ->orderBy('a.id_akun', 'ASC')
            ->get();
        return $query->getResultArray();
    }

    public function getBeban($month = '', $year = '')
    {
        $query = $this->db->table('akun a')
            ->select('a.nama_akun, IFNULL(c.nominal, 0) as nominal')
            ->join('(SELECT b.id_akun, SUM(b.nominal) as nominal FROM jurnal b WHERE MONTH(b.tanggal) = ' . $month . ' AND YEAR(b.tanggal) = ' . $year . ' GROUP BY b.id_akun) c', 'a.id_akun = c.id_akun', 'left')
            ->like('a.id_akun', '5', 'after')
            ->groupBy('a.id_akun')
            ->orderBy('a.id_akun', 'ASC')
            ->get();
        return $query->getResultArray();
    }
}
