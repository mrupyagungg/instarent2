<?php

namespace App\Controllers;

use \App\Models\KendaraanModel;

class Kendaraan extends BaseController
{
    protected $validation;
    protected $kendaraanModel;

    public function __construct()
    {
        $this->validation = \Config\Services::validation();
        $this->kendaraanModel = new KendaraanModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Data Kendaraan',
            'kendaraan' => $this->kendaraanModel->findAll(),
        ];
        return view('kendaraan/view_data_kendaraan', $data);
    }

    public function add()
    {
        $data = [
            'title' => 'Tambah Data Kendaraan',
            'kode_kendaraan' => $this->kendaraanModel->getKodeKendaraan(),
        ];
        return view('kendaraan/add_data_kendaraan', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data Kendaraan',
            'kode_kendaraan' => $this->kendaraanModel->getKodeKendaraan(),
        ];

        $this->validation->setRules($this->kendaraanModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $kendaraan = [
                'kode_kendaraan' => $data['kode_kendaraan'],
                'jenis_kendaraan' => $this->request->getPost('jenis_kendaraan'),
                'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
                'merk_kendaraan' => $this->request->getPost('merk_kendaraan'),
                'tahun_kendaraan' => $this->request->getPost('tahun_kendaraan'),
                'warna_kendaraan' => $this->request->getPost('warna_kendaraan'),
                'harga_sewa_kendaraan' => replace_nominal($this->request->getPost('harga_sewa_kendaraan')),
            ];

            // Proses upload gambar
            $gambarFile = $this->request->getFile('gambar_kendaraan');
            if ($gambarFile && $gambarFile->isValid() && !$gambarFile->hasMoved()) {
                $newName = $gambarFile->getRandomName();
                $gambarFile->move('uploads', $newName);  // Pastikan folder 'uploads/kendaraan' sudah ada
                $kendaraan['gambar_kendaraan'] = $newName; // Simpan nama file gambar ke database
            }

            $this->kendaraanModel->createKendaraan($kendaraan);
            session()->setFlashdata('success', 'Data Kendaraan berhasil disimpan');
            return redirect()->to('kendaraan');
        } else {
            $data['validation'] = $this->validation;
            return view('kendaraan/add_data_kendaraan', $data);
        }
    }

    public function edit($id)
    {
        $kendaraan = $this->kendaraanModel->getById($id);
        $data = [
            'title' => 'Edit Data Kendaraan',
            'kendaraan' => $kendaraan,
        ];

        $this->validation->setRules($this->kendaraanModel->rules());
        $isDataValid = $this->validation->withRequest($this->request)->run();

        if ($isDataValid) {
            $kendaraanUpdate = [
                'jenis_kendaraan' => $this->request->getPost('jenis_kendaraan'),
                'nama_kendaraan' => $this->request->getPost('nama_kendaraan'),
                'merk_kendaraan' => $this->request->getPost('merk_kendaraan'),
                'tahun_kendaraan' => $this->request->getPost('tahun_kendaraan'),
                'warna_kendaraan' => $this->request->getPost('warna_kendaraan'),
                'harga_sewa_kendaraan' => replace_nominal($this->request->getPost('harga_sewa_kendaraan')),
            ];

            // Menangani Upload Gambar
            $gambarFile = $this->request->getFile('gambar_kendaraan');
            if ($gambarFile && $gambarFile->isValid()) {
                // Hapus gambar lama (jika ada)
                if (!empty($kendaraan['gambar_kendaraan']) && file_exists('uploads/kendaraan/' . $kendaraan['gambar_kendaraan'])) {
                    unlink('uploads/kendaraan/' . $kendaraan['gambar_kendaraan']);
                }

                // Proses upload gambar baru
                $gambarNama = $gambarFile->getRandomName();
                $gambarFile->move('uploads/kendaraan/', $gambarNama);
                $kendaraanUpdate['gambar_kendaraan'] = $gambarNama;
            }

            $this->kendaraanModel->updateKendaraan($kendaraanUpdate, $id);
            session()->setFlashdata('success', 'Data Kendaraan berhasil diubah');
            return redirect()->to('kendaraan');
        } else {
            return view('kendaraan/edit_data_kendaraan', $data);
        }
    }

    public function delete($id)
    {
        // Ambil data kendaraan untuk mendapatkan nama gambar
        $kendaraan = $this->kendaraanModel->getById($id);

        // Hapus gambar kendaraan jika ada
        if (!empty($kendaraan['gambar_kendaraan']) && file_exists('uploads/kendaraan/' . $kendaraan['gambar_kendaraan'])) {
            unlink('uploads/kendaraan/' . $kendaraan['gambar_kendaraan']);
        }

        // Hapus data kendaraan dari database
        $this->kendaraanModel->deleteKendaraan($id);
        session()->setFlashdata('success', 'Data Kendaraan berhasil dihapus');
        return redirect()->to('kendaraan');
    }
    
        public function tersedia()
    {
        $data = [
            'title' => 'Daftar Kendaraan Tersedia',
            'kendaraan_ready' => $this->kendaraanModel->getAvailable()
        ];

        return view('kendaraan/view_kendaraan_tersedia', $data);
    }

}