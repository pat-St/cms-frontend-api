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
            $id = utf8_encode($_GET["id"]);
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
            $id = utf8_encode($_GET["id"]);
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