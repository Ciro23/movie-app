<?php

class LoginModel extends Model {

    public function login($userModel) {
        // gets $username and $password
        extract($_POST);

        // sanitises user input
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $return = false;

        // checks if the user exists
        if (!$userModel->doesUserExists($username) && $password != $userModel->getUserPassword($username)) {
            $error = "user-does-not-exists";
            $return = true;
        }

        // validates password
        if ($error = $this->passwordValidate($password)) {
            $return = true;
        }

        // validates username
        if ($error = $this->usernameValidate($username)) {
            $return = true;
        }

        // saves the username and the error and returns
        if ($return) {
            $_SESSION['feedback-negative']['error'] = $error;
            $_SESSION['feedback-negative']['username'] = $username;
            return false;
        }

        // creates the session
        $_SESSION['username'] = $username;
    }

    public function logout() {
        session_destroy();
    }

    private function usernameValidate($username) {
        if (empty($username)) {
            return "username-empty";
        }

        return false;
    }

    private function passwordValidate($password) {
        if (empty($password)) {
            return "password-empty";
        }

        return false;
    }
}