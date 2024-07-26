<?php
require_once("kachel-models/kachel_models_api.php");
require_once("image/images_api.php");
require_once("util/endpoint.php");

if (isset($_GET["path"])) {
    callEndpoint($_GET["path"],$_GET["id"]);
} else {
    http_response_code(400);
    exit();
}
?>