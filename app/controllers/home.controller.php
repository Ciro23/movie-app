<?php

class HomeController extends Controller {

    public function index($filter, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->getList($filter, $page);
        
        if ($data == NULL) {
            // renders the pagenotfound view
            $pagenotfound = new PageNotFoundController;
            $pagenotfound->index();
        } else {
            // renders the movie view
            $this->view("home", $data);
        }
    }

    public function search($query, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->search($query, $page);

        if ($data == NULL) {
            // renders the pagenotfound view
            $pagenotfound = new PageNotFoundController;
            $pagenotfound->index();
        } else {
            // renders the movie view
            $this->view("home", $data);
        }
    }
}