<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
//$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('/seputar-kost', 'Home::seputar_kost');

// Login Admin
$routes->get('admin/login', 'Form::indexAdmin', ['filter' => 'auth']);
$routes->post('admin/login', 'Form::validationAdmin', ['filter' => 'auth']);

// Login User
$routes->get('/login', 'Form::index', ['filter' => 'auth']);
$routes->post('/login', 'Form::validationMember', ['filter' => 'auth']);

// Register User
$routes->get('/register', 'Form::register', ['filter' => 'auth']);
$routes->post('/register', 'Form::createMember', ['filter' => 'auth']);

// Pesan Kamar
$routes->group('pesan', ['filter' => 'authToLogin'], function($routes) {
    $routes->get('kamar/(:num)', 'Pesan::index/$1');
    $routes->post('kamar', 'Pesan::pesanKamar');
});

// Admin
$routes->group('admin', ['filter' => 'adminAuth'], function($routes) {
    $routes->get('/', 'Admin::index');

    // Module User
    $routes->group('data-user', function($routes) {
        $routes->get('/', 'Admin::dataUser');
        $routes->post('/', 'Admin::createUser');
        $routes->get('update/(:num)', 'Admin::editUser/$1');
        $routes->put('update/(:num)', 'Admin::updateUser/$1');
        $routes->delete('(:num)', 'Admin::deleteUser/$1');
    });

    // Module Kamar
    $routes->group('data-kamar', function($routes) {
        $routes->get('/', 'Admin::dataKamar');
        $routes->post('/', 'Admin::createKamar');
        $routes->get('(:num)', 'Admin::editKamar/$1');
        $routes->put('(:num)', 'Admin::updateKamar/$1');
        $routes->delete('(:num)', 'Admin::deleteKamar/$1');
    });

    // Module Pengeluaran
    $routes->group('data-pengeluaran', function($routes) {
        $routes->get('/', 'Admin::dataPengeluaran');
        $routes->post('/', 'Admin::createPengeluaran');
        $routes->get('(:num)', 'Admin::editPengeluaran/$1');
        $routes->put('(:num)', 'Admin::updatePengeluaran/$1');
        $routes->delete('(:num)', 'Admin::deletePengeluaran/$1');
        $routes->post('download', 'Admin::download');
    });

    // Module Order
    $routes->group('data-order', function($routes) {
        $routes->get('/', 'Admin::dataOrder');
        $routes->get('(:num)', 'Admin::updateOrder/$1');
        $routes->put('(:num)', 'Admin::editOrder/$1');
        $routes->get('transaksi/user/(:num)/(:num)', 'Admin::dataTransaksi/$1/$2');
    });
});

// Member
$routes->group('member', ['filter' => 'memberAuth'], function($routes) {
    $routes->get('/', 'Member::index');

    // Module Order & Transaksi
    $routes->group('order', function($routes) {
        $routes->get('(:num)', 'Member::dataOrder/$1');
        $routes->get('bayar/(:num)', 'Member::paymentOrder/$1');
        $routes->post('bayar/(:num)', 'Member::transactionOrder/$1');
    });

    // Perpanjangan
    $routes->get('perpanjangan/(:num)/(:num)', 'Member::perpanjanganOrder/$1/$2');
    $routes->post('perpanjangan', 'Member::perpanjangan');

    // Pembayaran
    $routes->get('pembayaran/(:num)', 'Member::dataPembayaran/$1');

    // Delete Order Automatically
    $routes->get('delete/order', 'Member::deletedOrderWithTime');
});

// Logout
$routes->get('/logout', 'Form::logout', ['filter' => 'noAuth']);

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
