<?php

namespace App\Controllers;

use App\Models\JenisPengeluaranModel;
use \App\Models\CoaModel;
use \App\Models\Laporan\JurnalModel;
use \App\Models\PengeluaranModel;

class Pengeluaran extends BaseController
{
    protected $validation;
    protected $pengeluaranModel;
    protected $coaModel;
    protected $jenisPengeluaranModel;
    protected $jurnalModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->pengeluaranModel = new PengeluaranModel();
        $this->coaModel = new CoaModel();
        $this->jenisPengeluaranModel = new JenisPengeluaranModel();
        $this->jurnalModel = new JurnalModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Transaksi Pengeluaran',
            'pengeluaran' => $this->pengeluaranModel->findAll(),
        ];
        // dd($data);
        return view('pengeluaran/view_data_pengeluaran', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data Pengeluaran',
            'kode_transaksi' => $this->pengeluaranModel->getKodePengeluaran(),
            'jenis_pengeluaran' => $this->jenisPengeluaranModel->findAll(),
        ];
        return view('pengeluaran/add_data_pengeluaran', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pengeluaran',
            'kode_transaksi' => $this->pengeluaranModel->getKodePengeluaran(),
            'jenis_pengeluaran' => $this->jenisPengeluaranModel->findAll(),
        ];

        $this->validation->setRules($this->pengeluaranModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();

        $kode_transaksi = $this->pengeluaranModel->getKodePengeluaran();

        if ($isDataValid) {
            $id_akun = $this->jenisPengeluaranModel->where('id_jenis_pengeluaran', $this->request->getPost('id_jenis_pengeluaran'))->get()->getFirstRow()->id_akun;

            $data = array(
                'kode_transaksi' => $kode_transaksi,
                'tanggal' => date('Y-m-d'),
                'akun_id' => $id_akun,
                'jenis_pengeluaran_id' => $this->request->getPost('id_jenis_pengeluaran'),
                'jumlah' => replace_nominal($this->request->getPost('jumlah')),
                'keterangan' => $this->request->getPost('keterangan'),
            );

            $this->pengeluaranModel->createPengeluaran($data);

            $jurnal = [
                [
                    'tanggal' => date('Y-m-d'),
                    'id_akun' => $id_akun,
                    'nominal' => replace_nominal($this->request->getPost('jumlah')),
                    'posisi' => 'd',
                    'reff' => $kode_transaksi,
                    'transaksi' => $this->coaModel->where('id_akun', $id_akun)->get()->getLastRow()->nama_akun,
                ],
                [
                    'tanggal' => date('Y-m-d'),
                    'id_akun' => 101,
                    'nominal' => replace_nominal($this->request->getPost('jumlah')),
                    'posisi' => 'k',
                    'reff' => $kode_transaksi,
                    'transaksi' => 'Kas',
                ],
            ];
            $this->jurnalModel->createOrderJurnal($jurnal);
            session()->setFlashdata('success', 'Data Pengeluaran Berhasil Ditambahkan');
            return redirect()->to('pengeluaran');
        } else {
            $data['validation'] = $this->validation;
            return view('pengeluaran/add_data_pengeluaran', $data);
        }
    }

    public function edit($kode_transaksi)
    {
        $data = [
            'title' => 'Edit Data Pengeluaran',
            'pengeluaran' => $this->pengeluaranModel->where('kode_transaksi', $kode_transaksi)->first(),
            'jenis_pengeluaran' => $this->jenisPengeluaranModel->findAll(),
        ];
        $this->validation->setRules($this->pengeluaranModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $jurnal_debit = $this->jurnalModel->where('reff', $kode_transaksi)->get()->getFirstRow()->id;
            $jurnal_kredit = $this->jurnalModel->where('reff', $kode_transaksi)->where('id_akun', 101)->get()->getFirstRow()->id;
            $data = array(
                'tanggal' => date('Y-m-d'),
                'jumlah' => replace_nominal($this->request->getPost('jumlah')),
                'keterangan' => $this->request->getPost('keterangan'),
            );
            $this->pengeluaranModel->updatePengeluaran($data, $kode_transaksi);

            $dataJurnalD = array(
                'nominal' => replace_nominal($this->request->getPost('jumlah')),
            );

            $this->jurnalModel->updateJurnal($dataJurnalD, $jurnal_debit);

            $dataJurnalK = array(
                'nominal' => replace_nominal($this->request->getPost('jumlah')),
            );

            $this->jurnalModel->updateJurnal($dataJurnalK, $jurnal_kredit);

            session()->setFlashdata('success', 'Data Pengeluaran Berhasil Diubah');
            return redirect()->to('pengeluaran');
        }

        return view('pengeluaran/edit_data_pengeluaran', $data);
    }

    public function delete()
    {
        $id = $this->request->getPost('id');
        $this->pengeluaranModel->deletePengeluaran($id);
        session()->setFlashdata('success', 'Data Pengeluaran Berhasil Dihapus');

        return redirect()->to('pengeluaran');
    }
}
