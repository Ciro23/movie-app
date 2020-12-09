<?php

class LoginController extends Controller {

    public function index() {
        if (!isset($_SESSION['username'])) {
            // gets the error and the username from the url query
            $data['error'] = $_GET['error'] ?? "";
            $data['username'] = $_GET['username'] ?? "";

            // replaces dashes with spaces and uppercase the first letter
            $data['error'] = ucfirst(str_replace("-", " ", $data['error']));

            $this->view("login", $data);
        } else {
            header("Location: /");
        }
    }

    public function login() {
        $loginModel = $this->model("login");

        if ($loginModel->login($this->model("user"))) {
            header("Location: /user/" . $_SESSION['username']);
        } else {
            header("Location: /login/?error=" . $loginModel->feedbackNegative['error'] . "&username=" . $loginModel->feedbackNegative['username']);
        }
    }

    public function logout() {
        if (isset($_SESSION['username'])) {
            $loginModel = $this->model("login");
            $loginModel->logout();
        }
        header("Location: /");
    }
}