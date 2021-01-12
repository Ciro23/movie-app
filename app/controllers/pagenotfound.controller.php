<?php

class PageNotFoundController extends Controller {

    /**
    * shows the page not found page
    */
    public function index() {
        $this->view("pagenotfound");
    }
}