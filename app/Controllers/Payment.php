<?php

namespace App\Controllers;

require_once APPPATH . '../vendor/autoload.php';

use App\Controllers\BaseController;
use App\Models\PemesananModel;
use App\Models\PelangganModel;
use App\Models\KendaraanModel;
use Xendit\Configuration;
use Xendit\Invoice\InvoiceApi;
use Dompdf\Dompdf;
use Dompdf\Options;

class Payment extends BaseController
{
    protected $pemesananModel;
    protected $pelangganModel;
    protected $kendaraanModel;
    protected $invoiceApi;

    public function __construct()
    {
        $this->pemesananModel = new PemesananModel();
        $this->pelangganModel = new PelangganModel();
        $this->kendaraanModel = new KendaraanModel();

        // Konfigurasi API Key untuk Xendit
        // Configuration::setXenditKey(getenv('XENDIT_API_KEY'));
        Configuration::setXenditKey('xnd_development_bbnUlIprgBHT3urVWvE0I4BsUjkYGjsYQDZ1wTwE67nR5CyWVSpLL6a3teydsOn');


        // Inisialisasi InvoiceApi untuk membuat invoice
        $this->invoiceApi = new InvoiceApi();
    }

    // Fungsi untuk checkout
    public function checkout($kode_pemesanan)
    {
        // Ambil data pemesanan berdasarkan kode
        $pemesanan = $this->pemesananModel->where('kode_pemesanan', $kode_pemesanan)->first();

        // Cek apakah pemesanan ditemukan
        if (!$pemesanan) {
            return redirect()->to('/pemesanan')->with('error', 'Data pemesanan tidak ditemukan');
        }

        // Ambil data pelanggan
        $pelanggan = $this->pelangganModel->find($pemesanan['pelanggan_id']);
        if (!$pelanggan) {
            return redirect()->to('/pemesanan')->with('error', 'Data pelanggan tidak ditemukan');
        }

        // Menyiapkan parameter untuk membuat invoice
        $params = [
            'external_id' => $pemesanan['kode_pemesanan'],
            'payer_email' => $pelanggan['email_pelanggan'],
            'description' => 'Pembayaran untuk pemesanan kendaraan',
            'amount' => (int) $pemesanan['total_harga'],
            'invoice_duration' => 3600,  // Durasi invoice (1 jam)
            'customer' => [
                'given_names' => $pelanggan['nama_pelanggan'],
                'email' => $pelanggan['email_pelanggan'],
                'mobile_number' => $pelanggan['no_telp_pelanggan'],
            ],
            'success_redirect_url' => base_url('payment/success/' . $kode_pemesanan),
            'failure_redirect_url' => base_url('payment/failed/' . $kode_pemesanan),
        ];

        try {
            // Membuat invoice menggunakan Xendit API
            $invoice = $this->invoiceApi->createInvoice($params);

            // Redirect ke halaman pembayaran Xendit
            return redirect()->to($invoice['invoice_url']);
        } catch (\Exception $e) {
            // Jika gagal membuat invoice
            return redirect()->to('/pemesanan')->with('error', 'Gagal membuat invoice: ' . $e->getMessage());
        }
    }

    // Fungsi untuk menangani halaman sukses pembayaran
    public function success($kode_pemesanan)
    {
        $pemesanan = $this->pemesananModel->where('kode_pemesanan', $kode_pemesanan)->first();
        $pelanggan = $this->pelangganModel->find($pemesanan['pelanggan_id']);

        // Render view untuk nota invoice
        $data = [
            'kode_pemesanan' => $kode_pemesanan,
            'nama_pelanggan' => $pelanggan['nama_pelanggan'],
            'email_pelanggan' => $pelanggan['email_pelanggan'],
            'total_harga' => $pemesanan['total_harga'],
            'tanggal_pemesanan' => $pemesanan['tanggal_pemesanan']
        ];

        return view('payment/success', ['kode_pemesanan' => $kode_pemesanan]);
    }

    // Fungsi untuk menangani halaman gagal pembayaran
    public function failed($kode_pemesanan)
    {
        return view('payment/failed', ['kode_pemesanan' => $kode_pemesanan]);
    }

    // Fungsi untuk menangani callback dari Xendit
    public function callback()
    {
        // Mendapatkan data dari Xendit callback
        $json = file_get_contents('php://input');
        $data = json_decode($json, true);

        if (isset($data['external_id']) && isset($data['status'])) {
            $kode_pemesanan = $data['external_id'];
            $status = $data['status'];

            // Update status pembayaran berdasarkan status dari Xendit
            if ($status == 'PAID') {
                $this->pemesananModel
                    ->where('kode_pemesanan', $kode_pemesanan)
                    ->set('status_pembayaran', 'Lunas') // Update status menjadi Lunas
                    ->update();
            } elseif ($status == 'EXPIRED') {
                $this->pemesananModel
                    ->where('kode_pemesanan', $kode_pemesanan)
                    ->set('status_pembayaran', 'Kadaluarsa') // Update status menjadi Kadaluarsa
                    ->update();
            } elseif ($status == 'FAILED') {
                $this->pemesananModel
                    ->where('kode_pemesanan', $kode_pemesanan)
                    ->set('status_pembayaran', 'Gagal') // Update status menjadi Gagal
                    ->update();
            }

            return json_encode(['message' => 'Callback processed']);
        }

        // Jika data tidak valid
        return json_encode(['message' => 'Invalid data']);
    }

    // Add the download_invoice method
    public function download_invoice($kode_pemesanan)
    {
        // Ambil data pemesanan berdasarkan kode
        $pemesanan = $this->pemesananModel->where('kode_pemesanan', $kode_pemesanan)->first();
        
        // Cek apakah pemesanan ditemukan
        if (!$pemesanan) {
            return redirect()->to('/pemesanan')->with('error', 'Data pemesanan tidak ditemukan');
        }
    
        // Ambil data pelanggan
        $pelanggan = $this->pelangganModel->find($pemesanan['pelanggan_id']);
        if (!$pelanggan) {
            return redirect()->to('/pemesanan')->with('error', 'Data pelanggan tidak ditemukan');
        }

        // Ambil data kendaraan
        $kendaraan = $this->kendaraanModel->find($pemesanan['kendaraan_id']);
        if (!$kendaraan) {
            return redirect()->to('/pemesanan')->with('error', 'Data kendaraan tidak ditemukan');
        }

        // Konversi logo ke base64
        $logoPath = FCPATH . 'assets/images/brand/instarentlogopng.png';
        $logo = '';
        if (file_exists($logoPath)) {
            $logoData = base64_encode(file_get_contents($logoPath));
            $logo = 'data:image/png;base64,' . $logoData;
        }
   
        $data = [
            'kode_pemesanan' => $kode_pemesanan,
            'nama_pelanggan' => $pelanggan['nama_pelanggan'],
            'email_pelanggan' => $pelanggan['email_pelanggan'],
            'total_harga' => $pemesanan['total_harga'],
            'tanggal_pemesanan' => $pemesanan['tanggal_pemesanan'],
            'tanggal_awal' => $pemesanan['tanggal_awal'],
            'tanggal_akhir' => $pemesanan['tanggal_akhir'],
            'lama_pemesanan' => $pemesanan['lama_pemesanan'],
            'nama_kendaraan' => $kendaraan['nama_kendaraan'],
            'jenis_kendaraan' => $kendaraan['jenis_kendaraan'],
            'no_telp_pelanggan' => $pelanggan['no_telp_pelanggan'],
            'logo' => $logo
        ];    
    
        // Set options untuk Dompdf
        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $options->set('isPhpEnabled', true);
    
        // Inisialisasi Dompdf
        $dompdf = new Dompdf($options);
    
        // Load view sebagai HTML untuk PDF
        $html = view('payment/nota', $data);
        $dompdf->loadHtml($html);
        $dompdf->render();
    
        // Download PDF
        return $dompdf->stream("Bukti Bayar {$kode_pemesanan}.pdf", array("Attachment" => 1));
    }
    

    private function generate_invoice_pdf($data)
    {
        // Initialize Dompdf
        $dompdf = new Dompdf();
    
        // Load HTML content
        $html = view('payment/invoice', $data);  // Use view to render HTML invoice
    
        $dompdf->loadHtml($html);
    
        // Set paper size
        $dompdf->setPaper('A4', 'portrait');
    
        // Render PDF (first pass)
        $dompdf->render();
    
        // Save the generated PDF to a file
        $output = $dompdf->output();
        $pdf_file = APPPATH . 'public/invoices/invoice_' . $data['kode_pemesanan'] . '.pdf';
        file_put_contents($pdf_file, $output);
    }
}