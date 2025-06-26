<?php

namespace App\Controllers;

use \App\Models\PelangganModel;
use \App\Models\KendaraanModel;

class Pelanggan extends BaseController
{
    protected $validation;
    protected $pelangganModel;
    protected $kendaraan;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->pelangganModel = new PelangganModel();
        $this->kendaraan = new KendaraanModel(); 
    }

    public function index()
    {
        $data = [
            'title' => 'Data Pelanggan',
            'pelanggan' => $this->pelangganModel->findAll(),
            'kendaraan' => $this->kendaraan->findAll(),
        ];
        return view('pelanggan/view_data_pelanggan', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data Pelanggan',
            'kode_pelanggan' => $this->generateKodePelanggan(), // Tambahkan kode pelanggan otomatis
        ];
        return view('pelanggan/add_data_pelanggan', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Pelanggan',
            'kode_pelanggan' => $this->generateKodePelanggan(), // Tambahkan kode pelanggan otomatis
        ];

        // Validasi data form
        $this->validation->setRules($this->pelangganModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $pelanggan = array(
                'kode_pelanggan' => $data['kode_pelanggan'],
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'no_telp_pelanggan' => $this->request->getPost('no_telp_pelanggan'),
                'email_pelanggan' => $this->request->getPost('email_pelanggan'),
                'alamat_pelanggan' => $this->request->getPost('alamat_pelanggan'),
                'jenis_kelamin_pelanggan' => $this->request->getPost('jenis_kelamin_pelanggan'),
            );
            $this->pelangganModel->createPelanggan($pelanggan);
            session()->setFlashdata('success', 'Data Pelanggan berhasil disimpan');
            return redirect()->to('pelanggan');
        } else {
            $data['validation'] = $this->validation;
            return view('pelanggan/add_data_pelanggan', $data);
        }
    }

    // Metode untuk menghasilkan kode pelanggan secara otomatis
    private function generateKodePelanggan()
    {
        $lastPelanggan = $this->pelangganModel->getLastPelanggan();
        $kodeAwal = 'PLG -'; // Awalan kode pelanggan
        $kodeUrut = 1;

        if ($lastPelanggan) {
            $kodeUrut = (int) substr($lastPelanggan['kode_pelanggan'], 1) + 1;
        }

        return $kodeAwal . str_pad($kodeUrut, 4, '0', STR_PAD_LEFT);
    }

    public function saveOrder()
{
    // Validasi input dari form
    $this->validation->setRules([
        'no_telp_pelanggan' => 'required|max_length[13]',
        'alamat_pelanggan' => 'required',
        'jenis_kelamin_pelanggan' => 'required'
    ]);

    if (!$this->validation->withRequest($this->request)->run()) {
        $data['validation'] = $this->validation;
        return view('pelanggan/view_detail_pelanggan', $data); // Tampilkan kembali form jika gagal validasi
    }

    // Ambil ID Pelanggan dari session dan Kode Pelanggan dari model
    $idPelanggan = session()->get('id_pelanggan');
    $kodePelanggan = $this->pelangganModel->getKodePelanggan();

    // Data Pelanggan
    $pelanggan = [
        'id_pelanggan' => $idPelanggan,
        'kode_pelanggan' => $kodePelanggan,
        'nama_pelanggan' => session()->get('username'), // Menggunakan data dari session
        'email_pelanggan' => session()->get('email'),
        'no_telp_pelanggan' => $this->request->getPost('no_telp_pelanggan'),
        'alamat_pelanggan' => $this->request->getPost('alamat_pelanggan'),
        'jenis_kelamin_pelanggan' => $this->request->getPost('jenis_kelamin_pelanggan')
    ];

    // Simpan ke database
    $this->pelangganModel->createPelanggan($pelanggan);

    // Pass data ke view jika perlu
    $data = [
        'id_pelanggan' => $idPelanggan,
        'kode_pelanggan' => $kodePelanggan
    ];

    session()->setFlashdata('success', 'Pemesanan berhasil disimpan');
    return redirect()->to('pelanggan'); // Redirect ke halaman pelanggan
}


    public function edit($id)
    {
        $pelanggan = $this->pelangganModel->getById($id);
        $data = [
            'title' => 'Edit Data Pelanggan',
            'pelanggan' => $pelanggan,
        ];

        $this->validation->setRules($this->pelangganModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $pelanggan = array(
                'nama_pelanggan' => $this->request->getPost('nama_pelanggan'),
                'no_telp_pelanggan' => $this->request->getPost('no_telp_pelanggan'),
                'email_pelanggan' => $this->request->getPost('email_pelanggan'),
                'alamat_pelanggan' => $this->request->getPost('alamat_pelanggan'),
                'jenis_kelamin_pelanggan' => $this->request->getPost('jenis_kelamin_pelanggan'),
            );
            $this->pelangganModel->updatePelanggan($pelanggan, $id);
            session()->setFlashdata('success', 'Data Pelanggan berhasil diubah');
            return redirect()->to('pelanggan');
        } else {
            return view('pelanggan/edit_data_pelanggan', $data);
        }
    }

    public function delete($id)
    {
        $this->pelangganModel->deletePelanggan($id);
        session()->setFlashdata('success', 'Data Pelanggan berhasil dihapus');
        return redirect()->to('pelanggan');
    }
}