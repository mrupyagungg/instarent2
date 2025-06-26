<?php
namespace App\Controllers;

use \App\Models\KendaraanModel;
use \App\Models\PelangganModel;
use \App\Models\Pemesanan;

class PemesananController extends BaseController
{
    protected $validation;
    protected $pemesanans;
    protected $kendaraanModel;
    protected $pelangganModel;

    public function __construct()
    {
        // Inisialisasi validation service dan model
        $this->validation = \Config\Services::validation();
        $this->pemesanans = new Pemesanan();
        $this->kendaraanModel = new KendaraanModel();
        $this->pelangganModel = new PelangganModel();
    }

    // Menampilkan halaman utama pemesanan
    public function index()
    {
        $data = [
            'pemesanan' => $this->pemesanans->findAll(),
            'kendaraan' => $this->kendaraanModel->findAll(),
        ];

        return view('customer/detail', $data);
    }

    // Menampilkan form untuk membuat pemesanan baru
    public function create()
    {
        $kode_pemesanan = $this->pemesanans->getKodePemesanan();
        $data = [
            'title' => 'Tambah Data Pemesanan',
            'kode_pemesanan' => $kode_pemesanan,
            'pelanggan' => $this->pelangganModel->findAll(),
            'kendaraan' => $this->kendaraanModel->findAll(),
        ];

        if ($this->request->getMethod() === 'post') {
            $rules = [
                'pelanggan_id' => 'required',
                'kendaraan_id' => 'required',
                'tanggal_awal' => 'required|valid_date[Y-m-d]',
                'tanggal_akhir' => 'required|valid_date[Y-m-d]',
                'lama_pemesanan' => 'required|integer|greater_than[0]',
                'jaminan_identitas' => 'uploaded[jaminan_identitas]|max_size[jaminan_identitas,1024]|ext_in[jaminan_identitas,pdf,jpg,jpeg,png]',
            ];

            // Validasi data
            if (!$this->validate($rules)) {
                return view('pemesanan/add_data_pemesanan', [
                    'validation' => $this->validator,
                    ...$data,
                ]);
            }

            // Hitung total harga berdasarkan lama pemesanan
            $kendaraan = $this->kendaraanModel->find($this->request->getPost('kendaraan_id'));
            $lama_pemesanan = (int)$this->request->getPost('lama_pemesanan');
            $total_harga = $lama_pemesanan * $kendaraan['harga_sewa_kendaraan'];

            // Simpan file jaminan identitas
            $jaminan_identitas = $this->request->getFile('jaminan_identitas');
            if ($jaminan_identitas->isValid() && !$jaminan_identitas->hasMoved()) {
                $fileName = $jaminan_identitas->getRandomName(); // Generate random name for the file
                $jaminan_identitas->move(WRITEPATH . 'uploads', $fileName); // Save to a secure location
                $jaminan_identitasPath = $fileName;
            } else {
                return redirect()->back()->with('error', $jaminan_identitas->getErrorString());
            }
            

            // Data pemesanan
            $pemesanan = [
                'kode_pemesanan' => $kode_pemesanan,
                'lama_pemesanan' => $lama_pemesanan,
                'tanggal_awal' => $this->request->getPost('tanggal_awal'),
                'tanggal_akhir' => $this->request->getPost('tanggal_akhir'),
                'total_harga' => $total_harga,
                'jaminan_identitas' => $jaminanPath,
                'pelanggan_id' => $this->request->getPost('pelanggan_id'),
                'kendaraan_id' => $this->request->getPost('kendaraan_id'),
                'status' => 'Booked',
            ];

            // Simpan data pemesanan
            $this->pemesanans->save($pemesanan);
            session()->setFlashdata('success', 'Data Pemesanan berhasil disimpan');
            return redirect()->to(base_url('pemesanan'));
        }

        return view('pemesanan/add_data_pemesanan', $data);
    }

    // Menyetujui pemesanan
    public function approve($id)
    {
        $pemesanan = $this->pemesanans->find($id);
        if (!$pemesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pemesanan tidak ditemukan');
        }

        $this->pemesanans->update($id, ['status' => 'Approved']);
        session()->setFlashdata('success', 'Pemesanan telah disetujui');
        return redirect()->to(base_url('pemesanan'));
    }

    // Menolak pemesanan
    public function disapprove($id)
    {
        $pemesanan = $this->pemesanans->find($id);
        if (!$pemesanan) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Data pemesanan tidak ditemukan');
        }

        $this->pemesanans->update($id, ['status' => 'Disapproved']);
        session()->setFlashdata('success', 'Pemesanan tidak disetujui');
        return redirect()->to(base_url('pemesanan'));
    }

    // Menyimpan data pemesanan
    public function store()
    {
        // Validation rules
        $validationRules = [
            'pelanggan_id' => 'required',
            'kendaraan_id' => 'required',
            'tanggal_awal' => 'required|valid_date[Y-m-d]',
            'tanggal_akhir' => 'required|valid_date[Y-m-d]',
            'total_harga' => 'required|numeric',
            'jaminan_identitas' => 'uploaded[jaminan_identitas]|is_image[jaminan_identitas]|mime_in[jaminan_identitas,image/jpg,image/jpeg,image/png]|max_size[jaminan_identitas,2048]',
        ];
    
        if (!$this->validate($validationRules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }
    
        // Generate kode pemesanan
        $kodePemesanan = $this->generateKodePemesanan();
    
        // Handle file upload
        $jaminanIdentitas = $this->request->getFile('jaminan_identitas');
        $jaminanIdentitasPath = '';
        if ($jaminanIdentitas && $jaminanIdentitas->isValid() && !$jaminanIdentitas->hasMoved()) {
            $jaminanIdentitasPath = $jaminanIdentitas->store();
        } else {
            return redirect()->back()->withInput()->with('error', 'Upload jaminan identitas gagal.');
        }
    
        // Prepare data for insertion
        $pemesananData = [
            'pelanggan_id' => $this->request->getPost('pelanggan_id'),
            'kode_pemesanan' => $kodePemesanan, // Kode pemesanan otomatis
            'kendaraan_id' => $this->request->getPost('kendaraan_id'),
            'tanggal_awal' => $this->request->getPost('tanggal_awal'),
            'tanggal_akhir' => $this->request->getPost('tanggal_akhir'),
            'total_harga' => $this->request->getPost('total_harga'),
            'lama_pemesanan' => $this->request->getPost('lama_pemesanan'),
            'jaminan_identitas' => $jaminanIdentitasPath,
        ];
    
        // Save data to database
        if ($this->pemesanans->save($pemesananData)) {
            return redirect()->to('/customer/detail')->with('success', 'Pemesanan berhasil.');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menyimpan data pemesanan.');
        }
    }
    

    private function generateKodePemesanan()
    {
        $prefix = 'PMS-'; // Prefix kode pemesanan
        $date = date('Ymd'); // Format tanggal: TahunBulanHari
        $lastId = $this->pemesanans->selectMax('id_pemesanan')->first()['id_pemesanan'] ?? 0; // Ambil ID terakhir dari database
        $newId = $lastId + 1; // Tambahkan 1 untuk ID baru

        return $prefix . $date . sprintf('%05d', $newId); // Format: INV2025011500001
    }

    public function kembalikan($id)
    {
        $model = new \App\Models\Pemesanan();

        // Update hanya field status_pesan ke 'selesai'
        $model->updateStatusOnly($id, 'selesai');

        return redirect()->to(base_url('pemesanan'))->with('success', 'Pemesanan berhasil dikembalikan.');
    }

    
}