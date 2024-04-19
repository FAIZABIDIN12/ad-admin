<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/home/simpanReservasi', 'Home::simpanReservasi');
$routes->get('/home/detailReservasi/(:num)', 'Home::detailReservasi/$1');
$routes->get('/editKamar/(:num)', 'Home::editKamar/$1');
$routes->post('/updateKamar', 'Home::updateKamar');
$routes->get('/tambahKamar', 'Home::tambahKamar');
$routes->post('/simpanKamar', 'Home::simpanKamar');


$routes->get('/pemesanan', 'PemesananController::index');
$routes->get('pemesanan/edit/(:num)', 'PemesananController::edit/$1');
$routes->post('/pemesanan/updateData/(:num)', 'PemesananController::updateData/$1');
$routes->post('pemesanan/tambah', 'PemesananController::tambah');
$routes->get('/pemesanan/tambahData', 'PemesananController::tambahData');


$routes->get('/Auth/login', 'Auth::login');
$routes->get('/Auth/register', 'Auth::register');
