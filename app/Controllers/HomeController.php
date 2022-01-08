<?php

use App\Controllers\BaseController;

class HomeController extends BaseController {

    /**
     * shows the homepage
     *
     * @param string $filter, the movie filter (popular, top rated...)
     * @param int $page
     */
    public function index($filter, $page) {
        // fetches data from the home model
        $homeModel = $this->model("movie");
        $data = $homeModel->getMovieList($filter, $page);

        $this->view("home", $data);
    }

    /**
     * searches for movies
     *
     * @param string $query, the search query
     * @param int $page
     */
    public function searchMovie($query, $page) {
        // fetches data from the home model
        $homeModel = $this->model("movie");
        $data = $homeModel->searchMovie($query, $page);

        $this->view("home", $data);
    }
}
