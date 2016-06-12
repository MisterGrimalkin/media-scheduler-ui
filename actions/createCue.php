<?php

include("../includes/common.php");

if ( isPost() ) {

    $reloadDate = filter_input(INPUT_POST, "reloadDate");
    $name = filter_input(INPUT_POST, "cueName");
    $method = filter_input(INPUT_POST, "cueMethod");
    $hostStr = filter_input(INPUT_POST, "cueHosts");
    $hosts = explode(";;", $hostStr);
    $hostsList = [];
    foreach ( $hosts as $host ) {
        $hostsList[] = ["ip"=>$host];
    }
    $path = filter_input(INPUT_POST, "cuePath");
    $paramStr = filter_input(INPUT_POST, "cueParams");
    $params = explode(";;", $paramStr);
    $paramsList = [];
    foreach ( $params as $param ) {
        $pair = explode("=", $param);
        $paramsList[] = ["name"=>$pair[0],"value"=>$pair[1]];
    }
    $payload = filter_input(INPUT_POST, "cuePayload");
    $id = filter_input(INPUT_POST, "id");
    if ( !$id ) {
        $id = -1;
    }
    $url = ( $id >= 0 ? "/cue/update" : "/cue/add");

    if ( $name ) {

        $data = json_encode(
                [   "id"=>$id,
                    "name"=>htmlspecialchars($name),
                    "method"=>htmlspecialchars($method),
                    "path"=>$path,
                    "payload"=> htmlspecialchars($payload),
                    "hosts"=>$hostsList,
                    "params"=>$paramsList,
                    "class"=>"HttpCue"
                ]);
        
        $output = post($url, $data);

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