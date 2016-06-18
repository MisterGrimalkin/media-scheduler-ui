<?php

define("URL", "http://192.168.1.123:8001/scheduler");

function getBrightness() {
    return get("/control/brightness");
}

function getContrast() {
    return get("/control/contrast");
}

function getShowerMessages() {
    $output = get("/showers/messages");
    return json_decode($output, true);
}

function getScrollerMessages() {
    $output = get("/scroller/messages");
    return json_decode($output, true);
}

function getShowTimes() {
    $output = get("/showtimes");
    return json_decode($output, true);
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
        $cues = json_decode($output, true)["cues"];
        if ( count($cues)>0 ) {
            foreach($cues as $cue) {
                $result[$cue["id"]] = $cue;
            }
        }
    }
    return $result;
}

function isPost() {
    return $_SERVER["REQUEST_METHOD"]==="POST";
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

function post($url, $data) {
    $c = curl_init();
    curl_setopt($c, CURLOPT_URL, URL.$url);
    curl_setopt($c, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($c, CURLOPT_POSTFIELDS, $data);
    curl_setopt($c, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($c, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data))
    );
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