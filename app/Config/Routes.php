<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
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
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
// $routes->group("/", function ($routes) {
//     $routes->get(
//         '',
//         'HomeController::index/popular/1',
//     );


// });

$routes->get(
    '/',
    'HomeController::index/popular/1',
);

$routes->get(
    '/popular/(:alphanum)',
    'HomeController::index/popular/$1',
);

$routes->get(
    '/now_playing/(:alphanum)',
    'HomeController::index/now_playing/$1',
);

$routes->get(
    '/top_rated/(:alphanum)',
    'HomeController::index/top_rated/$1',
);

$routes->get(
    '/upcoming/(:alphanum)',
    'HomeController::index/upcoming/$1',
);

$routes->get(
    '/movie/(:alphanum)',
    'MovieController::index/$1',
);

$routes->group("/search/(:segment)", function ($routes) {
    $routes->get(
        "",
        "HomeController::searchMovie/$1/1"
    );

    $routes->get(
        "(:alphanum)",
        "HomeController::searchMovie/$1/$2"
    );
});

$routes->addRedirect("/popular", "/popular/1");
$routes->addRedirect("/now_playing", "/now_playing/1");
$routes->addRedirect("/top_rated", "/top_rated/1");
$routes->addRedirect("/upcoming", "/upcoming/1");

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
