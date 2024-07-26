<?php 

function callEndpoint($path,?string $id) {
    $id = NULL;
    if (isset($id)) {
        $id = mb_convert_encoding($id, 'UTF-8', 'ISO-8859-1');
    }
    switch ($path) {
        case 'tile':
            if (isset($id)) {
                getKachelModelsFromId($id);
            } else {
                getKachels();
            }
            break;
        case 'alltile':
            getAllKachelId();
            break;
        case 'image':
            if (isset($id)) {
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
}


?>