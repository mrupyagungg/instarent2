<?php

namespace App\Controllers\Laporan;

use App\Controllers\BaseController;
use App\Models\Laporan\BukuBesarModel;
use App\Models\Laporan\LabaRugiModel;
use Dompdf\Dompdf;
use Dompdf\Options;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class LabaRugi extends BaseController
{
    protected $labarugiModel;
    protected $bukuBesarModel;

    public function __construct()
    {
        $this->labarugiModel = new LabaRugiModel();
        $this->bukuBesarModel = new BukuBesarModel();
    }

    public function index()
    {
        $data = [
            'title' => 'Laporan Laba Rugi',
            'pendapatan' => [],
            'beban' => [],
            'date' => '',
            'year' => '',
            'total_pendapatan' => 0,
            'total_beban' => 0,
            'laba_kotor' => 0,
            'laba_bersih' => 0
        ];

        return view('laporan/view_data_lap_kas', $data);
    }

    public function show_data_laba_rugi()
    {
        $month = esc($this->request->getPost('month') ?? date('m'));
        $year = esc($this->request->getPost('year') ?? date('Y'));

        if (!is_numeric($month) || !is_numeric($year)) {
            return redirect()->back()->with('error', 'Bulan atau tahun tidak valid.');
        }

        $bulan = function_exists('format_bulan') ? format_bulan($month) : $month;

        $pendapatan = $this->labarugiModel->getPendapatan($month, $year);
        $beban = $this->labarugiModel->getBeban($month, $year);

        $total_pendapatan = array_sum(array_column($pendapatan, 'nominal'));
        $total_beban = array_sum(array_column($beban, 'nominal'));
        $laba_kotor = $total_pendapatan;
        $laba_bersih = $laba_kotor - $total_beban;

        $data = [
            'title' => 'Laporan Laba Rugi',
            'pendapatan' => $pendapatan,
            'beban' => $beban,
            'date' => $bulan,
            'month' => $month,
            'year' => $year,
            'total_pendapatan' => $total_pendapatan,
            'total_beban' => $total_beban,
            'laba_kotor' => $laba_kotor,
            'laba_bersih' => $laba_bersih,
        ];

        return view('laporan/view_data_lap_kas', $data);
    }

    public function downloadPDF($month, $year)
    {
        $pendapatan = $this->labarugiModel->getPendapatan($month, $year);
        $beban = $this->labarugiModel->getBeban($month, $year);
        $bulan = function_exists('format_bulan') ? format_bulan($month) : $month;

        $data = [
            'pendapatan' => $pendapatan,
            'beban' => $beban,
            'month' => $month,
            'year' => $year,
            'date' => $bulan,
            'total_pendapatan' => array_sum(array_column($pendapatan, 'nominal')),
            'total_beban' => array_sum(array_column($beban, 'nominal')),
            'laba_kotor' => array_sum(array_column($pendapatan, 'nominal')),
            'laba_bersih' => array_sum(array_column($pendapatan, 'nominal')) - array_sum(array_column($beban, 'nominal')),
        ];

        $html = view('laporan/pdf_laba_rugi', $data);

        $dompdf = new Dompdf(new Options(['defaultFont' => 'Arial']));
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream("Laporan_Laba_Rugi_{$bulan}_{$year}.pdf", ["Attachment" => true]);
    }

    public function downloadExcel($month, $year)
    {
        $pendapatan = $this->labarugiModel->getPendapatan($month, $year);
        $beban = $this->labarugiModel->getBeban($month, $year);

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $row = 1;
        $sheet->setCellValue("A{$row}", 'LAPORAN LABA RUGI');
        $row++;
        $sheet->setCellValue("A{$row}", 'Periode: ' . format_bulan($month) . ' ' . $year);
        $row += 2;

        $sheet->setCellValue("A{$row}", 'Pendapatan');
        $row++;
        foreach ($pendapatan as $item) {
            $sheet->setCellValue("A{$row}", $item['nama_akun']);
            $sheet->setCellValue("B{$row}", $item['nominal']);
            $row++;
        }

        $sheet->setCellValue("A{$row}", 'Total Pendapatan');
        $sheet->setCellValue("B{$row}", array_sum(array_column($pendapatan, 'nominal')));
        $row += 2;

        $sheet->setCellValue("A{$row}", 'Beban');
        $row++;
        foreach ($beban as $item) {
            $sheet->setCellValue("A{$row}", $item['nama_akun']);
            $sheet->setCellValue("B{$row}", $item['nominal']);
            $row++;
        }

        $totalPendapatan = array_sum(array_column($pendapatan, 'nominal'));
        $totalBeban = array_sum(array_column($beban, 'nominal'));

        $sheet->setCellValue("A{$row}", 'Total Beban');
        $sheet->setCellValue("B{$row}", $totalBeban);
        $row++;

        $sheet->setCellValue("A{$row}", 'Laba Bersih');
        $sheet->setCellValue("B{$row}", $totalPendapatan - $totalBeban);

        $filename = "Laporan_Laba_Rugi_{$month}_{$year}.xlsx";
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header("Content-Disposition: attachment; filename=\"$filename\"");
        $writer = new Xlsx($spreadsheet);
        $writer->save('php://output');
        exit;
    }
}