<?php
require_once(__DIR__ . "/../util/database_service.php");
require_once(__DIR__ . "/../fewo-content/fewo_content_api.php");
require_once(__DIR__ . "/../image/images_api.php");
require_once(__DIR__ . "/../info-text/info_text_api.php");

header("Content-Type: application/json");

function getKachels()
{
    $sql_query_kachels = "
SELECT t.ID, t.titleName, t.description, t.kachelType, t.modalType, t.tileSizeType, o.seqNum 
FROM Tile t, TileOrder o 
WHERE t.ID = o.fk_tile";
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
    $sql_query_kachels = "
SELECT t.ID, t.titleName, t.description, t.kachelType, t.modalType, t.tileSizeType, o.seqNum 
FROM Tile t, TileOrder o 
WHERE t.id='" . $Kid . "' 
AND t.ID = o.fk_tile;";
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
    $tileSizeType = (int)$row[5];
    $seqNum = (int)$row[6];
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
        'tileSizeType' => $tileSizeType,
        'seqNum' => $seqNum
    );
    return $kachelJSON;
}

?>