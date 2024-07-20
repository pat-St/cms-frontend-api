<?php
require_once("kachel-models/kachel_models_api.php");
require_once("image/images_api.php");

$path = NULL;
$id = NULL;

if (isset($_GET["path"])) {
    $path = $_GET["path"];
} else {
    http_response_code(400);
    exit();
}

switch ($path) {
    case 'tile':
        if (isset($_GET["id"])) {
            $id = mb_convert_encoding($_GET["id"], 'UTF-8', 'ISO-8859-1');
            getKachelModelsFromId($id);
        } else {
            getKachels();
        }
        break;
    case 'alltile':
        getAllKachelId();
        break;
    case 'image':
        if (isset($_GET["id"])) {
            $id = mb_convert_encoding($_GET["id"], 'UTF-8', 'ISO-8859-1');
            getImagesWithID($id);
        } else {
            getAlImagesDesc();
        }
        break;
    default:
        http_response_code(400);
        echo "unable to find: " . $path;
        break;
}
?>