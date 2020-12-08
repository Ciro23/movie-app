<?php

class UserModel extends Model {

    protected function getWatchlist($username) {
        $sql = "SELECT movie, addedOn FROM watchlist WHERE user = ?";
        $query = $this->executeStmt($sql, [$username]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function doesUserExists($username) {
        $sql = "SELECT COUNT(*) FROM user WHERE username = ?";
        $query = $this->executeStmt($sql, [$username]);
        if ($query->fetch(PDO::FETCH_COLUMN) == 1) {
            return true;
        }
        return false;
    }

    public function getUserPassword($username) {
        $sql = "SELECT password FROM user WHERE username = ?";
        $query = $this->executeStmt($sql, [$username]);

        return $query->fetch(PDO::FETCH_COLUMN);
    }
}