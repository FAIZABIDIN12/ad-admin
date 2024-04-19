<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'KamarController::index');
$routes->post('/home/simpanReservasi', 'KamarController::simpanReservasi');
$routes->get('/home/detailReservasi/(:num)', 'KamarController::detailReservasi/$1');
$routes->get('/edit-kamar/(:num)', 'KamarController::editKamar/$1');
$routes->post('/update-kamar', 'KamarController::updateKamar');
$routes->get('/tambahKamar', 'KamarController::tambahKamar');
$routes->post('/simpanKamar', 'KamarController::simpanKamar');


$routes->get('/pemesanan', 'PemesananController::index');
$routes->get('pemesanan/edit/(:num)', 'PemesananController::edit/$1');
$routes->post('/pemesanan/updateData/(:num)', 'PemesananController::updateData/$1');
$routes->post('pemesanan/tambah', 'PemesananController::tambah');
$routes->get('/pemesanan/tambahData', 'PemesananController::tambahData');


$routes->get('/Auth/login', 'Auth::login');
$routes->get('/Auth/register', 'Auth::register');
