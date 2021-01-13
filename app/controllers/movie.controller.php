<?php

class MovieController extends Mvc\Controller {

    /**
    * shows the movie page
    *
    * @param int $id, the movie id
    */
    public function index($id) {
        // fetches data from the movie model
        $movieModel = $this->model("movie");
        $data = $movieModel->getMovieDetails($id);
        
        $this->view("movie", $data);
    }

    /**
    * adds a movie to the user watchlist
    *
    * @param int $id, the movie id
    */
    public function addToWatchlist($id) {
        if (isset($_SESSION['username'])) {
            $movieModel = $this->model("movie");
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
            $movieModel = $this->model("movie");
            $movieModel->removeFromWatchlist($id);
            
            header("Location: /movie/" . $id);
        } else {
            header("Location: /login");
        }
    }
}