<?php

namespace App\Models;

use CodeIgniter\Model;

class CoaModel extends Model
{
    protected $table      = 'akun';
    protected $primaryKey = 'id_akun';
    protected $allowedFields = ['id_akun', 'nama_akun', 'saldo_normal', 'sa'];

    public function getCoa()
    {
        return $this->findAll();
    }

    public function getById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getListAkun()
    {
        $builder = $this->db->table('akun');
        $query   = $builder->get();
        return $query->getResultArray();
    }

    public function createCoa($data)
    {
        $query = $this->db->table('akun')->insert($data);
        return $query;
    }

    public function updateCoa($data, $id)
    {
        $query = $this->db->table('akun')->update($data, array('id_akun' => $id));
        return $query;
    }

    public function deleteCoa($id)
    {
        $query = $this->db->table('akun')->delete(array('id_akun' => $id));
        return $query;
    }

    public function rules()
    {        
        return
            [
            'id_akun' =>
            [
                'label' => 'ID Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'nama_akun' =>
            [
                'label' => 'Nama Akun',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'kategori' =>
            [
                'label' => 'Kategori',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
            'posisi_d_c' =>
            [
                'label' => 'posisi debit dan kredit',
                'rules' => 'required',
                'errors' => [
                    'required' => '{field} mohon diisi',
                ],
            ],
        ];
    }
}
