<?php

include("../includes/common.php");

if ( isPost() ) {

    $id = filter_input(INPUT_POST, "id");
    if ( !$id ) {
        $id = -1;
    }
    $url = ( $id >= 0 ? "/schedule/update" : "/schedule/add");

    $date = filter_input(INPUT_POST, "startDate");
    $start = filter_input(INPUT_POST, "startTime");
    $end = filter_input(INPUT_POST, "endTime");
    $cueId = filter_input(INPUT_POST, "cueId");
    $reloadDate = filter_input(INPUT_POST, "reloadDate");

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