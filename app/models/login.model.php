<?php

class LoginModel extends Model {

    public $feedbackNegative;

    public function login($userModel) {
        // gets $username and $password
        extract($_POST);

        // sanitises user input
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $return = false;

        // validates username, checks if the user exists and validates password
        if ($error = $this->usernameValidate($username)) {
            $return = true;

        } else if ($error = $this->passwordValidate($password)) {
            $return = true;

        } else if (!$userModel->doesUserExists($username) || !password_verify($password, $userModel->getUserPassword($username))) {
            $error = "user-does-not-exists";
            $return = true;
        }

        // saves the username and the error and returns
        if ($return) {
            $this->feedbackNegative['error'] = $error;
            $this->feedbackNegative['username'] = $username;
            return false;
        }

        // creates the session
        $_SESSION['username'] = $username;

        return true;
    }

    public function logout() {
        session_destroy();
    }

    private function usernameValidate($username) {
        if (empty($username)) {
            return "username-cannot-be-empty";
        }

        return false;
    }

    private function passwordValidate($password) {
        if (empty($password)) {
            return "password-cannot-be-empty";
        }

        return false;
    }
}