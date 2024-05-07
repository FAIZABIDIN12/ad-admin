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
$routes->group('admin', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'RoomController::index');
    $routes->get('edit-kamar/(:num)', 'RoomController::editKamar/$1');
    $routes->post('update-kamar', 'RoomController::updateKamar');
    $routes->get('tambah-kamar', 'RoomController::tambahKamar');
    $routes->post('simpan-kamar', 'RoomController::simpanKamar');


    $routes->post('simpan-reservasi', 'ReservasiController::simpanReservasi');
    $routes->get('laporan', 'ReservasiController::checkedOutReservations');

    // pemesanan
    $routes->get('pemesanan', 'ReservationController::index');
    $routes->get('pemesanan/edit/(:num)', 'ReservationController::edit/$1');
    $routes->post('pemesanan/update-data/(:num)', 'ReservationController::updateData/$1');
    $routes->post('pemesanan/tambah', 'ReservationController::tambah');
    $routes->get('pemesanan/tambah-data', 'ReservationController::tambahData');
    $routes->get('pemesanan/detail/(:num)', 'ReservationController::detail/$1');
    $routes->get('pemesanan/printReservation/(:num)', 'ReservationController::printReservation/$1');


    //Kas
    $routes->get('finance', 'FinanceController::index');
    $routes->post('add-cash-flow', 'FinanceController::simpan');

    // report
    $routes->get('report', 'ReportController::index');


    // komplain
    $routes->get('komplain', 'KomplainController::index');
    $routes->get('komplain/tambah', 'KomplainController::tambah');
    $routes->post('komplain/simpan', 'KomplainController::simpan');
    $routes->get('komplain/edit/(:num)', 'KomplainController::edit/$1');
    $routes->POST('komplain/update/(:num)', 'KomplainController::update/$1');


    //checkin
    $routes->post('simpan-checkin', 'CheckinController::simpan_checkin');
    $routes->get('checkout/(:num)', 'CheckinController::checkout/$1');
    $routes->get('history', 'CheckinController::history');
    $routes->get('detail-checkin/(:num)', 'CheckinController::detailCheckin/$1');
    $routes->get('printCheckin/(:num)', 'CheckinController::printCheckin/$1');
});

// autentifikasi
$routes->post('signup', 'Auth::signup');
$routes->get('login', 'Auth::login');
$routes->post('login', 'Auth::login');
$routes->get('register', 'Auth::register');
$routes->get('logout', 'Auth::logout');
