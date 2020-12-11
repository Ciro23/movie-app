<?php

class HomeController extends Controller {

    /*
    * shows the homepage
    *
    * @param string $filter, the movie filter (popular, top rated...)
    * @param int $page
    */
    public function index($filter, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->getMovieList($filter, $page);
        
        $this->view("home", $data);
    }

    /*
    * searches for movies
    *
    * @param string $query, the search query
    * @param int $page
    */
    public function searchMovie($query, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->searchMovie($query, $page);

        $this->view("home", $data);
    }
}