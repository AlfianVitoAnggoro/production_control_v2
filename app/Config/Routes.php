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
$routes->group('lhp', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Home::lhp_view');
    $routes->post('add_lhp', 'Home::add_lhp');
    $routes->get('delete_lhp/(:num)', 'Home::delete_lhp/$1');
    $routes->post('getPartNo', 'Home::getPartNo');
    $routes->post('getCT', 'Home::getCT');
    $routes->post('get_proses_breakdown', 'Home::get_proses_breakdown');
    $routes->post('get_kategori_reject', 'Home::get_kategori_reject');
    $routes->post('save_lhp', 'Home::save_lhp');
    $routes->get('detail_lhp/(:num)', 'Home::detail_lhp/$1');
    $routes->post('update_lhp', 'Home::update_lhp');
    $routes->post('get_data_andon', 'Home::get_data_andon');
    $routes->post('pilih_andon', 'Home::pilih_andon');
    $routes->get('hapus_lhp/(:num)', 'Home::hapus_lhp/$1');
});


//GRID
$routes->group('grid', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Grid::index', ['filter' => 'auth']);
    $routes->get('detail_lhp/(:num)', 'Grid::detail_lhp/$1');
    $routes->post('add_lhp', 'Grid::add_lhp');
    $routes->post('get_jks', 'Grid::get_jks');
    $routes->post('update_lhp', 'Grid::update_lhp');
    $routes->post('get_data_andon', 'Grid::get_data_andon');
    $routes->get('hapus_lhp/(:num)', 'Grid::hapus_lhp/$1');
});

//PLATECUTTING
$routes->group('platecutting', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PlateCutting::platecutting_view');
    $routes->get('add_platecutting/(:segment)', 'PlateCutting::add_platecutting/$1');
    $routes->post('save', 'PlateCutting::save');
    $routes->get('detail_platecutting/(:segment)', 'PlateCutting::detail_platecutting/$1');
    $routes->post('detail_platecutting/edit', 'PlateCutting::edit');
    $routes->get('download', 'PlateCutting::download');
});

//ENVELOPE
$routes->group('envelope', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Envelope::envelope_view');
    $routes->get('add_envelope/(:segment)', 'Envelope::add_envelope/$1');
    // $routes->get('detail_envelope', 'Envelope::detail_envelope');
    $routes->post('save', 'Envelope::save');
    $routes->get('detail_envelope/(:segment)', 'Envelope::detail_envelope/$1');
    $routes->post('detail_envelope/edit', 'Envelope::edit');
    $routes->get('download', 'Envelope::download');
});

//PASTING
$routes->group('pasting', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Pasting::pasting_view');
    $routes->post('add_pasting', 'Pasting::add_pasting');
    $routes->get('delete_pasting/(:num)', 'Pasting::delete_pasting/$1');
    $routes->post('getPartNo', 'Pasting::getPartNo');
    $routes->post('getCT', 'Pasting::getCT');
    $routes->post('get_proses_breakdown', 'Pasting::get_proses_breakdown');
    $routes->post('get_kategori_reject', 'Pasting::get_kategori_reject');
    $routes->post('save_pasting', 'Pasting::save_pasting');
    $routes->get('detail_pasting/(:num)', 'Pasting::detail_pasting/$1');
    $routes->post('update_pasting', 'Pasting::update_pasting');
    $routes->post('get_data_andon', 'Pasting::get_data_andon');
    $routes->post('pilih_andon', 'Pasting::pilih_andon');
    $routes->get('hapus_pasting/(:num)', 'Pasting::hapus_pasting/$1');
});

// $routes->get('/lhp/test', 'Home::test');

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
