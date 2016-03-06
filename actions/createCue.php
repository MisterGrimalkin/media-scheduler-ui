<?php

include("../includes/common.php");

if ( isPost() ) {

    $reloadDate = @$_POST["reloadDate"];
    $number = @$_POST["cueNumber"];
    $name = @$_POST["cueName"];

    if ( $name && $number ) {

        $data = json_encode(
                [   "id"=>-1,
                    "number"=>$number,
                    "name"=>htmlspecialchars($name)
                ]);
        
        $output = post("/cue/create", $data);

        if ( $output!=="Cue created" ) {
            echo errorMessage("Could not create Cue: $output", "../index.php?date=$reloadDate");
        } else {
            header("Location: ../index.php?date=$reloadDate");
        }

    } else {
        echo errorMessage("Invalid data", "../index.php?date=$reloadDate");
    }

} else {
    header("Location: ../index.php");
}