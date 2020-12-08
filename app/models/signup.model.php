<?php

class SignupModel extends Model {

    public function signup($userModel) {
        // gets $username, $password and $repassword
        extract($_POST);

        // sanitises user input
        $username = htmlspecialchars($username);
        $password = htmlspecialchars($password);

        $return = false;

        // validates password
        if ($error = $this->validatePassword($password, $repassword)) {
            $return = true;
        }

        // checks if the username is already taken
        if ($error = $userModel->doesUserExists($username)) {
            $error = "username-already-taken";
            $return = true;
        }

        // validates username
        if ($error = $this->validateUsername($username)) {
            $return = true;
        }

        // saves the username and the error and returns
        if ($return) {
            $_SESSION['feedback-negative']['error'] = $error;
            $_SESSION['feedback-negative']['username'] = $username;
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
            return "username-empty";
        }

        if (strlen($username) < 3) {
            return "username-shorter-than-3-characters";
        }

        if (strlen($username) > 20) {
            return "username-longer-than-20-characters";
        }

        if (preg_match("/[^A-Za-z0-9]/", $username)) {
            return "username-contains-special-characters";
        }

        return false;
    }

    private function validatePassword($password, $repassword) {
        if (empty($password)) {
            return "password-empty";
        }
        
        if (strlen($password) < 6) {
            return "password-shorter-than-6-characters";
        }

        if (strlen($password) > 64) {
            return "password-longer-than-64-characters";
        }

        if ($password != $repassword) {
            return "passwords-dont-match";
        }

        return false;
    }

    private function insertUserToDb($username, $password) {
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
        $this->executeStmt($sql, [$username, $password]);
    }
}