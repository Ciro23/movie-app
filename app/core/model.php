<?php

class Model extends Dbh {

    protected function executeStmt($sql, $inParameters = []) {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($inParameters);

        return $stmt;
    }
}