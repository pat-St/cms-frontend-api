<?php
require_once(__DIR__ . "/../util/database_service.php");
require_once(__DIR__ . "/../image/images_api.php");

function getFeWo($id)
{
    if ($id == NULL) {
        return "null";
    }
    $sql_query = "SELECT id FROM ApartmentContent WHERE fk_tile='" . $id . "';";
    $result = getFromDB($sql_query);
    $Frow = $result->fetch_assoc();
    if ($Frow == null || count($Frow) == 0) {
        return NULL;
    }
    $Aid = $Frow['id']; //mb_convert_encoding($Frow['id'], 'UTF-8', 'ISO-8859-1');
    $Fdescription = getApartmentDescription($Aid);
    $Fdetails = getApartmentDetails($Aid);
    $Fprice = getApartmentPrice($Aid);
    $images = getImagesIdFromForeign($Aid, false);
    $ApartmentObject = array('description' => $Fdescription, 'details' => $Fdetails, 'price' => $Fprice, 'images' => $images);
    return $ApartmentObject;
}

function getApartmentDescription($id)
{
    if ($id == NULL) {
        return NULL;
    }
    $sql_query = "SELECT * FROM ApartmentDescription WHERE fk_apartment=" . $id . ";";
    $result = getFromDB($sql_query);
    $Fdescription = array();
    while ($row = $result->fetch_row()) {
        $Adescription = $row[1];//mb_convert_encoding($row[1], 'UTF-8', 'ISO-8859-1');
        $Ainfo = $row[2];//mb_convert_encoding($row[2], 'UTF-8', 'ISO-8859-1');
        $eachDesc = array($Adescription, $Ainfo);
        array_push($Fdescription, $eachDesc);
    }
    return $Fdescription;
}

function getApartmentDetails($id)
{
    if ($id == NULL) {
        return NULL;
    }
    $sql_query = "
SELECT identifier,info FROM DetailsToApartment
LEFT JOIN ApartmentDetails ON DetailsToApartment.fk_details = ApartmentDetails.ID
WHERE fk_apartment=" . $id . ";";
    $result = getFromDB($sql_query);
    $Fdescription = array();
    while ($row = $result->fetch_row()) {
        $Akey = $row[0];//mb_convert_encoding($row[0], 'UTF-8', 'ISO-8859-1');
        $Ainfo =$row[1];// mb_convert_encoding($row[1], 'UTF-8', 'ISO-8859-1');
        if ($Ainfo == "true") {
            $Ainfo = true;
        } else {
            $Ainfoe = false;
        }
        $eachDesc = array($Akey, $Ainfo);
        array_push($Fdescription, $eachDesc);
    }
    return $Fdescription;
}

function getApartmentPrice($id)
{
    if ($id == NULL) {
        return NULL;
    }
    $sql_query = "SELECT personCount,peakSeason,offSeason,nights FROM ApartmentPrice WHERE fk_apartment=" . $id . ";";
    $result = getFromDB($sql_query);
    $Fdescription = array();
    while ($row = $result->fetch_row()) {
        $ApersonCount = $row[0];//mb_convert_encoding($row[0], 'UTF-8', 'ISO-8859-1');
        $ApeakSeason = $row[1];// mb_convert_encoding($row[1], 'UTF-8', 'ISO-8859-1');
        $AoffSeason = $row[2]; //mb_convert_encoding($row[2], 'UTF-8', 'ISO-8859-1');
        $Anights = $row[3]; //mb_convert_encoding($row[3], 'UTF-8', 'ISO-8859-1');
        $eachDesc = array($ApersonCount, $AoffSeason, $ApeakSeason,$Anights);
        array_push($Fdescription, $eachDesc);
    }
    return $Fdescription;
}

?>