<?php

class Model extends Dbh {
    
    protected function executeStmt($sql, $inParameters, $fetch = false) {
        $stmt = $this->connect()->prepare($sql);
        $stmt->execute($inParameters);

        if ($fetch) {
            return $stmt->fetchAll();
        }
    }
}