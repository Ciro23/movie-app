<?php

class LoginModel extends Mvc\Model {

    /**
     * @var array $feedbackNegative, saves the error and the username on failure
     */
    public $feedbackNegative;

    /**
     * perform the login action
     * @param $userModel
     *
     * @return bool, success status
     */
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
            if ($userModel->error) {
                $error = "something-went-wrong";
            } else {
                $error = "user-does-not-exists";
            }
            $return = true;
        }

        // saves the username and the error and returns false
        if ($return) {
            $this->feedbackNegative['error'] = $error;
            $this->feedbackNegative['username'] = $username;
            return false;
        }

        // creates the session
        $_SESSION['username'] = $username;

        return true;
    }

    /**
     * destroys the current session
     */
    public function logout() {
        session_destroy();
    }

    /**
     * checks if the username is valid
     *
     * @param string $username
     *
     * @return string|false, first on error, false otherwise
     */
    private function usernameValidate($username) {
        if (empty($username)) {
            return "username-cannot-be-empty";
        }

        return false;
    }

    /**
     * checks if the password is valid
     *
     * @param string $username
     *
     * @return string|false, first on error, false otherwise
     */
    private function passwordValidate($password) {
        if (empty($password)) {
            return "password-cannot-be-empty";
        }

        return false;
    }
}
