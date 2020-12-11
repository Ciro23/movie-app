<?php

class MovieController extends Controller {

    /*
    * shows the movie page
    *
    * @param int $id, the movie id
    */
    public function index($id) {
        // fetches data from the movie model
        $model = $this->model("movie");
        $data = $model->getMovieDetails($id);
        
        $this->view("movie", $data);
    }

    /*
    * adds a movie to the user watchlist
    *
    * @param int $id, the movie id
    */
    public function addToWatchlist($id) {
        if (isset($_SESSION['username'])) {
            $model = $this->model("movie");
            $model->addToWatchlist($id);
            header("Location: /movie/" . $id);
        } else {
            header("Location: /login");
        }
    }

    /*
    * removes a movie from the user watchlist
    *
    * @param int $id, the movie id
    */
    public function removeFromWatchlist($id) {
        if (isset($_SESSION['username'])) {
            $model = $this->model("movie");
            $model->removeFromWatchlist($id);
            header("Location: /movie/" . $id);
        } else {
            header("Location: /login");
        }
    }
}