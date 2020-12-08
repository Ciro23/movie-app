<?php

class Dbh {
    
    private $dbServerName;
    private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $charset;
    
    protected function connect() {
        $this->dbServerName = $_ENV['dbServerName'];
        $this->dbUsername = $_ENV['dbUsername'];
        $this->dbPassword = $_ENV['dbPassword'];
        $this->dbName = $_ENV['dbName'];
        $this->charset = $_ENV['charset'];

        $dsn = "mysql:host=" . $this->dbServerName  . ";dbname=" . $this->dbName . ";charset=" . $this->charset;
        $dbh = new PDO($dsn, $this->dbUsername, $this->dbPassword);

        return $dbh;
    }
}