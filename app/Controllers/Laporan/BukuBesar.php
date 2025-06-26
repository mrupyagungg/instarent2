<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use \App\Models\Laporan\BukuBesarModel;
use \App\Models\CoaModel;
use Dompdf\Dompdf;
use Dompdf\Options;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class BukuBesar extends BaseController
{
    protected $bukuBesarModel;
    protected $coaModel;

    public function __construct()
    {
        $this->bukuBesarModel = new BukuBesarModel();
        $this->coaModel = new CoaModel();
    }

    public function index()
    {
        $data = [
            'title'                 => 'Buku Besar',
            'buku_besar'            => [],
            'list_akun'             => $this->coaModel->findAll(),
            'posisi_saldo_normal'   => '',
            'saldo_awal'            => 0,
            'date'                  => '',
            'year'                  => '',
            'id_akun'               => '',
            'nama_akun'             => ''
        ];
        return view('laporan/view_data_buku_besar', $data);
    }

    public function show_data_buku_besar()
    {
        $akun  = $this->request->getPost('id_akun');
        $month = $this->request->getPost('month');
        $year  = $this->request->getPost('year');
        $bulan = format_bulan($month);

        $data = [
            'title'               => 'Buku Besar',
            'buku_besar'          => $this->bukuBesarModel->getBukuBesar($akun, $month, $year),
            'list_akun'           => $this->coaModel->findAll(),
            'posisi_saldo_normal' => $this->bukuBesarModel->getPosisiSaldoNormal($akun),
            'saldo_awal'          => $this->bukuBesarModel->getSaldoAwalBukuBesar($akun, $month, $year),
            'date'                => $bulan,
            'month'               => $month, // ✅ tambahkan ini
            'year'                => $year,
            'id_akun'             => $akun,
            'nama_akun'           => $this->coaModel->find($akun)['nama_akun'] ?? ''
        ];

        return view('laporan/view_data_buku_besar', $data);
    }
      
    public function downloadPdf($id_akun, $month, $year)
    {
        $bulan = format_bulan($month);
        $bukuBesar = $this->bukuBesarModel->getBukuBesar($id_akun, $month, $year);
        $saldoAwal = $this->bukuBesarModel->getSaldoAwalBukuBesar($id_akun, $month, $year);
        $posisi = $this->bukuBesarModel->getPosisiSaldoNormal($id_akun);
        $namaAkun = $this->coaModel->find($id_akun)['nama_akun'];

        $data = [
            'buku_besar' => $bukuBesar,
            'saldo_awal' => $saldoAwal,
            'posisi_saldo_normal' => $posisi,
            'date' => $bulan,
            'year' => $year,
            'nama_akun' => $namaAkun
        ];

        $html = view('laporan/pdf_buku_besar', $data);

        $options = new Options();
        $options->set('isHtml5ParserEnabled', true);
        $dompdf = new Dompdf($options);
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        $dompdf->stream("Buku_Besar_{$namaAkun}_{$bulan}_{$year}.pdf", ['Attachment' => true]);
    }

public function downloadExcel($id_akun, $month, $year)
{
    $bulan = format_bulan($month);
    $bukuBesar = $this->bukuBesarModel->getBukuBesar($id_akun, $month, $year);
    $saldoAwal = $this->bukuBesarModel->getSaldoAwalBukuBesar($id_akun, $month, $year);
    $posisi = $this->bukuBesarModel->getPosisiSaldoNormal($id_akun);
    $namaAkun = $this->coaModel->find($id_akun)['nama_akun'];

    $spreadsheet = new Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Buku Besar');

    // Header
    $sheet->setCellValue('A1', 'Buku Besar');
    $sheet->setCellValue('A2', "Akun: $namaAkun");
    $sheet->setCellValue('A3', "Periode: $bulan $year");

    // Table Head
    $sheet->setCellValue('A5', 'Tanggal');
    $sheet->setCellValue('B5', 'Nama Akun');
    $sheet->setCellValue('C5', 'REF');
    $sheet->setCellValue('D5', 'Debet');
    $sheet->setCellValue('E5', 'Kredit');
    $sheet->setCellValue('F5', 'Saldo Debet');
    $sheet->setCellValue('G5', 'Saldo Kredit');

    // Saldo Awal
    $row = 6;
    $saldo_debet = 0;
    $saldo_kredit = 0;
    $sheet->setCellValue("A{$row}", '-');
    $sheet->setCellValue("B{$row}", 'Saldo Awal');
    $sheet->setCellValue("C{$row}", '-');
    $sheet->setCellValue("D{$row}", '-');
    $sheet->setCellValue("E{$row}", '-');

    if ($posisi === 'd') {
        $saldo_debet = $saldoAwal;
        $sheet->setCellValue("F{$row}", $saldoAwal);
        $sheet->setCellValue("G{$row}", '-');
    } else {
        $saldo_kredit = $saldoAwal;
        $sheet->setCellValue("F{$row}", '-');
        $sheet->setCellValue("G{$row}", $saldoAwal);
    }

    // Data Transaksi
    foreach ($bukuBesar as $entry) {
        $row++;
        $sheet->setCellValue("A{$row}", $entry['tanggal']);
        $sheet->setCellValue("B{$row}", $entry['nama_akun']);
        $sheet->setCellValue("C{$row}", $entry['id_akun']);

        if ($entry['posisi'] === 'd') {
            $sheet->setCellValue("D{$row}", $entry['nominal']);
            $sheet->setCellValue("E{$row}", '-');
            $saldo_debet += $entry['nominal'];
        } else {
            $sheet->setCellValue("D{$row}", '-');
            $sheet->setCellValue("E{$row}", $entry['nominal']);
            $saldo_kredit += $entry['nominal'];
        }

        $sheet->setCellValue("F{$row}", $saldo_debet);
        $sheet->setCellValue("G{$row}", $saldo_kredit);
    }

    // Saldo Akhir
    $row++;
    $sheet->setCellValue("A{$row}", '-');
    $sheet->setCellValue("B{$row}", 'Saldo Akhir');
    $sheet->setCellValue("C{$row}", '-');
    $sheet->setCellValue("D{$row}", '-');
    $sheet->setCellValue("E{$row}", '-');

    if ($posisi === 'd') {
        $saldo_akhir = $saldo_debet - $saldo_kredit;
        $sheet->setCellValue("F{$row}", $saldo_akhir);
        $sheet->setCellValue("G{$row}", '-');
    } else {
        $saldo_akhir = $saldo_kredit - $saldo_debet;
        $sheet->setCellValue("F{$row}", '-');
        $sheet->setCellValue("G{$row}", $saldo_akhir);
    }

    // Set header & download
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header("Content-Disposition: attachment;filename=Buku_Besar_{$namaAkun}_{$bulan}_{$year}.xlsx");
    header('Cache-Control: max-age=0');

    $writer = new Xlsx($spreadsheet);
    $writer->save('php://output');
    exit();
}


}