<?php
include_once 'config.php';

class Model
{
    protected $mysql;

    public function __construct()
    {
        $this->mysql = $this->dbConnect();
    }

    protected function dbConnect()
    {
        global $dbConfig;
        $conn = new mysqli($dbConfig['servername'], $dbConfig['username'], $dbConfig['password'], $dbConfig['dbname']);

        if ($conn->connect_error) {
            error_log("Connection error: " . $conn->connect_error);
            return null;
        }

        return $conn;
    }

    public function get_data()
    {
    }
}
