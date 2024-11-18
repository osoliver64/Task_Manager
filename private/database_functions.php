<?php

require_once(db_credentials);

    function db_connect() {
        $connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_NAME);
        if (mysqli_connect_errno()) {
            $msg = "Database connection failed";
            $msg .= " (" . mysqli_connect_errno() . ")";
            exit($msg);
        }
        
        return $connection;

    function db_disconnect($connection) {
        if (isset($connection)) {
            mysqli_close($connection);
        }
    }
}
?>