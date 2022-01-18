<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MovieModel;

class HomeController extends BaseController {

    /**
     * shows the homepage
     *
     * @param string $filter, the movie filter (popular, top rated...)
     * @param int $page
     */
    public function index($filter, $page) {
        // fetches data from the home model
        $homeModel = new MovieModel();
        $data = $homeModel->getMovieList($filter, $page);

        echo view("home", $data);
    }

    /**
     * searches for movies
     *
     * @param string $query, the search query
     * @param int $page
     */
    public function searchMovie($query, $page) {
        // fetches data from the home model
        $homeModel = new MovieModel();
        $data = $homeModel->searchMovie($query, $page);

        echo view("home", $data);
    }
}
