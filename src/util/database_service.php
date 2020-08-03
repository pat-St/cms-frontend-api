<?php
require_once(__DIR__ . "/../config/header_config.php");

function getFromDB($sql_query)
{
    // variable for db credentials
    static $config;
    if(!isset($config)) {
        $config = parse_ini_file(__DIR__ . '/../../private/config.ini');
        if(empty($config)) {
            http_response_code(503);
            return NULL;
        }
    }
    
    // connected with database
    $mysqli = mysqli_connect($config['db_host'], $config['db_user'], $config['db_pass'], $config['db_name'], 3306);
    $mysqli->set_charset('utf-8');

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