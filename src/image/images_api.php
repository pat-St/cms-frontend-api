<?php
require_once(__DIR__ . "/../util/database_service.php");

function getImagesWithID($id)
{
    $desc = $id; //mb_convert_encoding($id, 'UTF-8', 'ISO-8859-1');
//    $desc = str_replace('.webp', "", mb_convert_encoding($desc));
//    $desc = str_replace('.jpg', "", mb_convert_encoding($desc));
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
        $desc = $Irow[0]; //mb_convert_encoding($Irow[0], 'UTF-8', 'ISO-8859-1');
        $desc = preg_replace('/\s/', "_", $desc ); //mb_convert_encoding($desc, 'UTF-8', 'ISO-8859-1'));
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
        $desc = $Irow[0];// mb_convert_encoding($Irow[0], 'UTF-8', 'ISO-8859-1');
        $desc = preg_replace('/\s/', "_", $desc);// mb_convert_encoding($desc, 'UTF-8', 'ISO-8859-1'));
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
        $desc = $Irow[0]; //mb_convert_encoding($Irow[0], 'UTF-8', 'ISO-8859-1');
        $desc = preg_replace('/\s/', "_", $desc); //mb_convert_encoding($desc, 'UTF-8', 'ISO-8859-1'));
        array_push($stack, $desc);
    }
    $payload = array('images' => $stack);
    echo json_encode($payload);
}

?>