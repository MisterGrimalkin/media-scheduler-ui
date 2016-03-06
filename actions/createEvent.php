<?php

include("../includes/common.php");

if ( isPost() ) {

    $reloadDate = @$_POST["reloadDate"];
    $id = $_POST["id"] ? $_POST["id"] : -1;
    
    $url = ( $id >= 0 ? "/schedule/update" : "/schedule/add");

    $date = $_POST["startDate"];
    $start = $_POST["startTime"];
    $end = $_POST["endTime"];
    $cueId = $_POST["cueId"];

    if ( $date && $start && $end && (cueId >= 0) ) {

        $data = json_encode(
        [   "id"=>$id,
            "startDate"=>$date,
            "startTime"=>$start,
            "endTime"=>$end,
            "cueId"=>$cueId,
            "repeatOn"=>[]
        ]);
        
        $output = post($url, $data);

        if ( $output!=="Event created" ) {
            echo errorMessage("Could not create Event: $output", "../index.php?date=$reloadDate");
        } else {
            header("Location: ../index.php?date=$reloadDate");
        }

    } else {
        echo errorMessage("Invalid data", "../index.php?date=$reloadDate");
    }

} else {
    header("Location: ../index.php");
}