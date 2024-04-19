<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// main dahsboard (kamar)
$routes->get('/', 'KamarController::index');
$routes->post('/home/simpanReservasi', 'KamarController::simpanReservasi');
$routes->get('/edit-kamar/(:num)', 'KamarController::editKamar/$1');
$routes->post('/update-kamar', 'KamarController::updateKamar');
$routes->get('/tambah-kamar', 'KamarController::tambahKamar');
$routes->post('/simpan-kamar', 'KamarController::simpanKamar');

// reservasi
$routes->get('/detail-reservasi/(:num)', 'ReservasiController::detailReservasi/$1');

// pemesanan
$routes->get('/pemesanan', 'PemesananController::index');
$routes->get('pemesanan/edit/(:num)', 'PemesananController::edit/$1');
$routes->post('/pemesanan/updateData/(:num)', 'PemesananController::updateData/$1');
$routes->post('pemesanan/tambah', 'PemesananController::tambah');
$routes->get('/pemesanan/tambahData', 'PemesananController::tambahData');

// autentifikasi
$routes->get('/Auth/login', 'Auth::login');
$routes->get('/Auth/register', 'Auth::register');
