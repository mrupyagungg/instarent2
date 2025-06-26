<?php

namespace App\Controllers;

use App\Models\KendaraanModel;
use CodeIgniter\Controller;

class About_C extends Controller
{
    public function index()
    {
        $model = new KendaraanModel(); 
        $data['kendaraan'] = $model->findAll(); // Ambil semua data kendaraan

        return view('about/index', $data); // Kirim data ke view
    }
}