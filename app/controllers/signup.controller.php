<?php

class SignupController extends Controller {

    /**
    * shows the signup form page
    */
    public function index() {
        if (!isset($_SESSION['username'])) {
            // gets the error and the username from the url query
            $data['error'] = $_GET['error'] ?? "";
            $data['username'] = $_GET['username'] ?? "";

            // replaces dashes with spaces and uppercase the first letter
            $data['error'] = SignupModel::formatError($data['error']);

            $this->view("signup", $data);
        } else {
            header("Location: /");
        }
    }

    /**
    * the signup action
    */
    public function signup() {
        $signupModel = $this->model("signup");

        if ($signupModel->signup($this->model("user"))) {
            header("Location: /user/" . $_SESSION['username']);
        } else {
            header("Location: /signup/?error=" . $signupModel->feedbackNegative['error'] . "&username=" . $signupModel->feedbackNegative['username']);
        }
    }
}