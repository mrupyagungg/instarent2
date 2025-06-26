<?php

namespace App\Controllers;

use \App\Models\CoaModel;

class Coa extends BaseController
{
    protected $coaModel;

    protected $validation;

    public function __construct()
    {
        $this->coaModel = new CoaModel();
    }

    public function index()
    {
        $data = [
            'title'     => 'Data COA',
            'coa'       => $this->coaModel->getCoa(),
        ];
        return view('coa/view_data_coa', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data COA'            
        ];
        return view('coa/add_data_coa', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pelanggan',
        ];

            $coa = array(
                'id_akun' => $this->request->getPost()['id_akun'],
                'nama_akun' => $this->request->getPost('nama_akun'),
                'kategori' => $this->request->getPost('kategori'),
                'posisi_d_c' => $this->request->getPost('posisi_d_c'),                
            );
            $this->coaModel->createCoa($coa);
            session()->setFlashdata('success', 'Data COA berhasil disimpan');
            return redirect()->to('coa');
    
}



    public function edit()
    {
        $valid = $this->validate([
            'id_akun' => [
                'label'                 => 'Nomor Akun',
                'rules'                 => 'required|is_unique[akun.id_akun,id_akun,' . $this->request->getPost('id_akun') . ']',
                'errors'                => [
                    'required'          => '{field} tidak boleh kosong.',
                    'is_unique'          => '{field} Nomor Akun Sudah Ada.',
                ]
            ],
        ]);

        if (!$valid) {
            session()->setFlashdata('error', 'Nomor Akun Sudah Ada.');
            return redirect()->back()->withInput();
        } else {
            $id = $this->request->getPost('id_akun');
            $data = array(
                'id_akun'           => $id,
                'nama_akun'         => $this->request->getPost('nama_akun'),
                'posisi_d_c'        => $this->request->getPost('posisi_d_c'),
            );
            $this->coaModel->updateCoa($data, $id);
            session()->setFlashdata('success', 'Data COA Berhasil Diubah');

            return redirect()->to('coa');
        }
    }

    public function delete()
    {
        $id = $this->request->getPost('id_akun');
        $this->coaModel->deleteCoa($id);
        session()->setFlashdata('success', 'Data COA Berhasil Dihapus');

        return redirect()->to('coa');
    }
}
