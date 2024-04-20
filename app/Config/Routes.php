<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', function() {return view('index');});

// main dahsboard (kamar)
$routes->group('admin', function($routes) {
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
});

// autentifikasi
$routes->post('register', 'Auth::register');
$routes->get('login', 'Auth::login');
$routes->get('register', 'Auth::register');