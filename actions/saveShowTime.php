<?php

include("../includes/common.php");

if ( isPost() ) {

    $date = filter_input(INPUT_POST, "date");
    $startTime = filter_input(INPUT_POST, "startTime");
    $endTime = filter_input(INPUT_POST, "endTime");
    $title = filter_input(INPUT_POST, "title");
    $description1 = filter_input(INPUT_POST, "description1");
    $description2 = filter_input(INPUT_POST, "description2");
    $alwaysShow = filter_input(INPUT_POST, "alwaysShow")=="on" ? true : false;
    $alwaysShowOnDay = filter_input(INPUT_POST, "alwaysShowOnDay")=="on" ? true : false;
    $id = filter_input(INPUT_POST, "id");
    
    $data = json_encode(
            ["id"=>$id,
                "date"=>$date,
                "startTime"=>$startTime,
                "endTime"=>$endTime,
                "title"=>$title,
                "description1"=>$description1,
                "description2"=>$description2,
                "alwaysShow"=>$alwaysShow,
                "alwaysShowOnDay"=>$alwaysShowOnDay]);
    
    $output = post("/showtime/update", $data);
   
}
header("Location: ../show-times.php");
