<?php
require_once(__DIR__ . "/../config/database_config.php");
require_once(__DIR__ . "/../config/header_config.php");

function getFromDB($sql_query)
{
    // connected with database
    $mysqli = mysqli_connect(DB_HOST, DB_USER, DB_PASS, DB_NAME, 3306);
    $mysqli->set_charset('utf-16');

    // check mySQL connection
    if ($mysqli->connect_errno) {
        http_response_code(503);
        return NULL;
    }

    // Check SQL query
    if (!($stmt = $mysqli->query($sql_query))) {
        return NULL;
    }
    // Check closing DB connection
    if (!$mysqli->close()) {
        http_response_code(503);
        return NULL;
    }
    // Check response is not empty
    if (empty($stmt)) {
        http_response_code(503);
        return NULL;
    }
    return $stmt;
}

?>