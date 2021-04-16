<?php

class DB {

    private $mysqli;

    public function __construct($hostname, $username, $password, $database, $charset, $port = '3306') {
        $this->mysqli = new mysqli($hostname, $username, $password, $database, $port);

        if ($this->mysqli->connect_error) {
            die('Error: ' . $this->mysqli->connect_error . '<br />Error No: ' . $this->mysqli->connect_errno);
        }

        $this->mysqli->set_charset($charset);
    }

    public function query($sql) {
        return $this->mysqli->query($sql);
    }

    public function escape($value) {
        return $this->mysqli->real_escape_string($value);
    }

    public function getLastId() {
        return $this->mysqli->insert_id;
    }

    public function __destruct() {
        $this->mysqli->close();
    }

}