<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Laporan\JurnalModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class Jurnal extends BaseController
{
    protected $jurnalModel;

    public function __construct()
    {
        $this->jurnalModel = new JurnalModel();
    }

    public function index()
    {
        return view('laporan/view_data_jurnal_umum', [
            'title' => 'Jurnal Umum',
            'jurnal' => [],
            'month' => '',
            'year' => '',
            'date' => ''
        ]);
    }

    public function show_data_jurnal()
    {
        $month = esc($this->request->getPost('month') ?? date('m'));
        $year = esc($this->request->getPost('year') ?? date('Y'));

        if (!$this->validateMonthYear($month, $year)) {
            return redirect()->back()->with('error', 'Bulan atau tahun tidak valid');
        }

        $bulan = function_exists('format_bulan') ? format_bulan($month) : $month;

        return view('laporan/view_data_jurnal_umum', [
            'title' => 'Jurnal Umum',
            'jurnal' => $this->jurnalModel->getJurnal($month, $year),
            'month' => $month,
            'year' => $year,
            'date' => $bulan
        ]);
    }

    public function downloadPDF($month, $year)
    {
        if (!$this->validateMonthYear($month, $year)) {
            return redirect()->back()->with('error', 'Bulan atau tahun tidak valid');
        }

        $jurnal = $this->jurnalModel->getJurnal($month, $year);
        $bulan = function_exists('format_bulan') ? format_bulan($month) : $month;
        
        $html = view('laporan/pdf_jurnal_umum', [
            'title' => 'Jurnal Umum',
            'jurnal' => $jurnal,
            'month' => $month,
            'year' => $year,
            'date' => $bulan
        ]);

        $dompdf = new Dompdf(new Options(['defaultFont' => 'Arial']));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Jurnal_Umum_{$bulan}_{$year}.pdf", ["Attachment" => true]);
    }

    public function downloadExcel($month, $year)
    {
        if (!$this->validateMonthYear($month, $year)) {
            return redirect()->back()->with('error', 'Bulan atau tahun tidak valid');
        }

        $jurnal = $this->jurnalModel->getJurnal($month, $year);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        // Set headers
        $sheet->setCellValue('A1', 'Tanggal');
        $sheet->setCellValue('B1', 'Keterangan');
        $sheet->setCellValue('C1', 'Ref');
        $sheet->setCellValue('D1', 'Debit');
        $sheet->setCellValue('E1', 'Kredit');

        // Isi data
        $row = 2;
        foreach ($jurnal as $item) {
            $sheet->setCellValue("A{$row}", format_date($item['tanggal']));
            $sheet->setCellValue("B{$row}", $item['transaksi']);
            $sheet->setCellValue("C{$row}", $item['id_akun']);
            $sheet->setCellValue("D{$row}", $item['posisi'] === 'd' ? $item['nominal'] : '');
            $sheet->setCellValue("E{$row}", $item['posisi'] === 'k' ? $item['nominal'] : '');
            $row++;
        }

        // Output file
        $filename = "Jurnal_Umum_{$month}_{$year}.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }

    private function validateMonthYear($month, $year)
    {
        return is_numeric($month) && $month >= 1 && $month <= 12 &&
               is_numeric($year) && $year >= 2000 && $year <= date('Y');
    }
}