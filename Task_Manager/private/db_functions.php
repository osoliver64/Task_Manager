<?php

require_once("db_credentials.php");

    function db_connect() {
        $connection = mysqli_connect('localhost', 'appuser', 'password', 'db_task_manager');

        
        if (mysqli_connect_errno()) {
            $msg = "Database connection failed";
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
        
        return $connection;
    }
    function db_disconnect($connection) {
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }
?>