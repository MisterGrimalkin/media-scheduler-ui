<?php

define("URL", "http://192.168.0.123:8001/mediascheduler");

function getBrightness() {
    return get("/control/brightness");
}

function getContrast() {
    return get("/control/contrast");
}

function getSchedule($date) {
    $dateStr = $date->format("Y-m-d");
    $output = get("/schedule?date=$dateStr");
    return json_decode($output, true);
}

function getCues() {
    $result = [];
    $output = get("/cue");
    if ( $output !== false ) {
        $cues = json_decode($output, true);
        if ( count($cues)>0 ) {
            foreach($cues as $cue) {
                $result[$cue["id"]] = $cue;
            }
        }
    }
    return $result;
}

function get($url) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, URL.$url);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, "GET");
    $output = curl_exec($c);
    curl_close($c);
    return $output;
}

function errorMessage($message, $redirect) {
    return "<script>
                window.alert('$message');
                window.location.assign('$redirect');
            </script>";
}
