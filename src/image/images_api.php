<?php
require_once(__DIR__ . "/../util/database_service.php");

function getImagesWithID($id)
{
    $desc = utf8_encode($id);
//    $desc = str_replace('.webp', "", utf8_encode($desc));
//    $desc = str_replace('.jpg', "", utf8_encode($desc));
    $sql_query = "SELECT image FROM Image WHERE description='" . $desc . "';";
    $stmt = getFromDB($sql_query);
    if ($stmt == NULL) {
        exit();
    }
    // Fetch response from database
    if (!$row = $stmt->fetch_assoc()) {
        http_response_code(404);
        return NULL;
    }
    header("Content-Type: image/jpg");
    header("Accept-Ranges: bytes");
    echo $row['image'];
}

function getImagesIdFromForeign($id, $showKachel)
{
    $sql_query = "";
    if ($showKachel) {
        $sql_query = "SELECT description FROM Image WHERE fk_tile='" . $id . "';";
    } else {
        $sql_query = "SELECT description FROM Image WHERE fk_apartment='" . $id . "';";
    }
    $result = getFromDB($sql_query);
    $stack = array();
    while ($Irow = $result->fetch_row()) {
        $desc = utf8_encode($Irow[0]);
        $desc = preg_replace('/\s/', "_", utf8_encode($desc));
        array_push($stack, $desc);
    }
    return $stack;
}

function getImagesIdInfo($id)
{
    $sql_query = "SELECT description FROM Image WHERE fk_info='" . $id . "';";
    $result = getFromDB($sql_query);
    $stack = array();
    while ($Irow = $result->fetch_row()) {
        $desc = utf8_encode($Irow[0]);
        $desc = preg_replace('/\s/', "_", utf8_encode($desc));
        array_push($stack, $desc);
    }
    return $stack;
}

function getAlImagesDesc()
{
    header("Content-Type: application/json");
    $sql_query = "SELECT description FROM Image";
    $result = getFromDB($sql_query);
    if ($result == NULL) {
        exit();
    }
    $stack = array();
    while ($Irow = $result->fetch_row()) {
        $desc = utf8_encode($Irow[0]);
        $desc = preg_replace('/\s/', "_", utf8_encode($desc));
        array_push($stack, $desc);
    }
    $payload = array('images' => $stack);
    echo json_encode($payload);
}

?>