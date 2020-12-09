<?php

class SignupModel extends Model {

    public $feedbackNegative;

    public function signup($userModel) {
        // gets $username, $password and $repassword
        extract($_POST);

        // sanitises user input
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $return = false;

        // validates username, checks if the username is already taken and validates password
        if ($error = $this->validateUsername($username)) {
            $return = true;

        } else if ($userModel->doesUserExists($username)) {
            $error = "username-is-already-taken";
            $return = true;

        } else if ($error = $this->validatePassword($password, $repassword)) {
            $return = true;
        }

        // saves the username and the error and returns
        if ($return) {
            $this->feedbackNegative['error'] = $error;
            $this->feedbackNegative['username'] = $username;
            return false;
        }

        // hashes the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        // creates a new row in the db
        $this->insertUserToDb($username, $password);

        // creates the session
        $_SESSION['username'] = $username;

        return true;
    }

    private function validateUsername($username) {
        if (empty($username)) {
            return "username-cannot-be-empty";
        }

        if (strlen($username) < 3) {
            return "username-must-be-longer-than-3-characters";
        }

        if (strlen($username) > 20) {
            return "username-must-be-shorter-than-20-characters";
        }

        if (preg_match("/[^A-Za-z0-9]/", $username)) {
            return "username-cannot-contains-special-characters";
        }

        return false;
    }

    private function validatePassword($password, $repassword) {
        if (empty($password)) {
            return "password-cannot-be-empty";
        }
        
        if (strlen($password) < 6) {
            return "password-must-be-longer-than-6-characters";
        }

        if (strlen($password) > 64) {
            return "password-must-be-shorter-than-64-characters";
        }

        if ($password != $repassword) {
            return "passwords-does-not-match";
        }

        return false;
    }

    private function insertUserToDb($username, $password) {
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
        $this->executeStmt($sql, [$username, $password]);
    }
}