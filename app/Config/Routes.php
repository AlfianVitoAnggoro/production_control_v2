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

//DASHBOARD
$routes->get('/dashboard', 'Dashboard::index');
$routes->get('/dashboard/assy', 'Dashboard::dashboard_lhp_assy');
$routes->post('/dashboard/assy', 'Dashboard::dashboard_lhp_assy');
$routes->post('/dashboard/assy/get_data_line_stop', 'Dashboard::get_data_line_stop');
$routes->post('/dashboard/assy/get_data_line_stop_by_shift', 'Dashboard::get_data_line_stop_by_shift');
$routes->post('/dashboard/assy/get_data_line_stop_by_grup', 'Dashboard::get_data_line_stop_by_grup');
$routes->post('/dashboard/assy/get_data_line_stop_by_kss', 'Dashboard::get_data_line_stop_by_kss');

// DASHBOARD REJECT
$routes->get('/dashboard/reject', 'DashboardAssyRejection::dashboard_reject_assy');
$routes->post('/dashboard/reject', 'DashboardAssyRejection::dashboard_reject_assy');
$routes->post('/dashboard/reject/get_detail_rejection_by_jenis', 'DashboardAssyRejection::get_detail_rejection_by_jenis');

//DASHBOARD EFF GRID
$routes->get('/dashboardGrid', 'DashboardGrid::index');
$routes->get('/dashboardGrid/grid', 'DashboardGrid::dashboard_lhp_grid');
$routes->post('/dashboardGrid/grid', 'DashboardGrid::dashboard_lhp_grid');

//MASTER CYCLE TIME
$routes->group('cycle_time', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'CycleTime::index');
});

//MASTER REJECT
$routes->group('reject', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Reject::index');
    $routes->post('add_reject', 'Reject::add_reject');
    $routes->get('delete_reject/(:num)', 'Reject::delete_reject/$1');
    $routes->post('get_data_reject', 'Reject::get_data_reject');
    $routes->post('update_reject', 'Reject::update_reject');
    $routes->post('add_reject_utama', 'Reject::add_reject_utama');
    $routes->get('delete_reject_utama/(:num)/(:any)', 'Reject::delete_reject_utama/$1/$2');
    $routes->post('get_data_reject_utama', 'Reject::get_data_reject_utama');
    $routes->post('update_reject_utama', 'Reject::update_reject_utama');
});

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
    $routes->get('delete_line_stop/(:num)/(:num)', 'Home::delete_line_stop/$1/$2');
    $routes->get('delete_reject/(:num)/(:num)', 'Home::delete_reject/$1/$2');
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
    $routes->post('get_qty_rak', 'Grid::get_qty_rak');
    $routes->get('get_summary_rework', 'Grid::get_summary_rework');
});

//PLATECUTTING
$routes->group('platecutting', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'PlateCutting::platecutting_view');
    $routes->get('add_platecutting/(:segment)', 'PlateCutting::add_platecutting/$1');
    $routes->post('save', 'PlateCutting::save');
    $routes->get('detail_platecutting/(:segment)', 'PlateCutting::detail_platecutting/$1');
    $routes->post('detail_platecutting/edit', 'PlateCutting::edit');
    $routes->post('detail_platecutting/delete', 'PlateCutting::delete_platecutting');
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
    $routes->post('detail_envelope/delete', 'Envelope::delete_envelope');
    $routes->get('download', 'Envelope::download');
});

//PASTING
$routes->group('pasting', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Pasting::pasting_view');
    $routes->post('add_pasting', 'Pasting::add_pasting');
    $routes->get('delete_pasting/(:num)', 'Pasting::delete_pasting/$1');
    $routes->post('getPartNo', 'Pasting::getPartNo');
    // $routes->post('getCT', 'Pasting::getCT');
    $routes->post('get_jenis_line_stop', 'Pasting::get_jenis_line_stop');
    $routes->post('get_kategori_reject', 'Pasting::get_kategori_reject');
    $routes->post('save_pasting', 'Pasting::save_pasting');
    $routes->get('detail_pasting/(:num)', 'Pasting::detail_pasting/$1');
    $routes->post('update_pasting', 'Pasting::update_pasting');
    $routes->post('get_data_andon', 'Pasting::get_data_andon');
    $routes->post('pilih_andon', 'Pasting::pilih_andon');
    $routes->get('hapus_pasting/(:num)', 'Pasting::hapus_pasting/$1');
    $routes->post('get_qty_rak', 'Pasting::get_qty_rak');
    $routes->post('add_rak_in', 'Pasting::add_rak_in');
    $routes->post('add_rak_out', 'Pasting::add_rak_out');
    $routes->post('delete_rak', 'Pasting::delete_rak');
    $routes->post('delete_rak_out', 'Pasting::delete_rak_out');
});

//MASTER LINE STOP
$routes->group('line_stop', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'LineStop::index');
    $routes->get('detail_line_stop/(:num)', 'LineStop::edit/$1');
    $routes->post('detail_line_stop/edit', 'LineStop::update_data_breakdown');
    $routes->post('detail_line_stop/delete', 'LineStop::delete_data_breakdown');
    $routes->post('add_line_stop', 'LineStop::save');
});

//MASTER REJECT PASTING
$routes->group('reject_pasting', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'RejectPasting::index');
    $routes->get('detail_reject_pasting/(:num)', 'RejectPasting::edit/$1');
    $routes->post('detail_reject_pasting/edit', 'RejectPasting::update_data_reject_pasting');
    $routes->post('detail_reject_pasting/delete', 'RejectPasting::delete_data_reject_pasting');
    $routes->post('add_reject_pasting', 'RejectPasting::save');
});

//MASTER GRUP GRID
$routes->group('grup_grid', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'GrupGrid::index');
    $routes->get('detail_grup_grid/(:num)', 'GrupGrid::edit/$1');
    $routes->post('detail_grup_grid/edit', 'GrupGrid::update_data_grup_grid');
    $routes->post('detail_grup_grid/delete', 'GrupGrid::delete_data_grup_grid');
    $routes->post('add_grup_grid', 'GrupGrid::save');
});

// REWORK GRID
$routes->get('grid_rework/', 'GridRework::dashboard');
$routes->get('grid_rework/(:any)', 'GridRework::mc/$1');
$routes->post('grid_rework/save', 'GridRework::save');
$routes->post('grid_rework/edit', 'GridRework::edit');
$routes->post('grid_rework/delete', 'GridRework::delete');

//SAW REPAIR
$routes->group('saw_repair', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'SawRepair::saw_repair_view');
    $routes->get('add_saw_repair/(:segment)', 'SawRepair::add_saw_repair/$1');
    $routes->post('save', 'SawRepair::save');
    $routes->get('detail_saw_repair/(:segment)', 'SawRepair::detail_saw_repair/$1');
    $routes->post('detail_saw_repair/edit', 'SawRepair::edit');
    $routes->post('detail_saw_repair/delete', 'SawRepair::delete_saw_repair');
    $routes->get('download', 'SawRepair::download');
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
