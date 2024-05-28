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

    $routes->get('trouble-kamar', 'TroubleController::index');
    $routes->get('solved-room/(:num)', 'TroubleController::solved/$1');
    $routes->post('progress-trouble', 'TroubleController::progress');


    $routes->post('simpan-reservasi', 'ReservasiController::simpanReservasi');
    $routes->get('laporan', 'ReservasiController::checkedOutReservations');

    // pemesanan
    $routes->get('reservation', 'ReservationController::index');
    $routes->get('reservation/edit/(:num)', 'ReservationController::edit/$1');
    $routes->post('reservation/update-data/(:num)', 'ReservationController::updateData/$1');
    $routes->post('reservation/store', 'ReservationController::store');
    $routes->get('reservation/add', 'ReservationController::add');
    $routes->get('reservation/detail/(:num)', 'ReservationController::detail/$1');
    $routes->get('reservation/printReservation/(:num)', 'ReservationController::printReservation/$1');


    //Kas
    $routes->get('finance', 'FinanceController::index');
    $routes->get('add-credit', 'FinanceController::addCredit');
    $routes->get('add-debet', 'FinanceController::addDebet');
    $routes->post('save-credit', 'FinanceController::saveCredit');
    $routes->post('save-debet', 'FinanceController::saveDebet');

    $routes->get('kas-masuk', 'KasController::index');
    // report
    $routes->get('report', 'ReportController::index');
    $routes->post('report/filter-by-month', 'ReportController::filterByMonth');




    // komplain
    $routes->get('komplain', 'KomplainController::index');
    $routes->get('komplain/tambah', 'KomplainController::tambah');
    $routes->post('komplain/simpan', 'KomplainController::simpan');
    $routes->get('komplain/edit/(:num)', 'KomplainController::edit/$1');
    $routes->POST('komplain/update/(:num)', 'KomplainController::update/$1');


    //checkin
    $routes->post('simpan-checkin', 'CheckinController::simpan_checkin');
    $routes->get('checkout/(:num)', 'CheckinController::checkout/$1');
    $routes->post('pelunasan/(:num)', 'CheckinController::pelunasan/$1');
    $routes->post('extend/(:num)', 'CheckinController::extend/$1');

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
