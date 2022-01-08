<?php

use CodeIgniter\Model;

class SignupModel extends Model {

    /**
     * @var array $feedbackNegative, saves the error and the username on failure
     */
    public $feedbackNegative;

    /**
     * return a user readable formatted error
     *
     * @param string error
     *
     * @return string, the formatted error
     */
    public static function formatError($error) {
        return ucfirst(str_replace("-", " ", $error));
    }

    /**
     * perform the signup action
     *
     * @param $userModel
     *
     * @return bool, success status
     */
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

        // continues only if there are no errors
        if (!$return) {
            // hashes the password
            $password = password_hash($password, PASSWORD_DEFAULT);

            // creates a new row in the db
            if ($this->insertUserToDb($username, $password)) {
                // creates the session
                $_SESSION['username'] = $username;

                return true;
            } else {
                $error = "something-went-wrong";
            }
        }

        // saves the error and the username and returns false
        $this->feedbackNegative['error'] = $error;
        $this->feedbackNegative['username'] = $username;
        return false;
    }

    /**
     * checks if the username is valid
     *
     * @param string $username
     *
     * @return string|false, first on error, false otherwise
     */
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

    /**
     * checks if the password is valid
     *
     * @param string $password
     * @param string $repassword
     *
     * @return string|false, first on error, false otherwise
     */
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
            return "passwords-do-not-match";
        }

        return false;
    }

    /**
     * insert the new user to the database
     *
     * @param string $username
     * @param string $password
     *
     * @return bool, success status
     */
    private function insertUserToDb($username, $password) {
        $sql = "INSERT INTO user (username, password) VALUES (?, ?)";
        if ($this->executeStmt($sql, [$username, $password])) {
            return true;
        }
        return !$this->error = true;
    }
}
