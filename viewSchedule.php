<?php $date=filter_input(INPUT_GET, "date") ? filter_input(INPUT_GET, "date") : date("Y-m-d"); ?>

<html>

<?php
    include("includes/common.php");
    include("includes/wrapper.php");
    include("includes/header.html");
    define("WIDTH", filter_input(INPUT_GET, "width") ? intval(filter_input(INPUT_GET, "width")) : 1000);
    define("HEIGHT", filter_input(INPUT_GET, "height") ? intval(filter_input(INPUT_GET, "height")) : 800);
?>

<body>

<div style="margin: 0px; width: <?php echo WIDTH; ?>; height: <?php echo HEIGHT; ?>;">

<?php

$dayWidth = round(WIDTH / 7) - 16;

buildSchedule();

function buildSchedule() {

    global $date, $dayWidth;
    
    $fullWidth = ($dayWidth * 7) + 16;

    $cues = getCues();
    
    echo wrap("script", [], "url = '".URL."';");
    
    echo wrapStart("div",
        ["style"=>"width: {$fullWidth}px; height: ".HEIGHT."px; background: none; border: none;"]);
    
    echo buildHourGrid();
    
    $panelDate = new DateTime($date);
    for ( $i = 0; $i < 7; $i++ ) {
        echo wrap("div",
            ["class"=>"dayPanel",
                "style"=>"width: $dayWidth; height: ".HEIGHT.";"], 
                buildDay($panelDate, $cues)
                );
        $panelDate->modify("+1 day");
    }
    
    echo wrapEnd("div");
}

function buildHourGrid() {
    global $dayWidth;

    $result = "";

    $width = ($dayWidth * 7) + 13;

    $headerHeight = 20;
    $adjustedHeaderHeight = $headerHeight + 10;
    $columnHeight = HEIGHT - $adjustedHeaderHeight;

    $hourHeight = round($columnHeight / 24) - 0.5;
    for ( $i=0; $i<24; $i++ ) {
        $top = $adjustedHeaderHeight + ($i * $hourHeight);
        $label = "&nbsp;".str_pad(strval($i), 2, "0", STR_PAD_LEFT).":00";
        $result .= wrap("div", [
            "class"=>"hourMarker", 
            "style"=>"width: $width; top: $top;"],"$label");
    }
    
    return $result;
}

function buildDay($date, $cues) {

    global $dayWidth;

    $result = "";

    $width = ($dayWidth * 7) + 13;

    $headerHeight = 20;
    $adjustedHeaderHeight = $headerHeight + 10;
    $columnHeight = HEIGHT - $adjustedHeaderHeight;

    // Column Headers
    $weekday = $date->format("w");
    $style = "dayPanelHeader" . ($weekday==0 || $weekday==6 ? " weekend" : "" );
    $result .= wrap("div",
        ["class"=>$style, "style"=>"height: $headerHeight" ],
        $date->format("D d M"));
    
    // Column
    $result .= wrap("div", ["class"=>"dayPanel","style"=>"width: $dayWidth; height: $columnHeight; border-radius: 0px 0px 5px 5px;"],"");

    $today = ( $date->format("Y-m-d") === (new DateTime())->format("Y-m-d") );

    $containerTop = $adjustedHeaderHeight;
    $containerHeight = $columnHeight;


    $startOfDay = new DateTime((new DateTime())->format("Y-m-d"));
    $startOfDayTimeStamp = $startOfDay->getTimeStamp();

    // Now Marker

    $today = ( $date->format("Y-m-d") === (new DateTime())->format("Y-m-d") );
    if ( $today ) {
        $nowTimeStamp = (new DateTime())->getTimestamp();
        $now = $nowTimeStamp - $startOfDayTimeStamp;
        $top = (( ($containerHeight / (24 * 60 * 60)) ) * $now) + $containerTop;
        $result .= wrap("div",
            ["id"=>"nowMarker", "class"=>"nowMarker", "style"=>"top: {$top}px; width: {$dayWidth}px;"], "");
    }

    $events = getSchedule($date);

    if ( $events ) {

        foreach ($events as $event) {

            $startTime = new DateTime($event["startTime"]);
            $endTime = new DateTime($event["endTime"]);

            $startHour = 2;


            $startTimeStamp = $startTime->getTimestamp();
            $endTimeStamp = $endTime->getTimestamp();


            $start = $startTimeStamp - $startOfDayTimeStamp;
            $length = $endTimeStamp - $startTimeStamp;

            $name = $cues[$event["cueId"]];

            $top = (( $containerHeight / (24 * 60 * 60) ) * $start) + $containerTop;
            //echo "$length , $start    ";
            $height = ( $containerHeight / (24 * 60 * 60) ) * $length;

            $id = "event".$event["id"];

            $secondClass = "eventOnCue" . $event["cueId"];

            //$startTime = strtotime($event["startTime"]);
            error_log($event["id"]);
            $result .= wrap("div",
                ["id"=>$id,
                 "onclick"=>"selectEvent({$event["id"]}, true);",
                 "ondblclick"=>"editEvent({$event["id"]}, parent.document);",
                "class"=>"event $secondClass $id",
                "style"=>"top: {$top}px; height: {$height}px; width: {$dayWidth};"],
                $cues[$event["cueId"]]["name"]." (".$startTime->format("H:i")."-".$endTime->format("H:i").")");
        }

    }


    return $result;
}

?>

</div>

</body>

</html>