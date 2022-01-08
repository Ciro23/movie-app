<?php

use App\Controllers\BaseController;

class UserController extends BaseController {

    /**
     * shows the user profile page
     *
     * @param string $username
     */
    public function index($username) {
        // creates the user model
        $userModel = $this->model("user");

        $data = null;

        // checks if the user exists, otherwise shows the 404 page
        if ($userModel->doesUserExists($username, "BINARY")) {
            // gets user data
            $data['username'] = $username;

            // creates the movie model
            $movieModel = $this->model("movie");

            // gets movies details
            $data['watchlist'] = $movieModel->getMoviesFromWatchlist($userModel->getUserWatchlist($username));
        }

        $this->view("user", $data);
    }
}
