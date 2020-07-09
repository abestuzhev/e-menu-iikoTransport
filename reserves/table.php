<?php
include_once '../core/init.php';



$terminalWithSection = $_SESSION['reserveAllRestaurantSections']["restaurantSections"];
//show_code("all", $_SESSION['reserveAllRestaurantSections']);
$arrSection = array();

foreach ($terminalWithSection as $key => $value){

    $arrSection[$key] = array(
        "name" => $value["name"],
        "id terminal" => $value["id"],
        "id terminalGroupId" => $value["terminalGroupId"],
        "tables" => array()
    );

    foreach ($value["tables"] as $table){

        array_push(
            $arrSection[$key]["tables"],
            $arrSection[$key]["tables"][$table["number"]] = $table["id"]
        );


    }
}

show_code("arrSection", $arrSection);
