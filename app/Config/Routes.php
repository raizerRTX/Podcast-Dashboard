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
$routes->get('/', 'Home::index');
$routes->post('treeAnalytics', 'DataController::tree_Analytics');
$routes->post('variantAnalytics', 'DataController::pods_Analytics');
$routes->post('combinedTotal', 'DataController::beans_Pod_Data');
$routes->post('beansAnalytics', 'DataController::beans_Analytics');
$routes->post('calendarAnalytics', 'DataController::get_Tree_Analytics');
$routes->post('treeManagement', 'DataController::tree_Management');
$routes->post('widget', 'DataController::refresh_Widget_Data');
$routes->post('forecast', 'DataController::tree_Yield_Forecast');
$routes->post('treeStatus', 'DataController::tree_Status');
$routes->post('generateReport', 'DataController::generate_Report');
$routes->get('getFile', 'DataController::get_File');
$routes->post('forecastGraph', 'DataController::generate_Forecast_Graph');

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