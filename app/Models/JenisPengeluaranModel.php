<?php

namespace App\Models;

use CodeIgniter\Model;

class JenisPengeluaranModel extends Model
{
    protected $table = 'jenis_pengeluaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_jenis_pengeluaran', 'nama_jenis_pengeluaran', 'id_akun'];

    public function rules()
    {
        return
            [
            'nama_jenis' =>
            [
                'label' => 'Nama Jenis',
                'rules' => 'required',
                'errors' => [
                    'required' => ' {field} mohon diisi',
                ],
            ],
        ];
    }

    public function getById($id)
    {
        return $this->where(['id' => $id])->first();
    }

    public function getKodeJenisPengeluaran()
    {
        $builder = $this->db->table('jenis_pengeluaran');
        $builder->selectMax('id_jenis_pengeluaran', 'code');
        $query = $builder->get()->getResult();
        foreach ($query as $data):
            $jml_data = $data->code;
        endforeach;
        $id_jenis_pengeluaran = 'JPN-';
        $code = $jml_data ? substr($jml_data, -3) : 0;
        $nomor = str_pad(((int) $code + 1), 3, "0", STR_PAD_LEFT);
        $id_jenis_pengeluaran = $id_jenis_pengeluaran . $nomor;
        return $id_jenis_pengeluaran;
    }

    public function createJenisPengeluaran($data)
    {
        $query = $this->db->table('jenis_pengeluaran')->insert($data);
        return $query;
    }

    public function updateJenisPengeluaran($data, $id)
    {
        $query = $this->db->table('jenis_pengeluaran')->update($data, array('id_jenis_pengeluaran' => $id));
        return $query;
    }

    public function deleteJenisPengeluaran($id)
    {
        $query = $this->db->table('jenis_pengeluaran')->delete(array('id_jenis_pengeluaran' => $id));
        return $query;
    }
}
