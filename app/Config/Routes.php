<?php

use CodeIgniter\Router\RouteCollection;

/** @var RouteCollection $routes */

$routes->get('/', 'Home::index');

// AUTH
$routes->get('login', 'AuthController::login');
$routes->post('login/process', 'AuthController::processLogin');
$routes->get('register', 'AuthController::register');
$routes->post('register/store', 'AuthController::processRegister');
$routes->get('logout', 'AuthController::logout');

// FACILITIES
$routes->get('facilities', 'FacilityController::index');
$routes->get('facilities/create', 'FacilityController::create');
$routes->post('facilities/store', 'FacilityController::store');
$routes->get('facilities/edit/(:num)', 'FacilityController::edit/$1');
$routes->post('facilities/update/(:num)', 'FacilityController::update/$1');
$routes->get('facilities/delete/(:num)', 'FacilityController::delete/$1');
$routes->get('user/facilities', 'FacilityController::userFacilities');

// RESERVATION
$routes->get('reservations', 'ReservationController::index');
$routes->get('my-reservation', 'ReservationController::myReservation');
$routes->post('reservations/store', 'ReservationController::store');
$routes->get('/reservations/status/(:num)/(:any)','ReservationController::updateStatus/$1/$2');
$routes->get('reservations/create/(:num)', 'ReservationController::create/$1');

// PAYMENT
$routes->get('payments', 'PaymentController::index');
$routes->post('payments/store', 'PaymentController::store');
$routes->get('admin/payments', 'PaymentController::adminPayment');
$routes->get('test', function () {return view('test');});
$routes->get('payments/status/(:num)/(:any)','PaymentController::updateStatus/$1/$2');
$routes->get('payments/invoice/(:num)','PaymentController::downloadInvoice/$1');

// DASHBOARD
$routes->get('admin/dashboard', 'DashboardController::admin');
$routes->get('user/dashboard', 'DashboardController::user');
$routes->get('guest/dashboard', 'DashboardController::guest');
$routes->get('admin/users', 'DashboardController::users');
$routes->get('admin/users/delete/(:num)','DashboardController::deleteUser/$1');
$routes->get('profile', 'DashboardController::profile');
$routes->get('admin/users/edit/(:num)','DashboardController::editUser/$1');
$routes->post('admin/users/update/(:num)','DashboardController::updateUser/$1');
$routes->get('admin/report', 'DashboardController::report');
$routes->get('admin/report/export-pdf', 'DashboardController::exportPdf');
$routes->get('admin/report/export-excel', 'DashboardController::exportExcel');

// REST API FACILITIES
$routes->get('api/facilities', 'API\FacilityApiController::index');
$routes->post('api/facilities', 'API\FacilityApiController::create');
$routes->put('api/facilities/(:num)', 'API\FacilityApiController::update/$1');
$routes->delete('api/facilities/(:num)', 'API\FacilityApiController::delete/$1');

// Reservation API
$routes->get('api/reservations', 'API\ReservationApiController::index');
$routes->post('api/reservations', 'API\ReservationApiController::create');
$routes->put('api/reservations/(:num)', 'API\ReservationApiController::update/$1');
$routes->delete('api/reservations/(:num)', 'API\ReservationApiController::delete/$1');

// USER API
$routes->get('api/users', 'API\UserApiController::index');
$routes->post('api/users', 'API\UserApiController::create');
$routes->put('api/users/(:num)', 'API\UserApiController::update/$1');
$routes->delete('api/users/(:num)', 'API\UserApiController::delete/$1');
