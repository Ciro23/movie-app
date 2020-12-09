<?php

class SignupController extends Controller {

    public function index() {
        if (!isset($_SESSION['username'])) {
            // gets the error and the username from the url query
            $data['error'] = $_GET['error'] ?? "";
            $data['username'] = $_GET['username'] ?? "";

            // replaces dashes with spaces and uppercase the first letter
            $data['error'] = ucfirst(str_replace("-", " ", $data['error']));

            $this->view("signup", $data);
        } else {
            header("Location: /");
        }
    }

    public function signup() {
        $signupModel = $this->model("signup");

        if ($signupModel->signup($this->model("user"))) {
            header("Location: /user/" . $_SESSION['username']);
        } else {
            header("Location: /signup/?error=" . $signupModel->feedbackNegative['error'] . "&username=" . $signupModel->feedbackNegative['username']);
        }
    }
}