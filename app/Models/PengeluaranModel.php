<?php

namespace App\Models;

use CodeIgniter\Model;

class PengeluaranModel extends Model
{
    protected $table = 'pengeluaran';
    protected $primaryKey = 'id';
    protected $allowedFields = ['kode_transaksi', 'akun_id', 'tanggal', 'jumlah', 'keterangan'];

    public function rules()
    {
        return
            [
            'jumlah' =>
            [
                'label' => 'Jumlah',
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

    public function getKodePengeluaran()
    {
        $builder = $this->db->table('pengeluaran');
        $builder->selectMax('kode_transaksi');
        $query = $builder->get()->getResult();
        foreach ($query as $data):
            $jml_data = $data->kode_transaksi;
        endforeach;
        $kode_pengeluaran = 'PNG-';
        $kode = $jml_data ? substr($jml_data, -3) : 0;
        $nomor = str_pad(((int) $kode + 1), 3, "0", STR_PAD_LEFT);
        $kode_pengeluaran = $kode_pengeluaran . $nomor;
        return $kode_pengeluaran;
    }

    public function createPengeluaran($data)
    {
        $query = $this->db->table('pengeluaran')->insert($data);
        return $query;
    }

    public function updatePengeluaran($data, $kode_transaksi)
    {
        $query = $this->db->table('pengeluaran')->update($data, array('kode_transaksi' => $kode_transaksi));
        return $query;
    }

    public function deletePengeluaran($id)
    {
        $query = $this->db->table('pengeluaran')->delete(array('id' => $id));
        return $query;
    }
}
