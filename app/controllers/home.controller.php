<?php

class HomeController extends Controller {

    public function index($filter, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->getMovieList($filter, $page);
        
        $this->view("home", $data);
    }

    public function searchMovie($query, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->searchMovie($query, $page);

        $this->view("home", $data);
    }
}