<?php
if (count($_POST) > 0) {
    if (isset($_POST["folder_name"]) && !empty($_POST["folder_name"])) {
        if (!file_exists($_POST["folder_path"]) . "/" . ($_POST["folder_name"])) {
            mkdir(($_POST["folder_path"]) . "/" . ($_POST["folder_name"]), 0777, true);
        }      
        $_POST = [];
    }
}