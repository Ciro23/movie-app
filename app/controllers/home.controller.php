<?php

class HomeController extends Controller {

    public function index($filter, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->getList($filter, $page);
        
        $this->view("home", $data);
    }

    public function search($query, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->search($query, $page);

        $this->view("home", $data);
    }
}