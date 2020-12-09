<?php

class Controller {

    protected function model($model) {
        require_once __DIR__ . "/../models/" . $model . ".model.php";
        $model .= "model";
        return new $model();
    }

    protected function view($view, $data = []) {
        if ($data === null) {
            // renders the pagenotfound view
            $pagenotfound = new PageNotFoundController;
            $pagenotfound->index();
        } else {
            // renders the wanted view
            require_once __DIR__ . "/../views/" . $view . ".view.php";
        }
    }
}