<?php

class UserModel extends Model {

    /*
    * gets the user watchlist
    *
    * @param string $username
    *
    * @return array|false, first on success, false otherwise
    */
    protected function getWatchlist($username) {
        $sql = "SELECT movie, addedOn FROM watchlist WHERE user = ?";
        if ($query = $this->executeStmt($sql, [$username])) {
            return $query->fetchAll(PDO::FETCH_ASSOC);
        }
        return !$this->error = true;
    }

    /*
    * checks if the user exists
    *
    * @param string $username
    *
    * @return bool, success status
    */
    public function doesUserExists($username) {
        $sql = "SELECT COUNT(*) FROM user WHERE username = ?";
        if ($query = $this->executeStmt($sql, [$username])) {
            if ($query->fetch(PDO::FETCH_COLUMN) == 1) {
                return true;
            }
            return false;
        }
        return !$this->error = true;
    }

    /*
    * gets the user password
    *
    * @param string $username
    *
    * @return string|false, first on success, false otherwise
    */
    public function getUserPassword($username) {
        $sql = "SELECT password FROM user WHERE username = ?";
        if ($query = $this->executeStmt($sql, [$username])) {
            return $query->fetch(PDO::FETCH_COLUMN);
        }
        return !$this->error = true;
    }
}