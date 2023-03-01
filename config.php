<?php
error_reporting(~E_NOTICE);
define('DB_SERVER', 'localhost'); // Hostname
define('DB_USER', 'root'); //Database Username
// define('DB_USER', 'admin@tar'); //Database Username
// define('DB_PASS', 'P@ss1234'); // Database Password
define('DB_PASS', ''); // Database Password
define('DB_NAME', 'db_table'); // Database Name
date_default_timezone_set('Asia/Bangkok');


class Database
{
    // Connect Database
    public function __construct()
    {
        $conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
        $conn->set_charset("utf8");
        $this->dbcon = $conn;

        if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL : " . mysqli_connect_error();
        }
    }
}
