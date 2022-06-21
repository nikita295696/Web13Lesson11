<?php

include_once "functions.php";

function getFile($attachment_location){
    if (file_exists($attachment_location)) {

        header($_SERVER["SERVER_PROTOCOL"] . " 200 OK");
        header("Cache-Control: public"); // needed for internet explorer
        header("Content-Type: application/zip");
        header("Content-Transfer-Encoding: Binary");
        header("Content-Length:".filesize($attachment_location));
        $baseName = basename($attachment_location);
        header("Content-Disposition: attachment; filename=$baseName");
        readfile($attachment_location);
        die();
    } else {
        die("Error: File not found.");
    }
}

$file = $_GET["file_name"] ?? "";

if(!empty($file) && isAuth()){
    getFile($file);
}