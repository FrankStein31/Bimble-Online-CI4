<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

//  untuk reset pw
$routes->get('forgot-password', 'AuthController::forgotPassword');
$routes->post('forgot-password-process', 'AuthController::processForgotPassword');
$routes->get('reset-password/(:any)', 'AuthController::resetPassword/$1');
$routes->post('reset-password-process', 'AuthController::processResetPassword');
// end reset pw

// Halaman publik
$routes->get('/', 'Homepage::index');
// Login routes
$routes->get('/login', 'AuthController::login');
$routes->post('/login', 'AuthController::processLogin');

// Register routes
$routes->get('/register', 'AuthController::register');
$routes->post('/register', 'AuthController::processRegister');
$routes->get('/logout', 'AuthController::logout');

// Account routes
$routes->get('/account/profile', 'AccountController::profile');
$routes->get('/account/edit-profile', 'AccountController::editProfile');
$routes->post('/account/update-profile', 'AccountController::updateProfile');
// Halaman untuk siswa - perlu login
$routes->group('', ['filter' => 'auth:siswa'], function ($routes) {
    $routes->get('/jadwal', 'Homepage::jadwal');
    $routes->get('/registrasi-pembayaran', 'RegistrasiController::registrasiPembayaran');
    $routes->post('/registrasi-pembayaran/submit', 'RegistrasiController::submit');
    $routes->get('/registrasi-pembayaran/paket-aktif', 'RegistrasiController::paketAktif');
    $routes->get('/registrasi-pembayaran/transfer-bank', 'RegistrasiController::transferBank');
    $routes->get('/registrasi-pembayaran/history', 'RegistrasiController::history');
});
// Halaman dashboard - khusus admin
$routes->group('/dashboard', ['filter' => 'auth:admin'], function ($routes) {
    $routes->get('jadwal', 'JadwalController::index');
    $routes->get('program', 'ProgramController::index');
    $routes->get('rekening', 'RekeningController::index');
    $routes->get('siswa-ptn', 'SiswaPtnController::index'); // Diubah ke controller baru
    $routes->get('transaksi', 'TransaksiController::transaksi');
    $routes->get('user', 'UserController::index');
});

// Routes CRUD untuk Siswa PTN
$routes->group('siswa-ptn', ['filter' => 'auth:admin'], function ($routes) {
    $routes->post('add', 'SiswaPtnController::add');
    $routes->post('update/(:num)', 'SiswaPtnController::update/$1');
    $routes->get('delete/(:num)', 'SiswaPtnController::delete/$1');
    $routes->get('view-photo/(:num)', 'SiswaPtnController::viewPhoto/$1');
});
// Routes CRUD untuk jadwal
$routes->group('jadwal', ['filter' => 'auth:admin'], function ($routes) {
    $routes->post('add', 'JadwalController::add');
    $routes->post('update/(:num)', 'JadwalController::edit/$1');
    $routes->get('delete/(:num)', 'JadwalController::delete/$1');
});
// Routes CRUD untuk rekening
$routes->group('rekening', ['filter' => 'auth:admin'], function ($routes) {
    $routes->post('add', 'RekeningController::create');
    $routes->post('update/(:num)', 'RekeningController::edit/$1');
    $routes->get('delete/(:num)', 'RekeningController::delete/$1');
});
$routes->group('program', ['filter' => 'auth:admin'], function ($routes) {
    $routes->post('add', 'ProgramController::create');
    $routes->post('update/(:num)', 'ProgramController::edit/$1');
    $routes->get('delete/(:num)', 'ProgramController::delete/$1');
});

//  user
$routes->group('user', ['filter' => 'auth:admin'], function ($routes) {
    $routes->post('add', 'UserController::add');
    $routes->post('update/(:num)', 'UserController::edit/$1');
    $routes->get('delete/(:num)', 'UserController::delete/$1');
});
$routes->group('transaksi', ['filter' => 'auth:admin'], function ($routes) {
    $routes->post('add', 'TransaksiController::add');
    $routes->post('update/(:num)', 'TransaksiController::edit/$1');
    $routes->get('delete/(:num)', 'TransaksiController::delete/$1');
});

// app/Config/Routes.php
$routes->group('pengajar', function($routes){
    $routes->get('dashboard', 'Pengajar::dashboard');     // /pengajar/dashboard
    $routes->get('kelas',     'Pengajar::kelas');         // /pengajar/kelas
    $routes->post('absen',    'Pengajar::absen');         // /pengajar/absen (POST)
});
