<?php

class Model extends Dbh {

    /**
    * executes an SQL query
    *
    * @param string $sql, the SQL statement
    * @param array $inParameters, the input parameters
    *
    * @return PDOStatement|false, first in case of success, false otherwise
    */
    protected function executeStmt($sql, $inParameters = []) {
        try {
            $stmt = $this->connect();
            $stmt = $stmt->prepare($sql);
            $stmt->execute($inParameters);
        } catch (PDOException $e) {
            return false;
        }
        return $stmt;
    }
}