<?php

class MovieController extends Controller {

    public function index($id) {
        // fetches data from the movie model
        $model = $this->model("movie");
        $data = $model->getMovieDetails($id);
        
        $this->view("movie", $data);
    }
}