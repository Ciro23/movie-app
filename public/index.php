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

session_start();

// creates custom routes
$dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

    // homepage routes
    $r->addRoute("GET", "/[{sort:popular}[/[{page:\d+}[/]]]]", "HomeController/index");
    $r->addRoute("GET", "/{sort:now_playing}[/[{page:\d+}[/]]]", "HomeController/index");
    $r->addRoute("GET", "/{sort:top_rated}[/[{page:\d+}[/]]]", "HomeController/index");
    $r->addRoute("GET", "/{sort:upcoming}[/[{page:\d+}[/]]]", "HomeController/index");

    // search route
    $r->addRoute("GET", "/search/{query}[/[{page:\d+}[/]]]", "HomeController/searchMovie");

    // movie page route
    $r->addRoute("GET", "/movie/{id:\d+}", "MovieController/index");

    // signup, login and logout routes
    $r->addRoute("GET", "/{type:signup}[/[?{error}]]", "SignupController/index");
    $r->addRoute("POST", "/{type:signup}/action[/]", "SignupController/signup");
    $r->addRoute("GET", "/{type:login}[/[?{error}]]", "LoginController/index");
    $r->addRoute("POST", "/{type:login}/action[/]", "LoginController/login");
    $r->addRoute("GET", "/logout[/]", "LoginController/logout");

    // user routes
    $r->addRoute("GET", "/{type:user}[/{user}[/]]", "UserController/index");
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
        
        // gets the controller and the method
        list($controller, $method) = explode("/", $handler);
        
        // makes the sort popular if no one is selected
        if (!isset($vars['sort'])) {
            $vars['sort'] = "popular";
        }

        // makes the page 1 as the default if no one is selected
        if (!isset($vars['page'])) {
            $vars['page'] = "1";
        }
        
        $controller = new $controller();
        call_user_func_array([$controller, $method], $vars);
        break;
}