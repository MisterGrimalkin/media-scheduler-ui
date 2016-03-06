<?php

include("../includes/common.php");

if ( isPost() ) {

    $id = file_get_contents("php://input");

    if ( $id > -1 ) {

        $output = post("/schedule/remove", $id);

        if ( $output!=="Event removed" ) {
            echo errorMessage("Could not remove event: $output", "../index.php");
        } else {
            header("Location: ../");
        }

    } else {
        header("Location: ../");
    }

} else {
   header("Location: ../");
}