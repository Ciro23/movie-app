<?php

class LoginController extends Controller {
    
    public function index() {
        if (!isset($_SESSION['username'])) {
            $this->view("login");
        } else {
            $this->view("pagenotfound");
        }
    }

    public function login() {
        $loginModel = $this->model("login");
        
        if ($loginModel->login($this->model("user"))) {
            header("Location: /user/" . $_SESSION['username']);
        } else {
            $urlQuery = "error=" . $_SESSION['feedback-negative']['error'] . "&username=" . $_SESSION['feedback-negative']['username'];
            echo $_SESSION['feedback-negative']['error'];
            switch($_SESSION['feedback-negative']['error']) {
                // username error handling
                case "username-empty":
                    header("Location: /login/?" . $urlQuery);
                    break;

                // password error handling
                case "password-empty":
                    header("Location: /login/?" . $urlQuery);
                    break;

                // user doesn't exists
                case "user-does-not-exists":
                    header("Location: /login/?" . $urlQuery);
                    break;
            }
        }
    }

    public function logout() {
        if (isset($_SESSION['username'])) {
            $loginModel = $this->model("login");
            $loginModel->logout();
            header("Location: /");
        } else {
            $this->view("pagenotfound");
        }
    }
}