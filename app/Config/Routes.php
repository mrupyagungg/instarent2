<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

// --------------------------------------------------------------------
// Router Setup
// --------------------------------------------------------------------
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Dashboard');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();

// --------------------------------------------------------------------
// Route Definitions
// --------------------------------------------------------------------

// Auth routes
$routes->get('/customer/dashboard', 'Customer::index');
$routes->get('/', 'Customer::guest');
$routes->post('login/login', 'Login::login');
$routes->get('login', 'Login::index');

$routes->get('/', 'Login::index');
$routes->get('/login', 'Login::index');
$routes->post('/login/auth', 'Login::auth');
$routes->get('/logout', 'Login::logout');
$routes->get('/register', 'Register::index');
$routes->post('/register/save', 'Register::save');

// Customer
$routes->get('/dashboard', 'Dashboard::index', ['filter' => 'auth']);
$routes->get('/customer/dashboard', 'Customer::index', ['filter' => 'auth']);
$routes->post('customer/store', 'Customer::store');


// COA routes
$routes->group('coa', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Coa::index');
    $routes->get('add', 'Coa::add');
    $routes->post('create', 'Coa::create');
    $routes->post('edit', 'Coa::edit');
    $routes->post('delete', 'Coa::delete');
});

// Jenis Pengeluaran
$routes->group('jenispengeluaran', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'JenisPengeluaran::index');
    $routes->post('add', 'JenisPengeluaran::create');
    $routes->post('edit', 'JenisPengeluaran::update');
    $routes->post('delete', 'JenisPengeluaran::delete');
});

// Pelanggan
$routes->group('pelanggan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pelanggan::index');
    $routes->get('add', 'Pelanggan::add');
    $routes->post('create', 'Pelanggan::create');
    $routes->get('edit/(:any)', 'Pelanggan::edit/$1');
    $routes->post('edit/(:any)', 'Pelanggan::edit/$1');
    $routes->get('delete/(:any)', 'Pelanggan::delete/$1');
});

// Kendaraan
$routes->group('kendaraan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Kendaraan::index');
    $routes->get('add', 'Kendaraan::add');
    $routes->post('create', 'Kendaraan::create');
    $routes->get('edit/(:any)', 'Kendaraan::edit/$1');
    $routes->post('edit/(:any)', 'Kendaraan::edit/$1');
    $routes->get('delete/(:any)', 'Kendaraan::delete/$1');
});

// Pemesanan
$routes->group('pemesanan', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pemesanan::index');
    $routes->get('add', 'Pemesanan::add');
    $routes->post('create', 'Pemesanan::create');
    $routes->get('edit/(:any)', 'Pemesanan::edit/$1');
    $routes->post('edit/(:any)', 'Pemesanan::edit/$1');
    $routes->get('approve/(:num)', 'Pemesanan::approve/$1');
    $routes->get('disapprove/(:num)', 'Pemesanan::disapprove/$1');
    $routes->get('nota/(:num)', 'Pemesanan::nota/$1');
});

$routes->get('pemesanan/index', 'Pemesanan::index');
$routes->get('pemesanan/index(:num)', 'Pemesanan::index/$1');
$routes->get('pemesanan/add_data_pemesanan', 'Pemesanan::create');

// Pengeluaran
$routes->group('pengeluaran', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Pengeluaran::index');
    $routes->get('add', 'Pengeluaran::add');
    $routes->post('create', 'Pengeluaran::create');
    $routes->get('edit/(:any)', 'Pengeluaran::edit/$1');
    $routes->post('edit/(:any)', 'Pengeluaran::edit/$1');
    $routes->post('delete', 'Pengeluaran::delete');
});

// Report routes
$routes->group('jurnal', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Laporan\Jurnal::index');
    $routes->post('(:any)', 'Laporan\Jurnal::show_data_jurnal');
});
$routes->group('buku-besar', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Laporan\BukuBesar::index');
    $routes->post('(:any)', 'Laporan\BukuBesar::show_data_buku_besar');
});
$routes->group('laba-rugi', ['filter' => 'auth'], function($routes) {
    $routes->get('/', 'Laporan\LabaRugi::index');
    $routes->post('(:any)', 'Laporan\LabaRugi::show_data_laba_rugi');
});

// Rent
$routes->get('detail/(:num)', 'Customer::show/$1');

$routes->post('pemesanan/store', 'PemesananController::store', ['as' => 'pemesanan_store']);
$routes->post('pemesanan/store', 'PemesananController::store');

// Midtrans Payment Routes
$routes->group('payment', ['filter' => 'auth'], function ($routes) {
    $routes->get('checkout/(:num)', 'Payment::checkout/$1', ['as' => 'payment_checkout']);
    $routes->post('process', 'Payment::process', ['as' => 'payment_process']);
    $routes->post('callback', 'Payment::callback', ['as' => 'payment_callback']);
});

$routes->get('payment/checkout/(:segment)', 'Payment::checkout/$1');
$routes->post('payment/process', 'Payment::process');
$routes->get('payment/success', 'Payment::success');
$routes->get('payment/checkout', 'Payment::checkout');


$routes->get('garasi', 'Garasi_C::index');
$routes->get('about', 'About_C::index');
$routes->get('contact', 'Contact_C::index');

$routes->get('laporan/jurnal/downloadPDF', 'Laporan\Jurnal::downloadPDF');

$routes->get('payment/success/(:segment)', 'Payment::success/$1');
$routes->get('payment/download_invoice/(:any)', 'Payment::download_invoice/$1');

$routes->get('/riwayat', 'Riwayat::index');
$routes->get('pemesanan/kembalikan/(:num)', 'PemesananController::kembalikan/$1');
$routes->get('pemesanan/add_data_pemesanan/(:num)', 'Pemesanan::create/$1');
$routes->match(['get', 'post'], 'pemesanan/create/(:num)', 'Pemesanan::create/$1');


// laporan
$routes->get('buku-besar/download/pdf/(:num)/(:num)/(:num)', 'Laporan\BukuBesar::downloadPdf/$1/$2/$3');
$routes->get('buku-besar/download/excel/(:num)/(:num)/(:num)', 'Laporan\BukuBesar::downloadExcel/$1/$2/$3');

$routes->get('jurnal/download/pdf/(:num)/(:num)', 'Laporan\Jurnal::downloadPDF/$1/$2');
$routes->get('jurnal/download/excel/(:num)/(:num)', 'Laporan\Jurnal::downloadExcel/$1/$2');

$routes->get('laba-rugi/pdf/(:num)/(:num)', 'Laporan\LabaRugi::downloadPDF/$1/$2');
$routes->get('laba-rugi/excel/(:num)/(:num)', 'Laporan\LabaRugi::downloadExcel/$1/$2');


// Additional routes for environment-specific configs
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}