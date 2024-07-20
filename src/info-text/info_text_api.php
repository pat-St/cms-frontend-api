<?php
require_once(__DIR__."/../util/database_service.php");
require_once(__DIR__."/../image/images_api.php");

function getInfoText($id) {
    $sql_query = "
SELECT InfoTextToTile.id,InfoText.headerText, InfoText.contentText, InfoText.link FROM InfoTextToTile 
LEFT JOIN InfoText ON InfoTextToTile.fk_info = InfoText.id 
WHERE fk_tile=".$id;
    $result = getFromDB($sql_query);
    $returnPayload = array();
    if($result == NULL) {
        return $returnPayload;
    }
    while($Frow = $result->fetch_row()){
        $Iid = (int)$Frow[0];
        $headerText = $Frow[1];//mb_convert_encoding($Frow[1], 'UTF-8', 'ISO-8859-1');
        $contentText = $Frow[2];// mb_convert_encoding($Frow[2], 'UTF-8', 'ISO-8859-1');
        $link = $Frow[3];//mb_convert_encoding($Frow[3], 'UTF-8', 'ISO-8859-1');
        $images=getImagesIdInfo($Iid);
        $infoTextObject = array('id'=>$Iid,'headerText'=>$headerText,'contentText'=>$contentText,'link'=>$link,'images'=>$images);
        array_push($returnPayload,$infoTextObject);
    }
    return $returnPayload;
}
?>