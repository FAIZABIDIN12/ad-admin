<?php

use CodeIgniter\Commands\Utilities\Routes;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function () {
    return view('index');
});

// main dahsboard (kamar)
$routes->group('admin', function ($routes) {
    $routes->get('/', 'KamarController::index');
    $routes->get('edit-kamar/(:num)', 'KamarController::editKamar/$1');
    $routes->post('update-kamar', 'KamarController::updateKamar');
    $routes->get('tambah-kamar', 'KamarController::tambahKamar');
    $routes->post('simpan-kamar', 'KamarController::simpanKamar');

    // reservasi
    $routes->get('detail-reservasi/(:num)', 'ReservasiController::detailReservasi/$1');
    $routes->get('checkout/(:num)', 'ReservasiController::checkout/$1');
    $routes->post('simpan-reservasi', 'ReservasiController::simpanReservasi');

    // pemesanan
    $routes->get('pemesanan', 'PemesananController::index');
    $routes->get('pemesanan/edit/(:num)', 'PemesananController::edit/$1');
    $routes->post('pemesanan/update-data/(:num)', 'PemesananController::updateData/$1');
    $routes->post('pemesanan/tambah', 'PemesananController::tambah');
    $routes->get('pemesanan/tambah-data', 'PemesananController::tambahData');

    //Komplain tamu
    $routes->get('komplain', 'KomplainController::index');
    $routes->get('tambah-komplain', 'KomplainController::tambah');
    $routes->post('simpan-komplain', 'KomplainController::simpan');
    $routes->get('edit-status/(:num)', 'KomplainController::editStatus/$1');
    $routes->post('update-status/(:num)', 'KomplainController::updateStatus/$1');



    //Kas
    $routes->get('kas', 'KasController::index');
    $routes->post('kas/simpan', 'KasController::simpan');
});

// autentifikasi
$routes->post('register', 'Auth::register');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');
