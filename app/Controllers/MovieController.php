<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\MovieModel;

class MovieController extends BaseController {

    /**
     * shows the movie page
     *
     * @param int $id, the movie id
     */
    public function index($id) {
        $movieModel = new MovieModel();
        $data = $movieModel->getMovieDetails($id);

        echo view("movie", $data);
    }

    /**
     * adds a movie to the user watchlist
     *
     * @param int $id, the movie id
     */
    public function addToWatchlist($id) {
        if (isset($_SESSION['username'])) {
            $movieModel = new MovieModel();
            $movieModel->addToWatchlist($id);

            header("Location: /movie/" . $id);
        } else {
            header("Location: /login");
        }
    }

    /**
     * removes a movie from the user watchlist
     *
     * @param int $id, the movie id
     */
    public function removeFromWatchlist($id) {
        if (isset($_SESSION['username'])) {
            $movieModel = new MovieModel();
            $movieModel->removeFromWatchlist($id);

            header("Location: /movie/" . $id);
        } else {
            header("Location: /login");
        }
    }
}
