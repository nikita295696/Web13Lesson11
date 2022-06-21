<?php

const BASE_DIRECTORY = "./uploads";

$files = $_FILES["files"];
$path = $_GET["current_dir"] ?? BASE_DIRECTORY;

foreach ($files["tmp_name"] as $key => $value) {

    if ($path != "undefined") {
        $targetPath = "." . $path . "/" . time() .  "_" . basename($files["name"][$key]);
        move_uploaded_file($value, $targetPath);
    } else {
        $targetPath = "." . BASE_DIRECTORY . "/" . time() .  "_" . basename($files["name"][$key]);
        move_uploaded_file($value, $targetPath);
    }
}
