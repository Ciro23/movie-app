<?php

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
    $r->addRoute("GET", "/movie/{id:\d+}[/]", "MovieController/index");
    $r->addRoute("POST", "/movie/{id:\d+}/add-to-watchlist[/]", "MovieController/addToWatchlist");
    $r->addRoute("POST", "/movie/{id:\d+}/remove-from-watchlist[/]", "MovieController/removeFromWatchlist");

    // signup, login and logout routes
    $r->addRoute("GET", "/{type:signup}[/[?{error}]]", "SignupController/index");
    $r->addRoute("POST", "/{type:signup}/action[/]", "SignupController/signup");
    $r->addRoute("GET", "/{type:login}[/[?{error}]]", "LoginController/index");
    $r->addRoute("POST", "/{type:login}/action[/]", "LoginController/login");
    $r->addRoute("GET", "/logout[/]", "LoginController/logout");

    // user routes
    $r->addRoute("GET", "/user/{user}[/]", "UserController/index");
});