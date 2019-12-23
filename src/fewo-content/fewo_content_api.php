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
    $Aid = utf8_encode($Frow['id']);
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
        $Adescription = utf8_encode($row[1]);
        $Ainfo = utf8_encode($row[2]);
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
        $Akey = utf8_encode($row[0]);
        $Ainfo = utf8_encode($row[1]);
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
        $ApersonCount = utf8_encode($row[0]);
        $ApeakSeason = utf8_encode($row[1]);
        $AoffSeason = utf8_encode($row[2]);
        $Anights = utf8_encode($row[3]);
        $eachDesc = array($ApersonCount, $AoffSeason, $ApeakSeason,$Anights);
        array_push($Fdescription, $eachDesc);
    }
    return $Fdescription;
}

?>