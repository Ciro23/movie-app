<?php

class PageNotFoundController extends Mvc\Controller {

    /**
    * shows the page not found page
    */
    public function index() {
        $this->view("pagenotfound");
    }
}