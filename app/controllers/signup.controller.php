<?php

class SignupController extends Controller {

    public function index() {
        if (!isset($_SESSION['username'])) {
            $this->view("signup");
        } else {
            $this->view("pagenotfound");
        }
    }

    public function signup() {
        $signupModel = $this->model("signup");

        if ($signupModel->signup($this->model("user"))) {
            header("Location: /user/" . $_SESSION['username']);
        } else {
            $urlQuery = "error=" . $_SESSION['feedback-negative']['error'] . "&username=" . $_SESSION['feedback-negative']['username'];

            switch($_SESSION['feedback-negative']['error']) {
                // username error handling
                case "username-empty":
                    header("Location: /signup/?" . $urlQuery);
                    break;
                    
                case "username-shorter-than-3-characters":
                    header("Location: /signup/?" . $urlQuery);
                    break;

                case "username-longer-than-20-characters":
                    header("Location: /signup/?" . $urlQuery);
                    break;

                case "username-contains-special-characters":
                    header("Location: /signup/?" . $urlQuery);
                    break;
                
                case "username-already-taken":
                    header("Location: /signup/?" . $urlQuery);
                    break;

                // password error handling
                case "password-empty":
                    header("Location: /signup/?" . $urlQuery);
                    break;
                    
                case "password-shorter-than-6-characters":
                    header("Location: /signup/?" . $urlQuery);
                    break;

                case "password-longer-than-64-characters":
                    header("Location: /signup/?" . $urlQuery);
                    break;

                case "passwords-dont-match":
                    header("Location: /signup/?" . $urlQuery);
                    break;
            }
        }
    }
}