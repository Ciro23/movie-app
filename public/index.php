<?php

// composer autoload
require_once __DIR__ . "/../vendor/autoload.php";

// saves the env vars in the $_ENV superglobal
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . "/../");
$dotenv->load();

// sets the default language if no one is selected
if (!isset($_COOKIE['language'])) {
    $_COOKIE['language'] = "us";
}

// creates custom routes
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    // homepage routes
    $r->addRoute("GET", "/", "HomeController/popular");
    $r->addRoute("GET", "/{sort:popular}", "HomeController/popular");
    $r->addRoute("GET", "/{sort:now_playing}", "HomeController/now_playing");
    $r->addRoute("GET", "/{sort:top_rated}", "HomeController/top_rated");
    $r->addRoute("GET", "/{sort:upcoming}", "HomeController/upcoming");
    $r->addRoute("GET", "/{sort:popular}/[{page:\d+}]", "HomeController/popular");
    $r->addRoute("GET", "/{sort:now_playing}/[{page:\d+}]", "HomeController/now_playing");
    $r->addRoute("GET", "/{sort:top_rated}/[{page:\d+}]", "HomeController/top_rated");
    $r->addRoute("GET", "/{sort:upcoming}/[{page:\d+}]", "HomeController/upcoming");

    // search route
    $r->addRoute("GET", "/search/{query}[/{page:\d+}]", "HomeController/search");

    // movie page route
    $r->addRoute("GET", "/movie/{id:\d+}", "MovieController/movie");
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);
switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        echo "page not found";
        break;

    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        echo "forbidden";
        break;

    case FastRoute\Dispatcher::FOUND:        
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        
        // makes the filter popular if no one is selected
        if (!isset($vars['filter'])) {
            $vars['filter'] = "popular";
        }

        // makes the page 1 as the default if no one is selected
        if (!isset($vars['page'])) {
            $vars['page'] = "1";
        }
        
        // gets the controller name
        $handlers = explode("/", $handler);
        $controller = new $handlers[0];
        
        if ($handlers[1] == "search") {
            $method = "search";
        } else {
            $method = "index";
        }

        call_user_func_array([$controller, $method], $vars);
        break;
}