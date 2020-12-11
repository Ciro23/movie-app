<?php

class UserController extends Controller {

    /*
    * shows the user profile page
    *
    * @param string $username
    */
    public function index($username) {
        // fetches data from user model
        $model = $this->model("user");
        $data['username'] = $username;

        $this->view("user", $data);
    }
}