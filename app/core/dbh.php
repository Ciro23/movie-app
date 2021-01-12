<?php

class Dbh {
    
    /**
    * @var bool $error, is set to true in case of PDO error
    */
    public $error = false;

    /*
    * @vars string, required for the database connection
    */
    private $dbServerName;
    private $dbUsername;
    private $dbPassword;
    private $dbName;
    private $charset;
    
    /**
    * connects to the database
    *
    * @return PDO, the db connection object
    */
    protected function connect() {
        $this->dbServerName = $_ENV['dbServerName'];
        $this->dbUsername = $_ENV['dbUsername'];
        $this->dbPassword = $_ENV['dbPassword'];
        $this->dbName = $_ENV['dbName'];
        $this->charset = $_ENV['charset'];

        $dsn = "mysql:host=" . $this->dbServerName  . ";dbname=" . $this->dbName . ";charset=" . $this->charset;
        try {
            $dbh = new PDO($dsn, $this->dbUsername, $this->dbPassword);
            $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            throw $e;
        }

        return $dbh;
    }
}