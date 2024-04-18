<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->post('/home/simpanReservasi', 'Home::simpanReservasi');
$routes->get('home/detailReservasi/(:num)', 'Home::detailReservasi/$1');


$routes->post('/reservation/update', 'Home::update'); // Rute untuk menyimpan perubahan
$routes->get('home/checkout/(:num)', 'Home::checkout/$1');


$routes->get('/Auth/login', 'Auth::login');
$routes->get('/Auth/register', 'Auth::register');
