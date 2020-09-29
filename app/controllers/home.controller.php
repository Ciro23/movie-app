<?php

class HomeController extends Controller {

    private function renderPage($data) {
        if (!$data) {
            // renders the pagenotfound view
            $pagenotfound = new PageNotFoundController;
            $pagenotfound->index();
        } else {
            // renders the home view
            $this->view("home", $data);
        }
    }

    public function index($filter, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->getList($filter, $page);
        
        $this->renderPage($data);
    }

    public function search($query, $page) {
        // fetches data from the home model
        $model = $this->model("movie");
        $data = $model->search($query, $page);

        $this->renderPage($data);
    }
}