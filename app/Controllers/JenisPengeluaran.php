<?php

namespace App\Controllers;

use \App\Models\CoaModel;
use \App\Models\JenisPengeluaranModel;

class JenisPengeluaran extends BaseController
{
    protected $validation;
    protected $jenisPengeluaranModel;
    protected $coaModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->jenisPengeluaranModel = new JenisPengeluaranModel();
        $this->coaModel = new CoaModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Jenis Pengeluaran',
            'jenispengeluaran' => $this->jenisPengeluaranModel->join('akun', 'akun.id_akun=jenis_pengeluaran.id_akun')->get()->getResultArray(),
            'id_jenis_pengeluaran' => $this->jenisPengeluaranModel->getKodeJenisPengeluaran(),
            'coa' => $this->coaModel->findAll(),
        ];
        // dd($data);
        return view('jenispengeluaran/view_data_jenis_pengeluaran', $data);
    }

    public function create()
    {
        $data = array(
            'id_jenis_pengeluaran' => $this->jenisPengeluaranModel->getKodeJenisPengeluaran(),
            'nama_jenis_pengeluaran' => $this->request->getPost('nama_jenis_pengeluaran'),
            'id_akun' => $this->request->getPost('id_akun'),
        );
        $this->jenisPengeluaranModel->createJenisPengeluaran($data);
        session()->setFlashdata('success', 'Data Jenis Pengeluaran Berhasil Ditambahkan');
        return redirect()->to('/jenispengeluaran'); 
    }

    public function update()
    {
        $id = $this->request->getPost('id_jenis_pengeluaran');

        $data = array(
            'nama_jenis_pengeluaran' => $this->request->getPost('nama_jenis_pengeluaran'),
            'id_akun' => $this->request->getPost('id_akun'),
        );
        $this->jenisPengeluaranModel->updateJenisPengeluaran($data, $id);
        session()->setFlashdata('success', 'Data Jenis Pengeluaran Berhasil Diubah');

        return redirect()->to('/jenispengeluaran'); 
    }

    public function delete()
    {
        $id = $this->request->getPost('id_jenis_pengeluaran');
        $this->jenisPengeluaranModel->deleteJenisPengeluaran($id);
        session()->setFlashdata('success', 'Data Jenis Pengeluaran Berhasil Dihapus');

        return redirect()->to('/jenispengeluaran'); 
    }
}
