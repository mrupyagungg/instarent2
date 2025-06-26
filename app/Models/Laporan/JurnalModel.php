<?php

namespace App\Models\Laporan;

use CodeIgniter\Model;

class JurnalModel extends Model
{
    protected $table      = 'jurnal';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id', 'tanggal', 'id_akun', 'nominal', 'posisi', 'reff', 'transaksi'];

    public function getById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getJurnal($month = null, $year = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('jurnal.*, akun.nama_akun');
        $builder->join('akun', 'akun.id_akun = jurnal.id_akun');

        if (!empty($month)) {
            $builder->where("MONTH(tanggal)", (int) $month, false);
        }
        if (!empty($year)) {
            $builder->where("YEAR(tanggal)", (int) $year, false);
        }

        $builder->orderBy('tanggal', 'ASC');
        return $builder->get()->getResultArray();
    }

    public function createOrderJurnal($data)
    {
        return $this->insertBatch($data);
    }

    public function updateJurnal($data, $id)
    {
        return $this->update($id, $data);
    }
}