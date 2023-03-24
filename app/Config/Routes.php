<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

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
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Login::index');

//LOGIN
$routes->get('/login', 'Login::index');
$routes->post('/login/proses_login', 'Login::proses_login');
$routes->get('/logout', 'Login::logout');

//LHP
$routes->get('/lhp', 'Home::lhp_view', ['filter' => 'auth']);
$routes->post('/lhp/add_lhp', 'Home::add_lhp');
$routes->post('/lhp/getPartNo', 'Home::getPartNo');
$routes->post('/lhp/getCT', 'Home::getCT');
$routes->get('/lhp/envelope', 'Envelope::envelope_view', ['filter' => 'auth']);
$routes->get('/lhp/envelope/add_envelope', 'Envelope::add_envelope', ['filter' => 'auth']);
$routes->get('/lhp/envelope/detail_envelope', 'Envelope::detail_envelope', ['filter' => 'auth']);
$routes->post('/lhp/envelope/save', 'Envelope::save');
$routes->get('/lhp/envelope/detail_envelope/(:segment)', 'Envelope::detail_envelope/$1', ['filter' => 'auth']);
$routes->post('/lhp/envelope/detail_envelope/edit', 'Envelope::edit');
$routes->get('/lhp/envelope/download', 'Envelope::download');

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
