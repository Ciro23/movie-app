<?php

class Router {
    
    // default vars for the homepage
    protected $controller = "home";
    protected $method = "index";
    protected $args = [];

    public function parseUrl() {
        return explode("/", filter_var(trim($_SERVER['REQUEST_URI'], "/"), FILTER_SANITIZE_URL));
    }

    public function arrayToLower($array) {
        for ($i = 0; $i < count($array); $i++) {
            $array[$i] = strtolower($array[$i]);
        }
        return $array;
    }

    public function route() {
        $url = $this->parseUrl();
        $url = $this->arrayToLower($url);

        // checks if a controller with the same name of the first element exists
        if (isset($url[0]) && $url[0] != "") {
            if (file_exists(__DIR__ . "/../controllers/" . $url[0] . ".controller.php") && $url[0] != "home") {
                $this->controller = $url[0];
            } else {
                $this->controller = "pagenotfound";
            }
        }

        // requires the controller
        require_once __DIR__ . "/../controllers/" . $this->controller . ".controller.php";

        // creates the object of the controller class
        $this->controller .= "controller";
        $this->controller = new $this->controller;
        
        // checks if a method with the same name of the second element exists
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1]) && $url[1] != "index") {
                $this->method = $url[1];
            } else {
                // requires the "page not found" controller and creates the object
                $this->controller = "pagenotfound";
                require_once __DIR__ . "/../controllers/" . $this->controller . ".controller.php";
                $this->controller .= "controller";
                $this->controller = new $this->controller;
            }
        }

        // removes the controller and the method from the url and puts only the args in the var
        unset($url[0]);
        unset($url[1]);
        $this->args = array_values($url);

        // executes the method
        call_user_func_array([$this->controller, $this->method], $this->args);
    }
}