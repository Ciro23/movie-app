<?php

class MovieController extends Controller {

    public function index($id) {
        
        // fetches data from the movie model
        $model = $this->model("movie");
        $data = $model->getMovieDetails($id);
        
        if ($data == NULL) {
            // renders the pagenotfound view
            $pagenotfound = new PageNotFoundController;
            $pagenotfound->index();
        } else {
            // renders the movie view
            $this->view("movie", $data);
        }
    }
}