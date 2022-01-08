<?php

use App\Controllers\BaseController;

class PageNotFoundController extends BaseController {

    /**
     * shows the page not found page
     */
    public function index() {
        $this->view("pagenotfound");
    }
}
