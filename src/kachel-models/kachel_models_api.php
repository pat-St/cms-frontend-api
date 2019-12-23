<?php
require_once(__DIR__ . "/../util/database_service.php");
require_once(__DIR__ . "/../fewo-content/fewo_content_api.php");
require_once(__DIR__ . "/../image/images_api.php");
require_once(__DIR__ . "/../info-text/info_text_api.php");

header("Content-Type: application/json");

function getKachels()
{
    $sql_query_kachels = "SELECT * FROM Tile";
    $stmt = getFromDB($sql_query_kachels);
    if ($stmt == NULL) {
        exit();
    }
    $stack = array();
    while ($row = $stmt->fetch_row()) {
        $kachelJSON = convertTilePayload($row);
        array_push($stack, $kachelJSON);
    }
    $returnPayload = array("content" => $stack);
    $returnPayload = json_encode($returnPayload);
    echo $returnPayload;
}

function getAllKachelId()
{
    $sql_query_kachels = "SELECT id FROM Tile";
    $stmt = getFromDB($sql_query_kachels);
    if ($stmt == NULL) {
        exit();
    }
    $idList = array();
    while ($row = $stmt->fetch_row()) {
        $id = (string)$row[0];
        array_push($idList, $id);
    }
    echo json_encode($idList);
}

function getKachelModelsFromId($Kid)
{
    $sql_query_kachels = "SELECT * FROM Tile WHERE id='" . $Kid . "';";
    $stmt = getFromDB($sql_query_kachels);
    if ($stmt == NULL) {
        exit();
    }
    $row = $stmt->fetch_row();
    $content = convertTilePayload($row);
    $stack = array("content" => $content);
    $stack = json_encode($stack);
    echo $stack;
}

function convertTilePayload($row)
{
    $id = (string)$row[0];
    $titleName = utf8_encode($row[1]);
    $description = utf8_encode($row[2]);
    $kachelType = (int)$row[3];
    $modalType = (int)$row[4];
    $kachelSize = (int)$row[5];
    $feWoContent = getFeWo($id);
    $infoText = getInfoText($id);
    $images = getImagesIdFromForeign($id, true);
    $kachelJSON = array(
        "id" => $id,
        'titleName' => $titleName,
        'description' => $description,
        'feWoContent' => $feWoContent,
        "infoText" => $infoText,
        'images' => $images,
        'kachelType' => $kachelType,
        'modalType' => $modalType,
        'kachelSize' => $kachelSize
    );
    return $kachelJSON;
}

?>