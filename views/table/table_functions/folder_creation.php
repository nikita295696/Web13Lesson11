<?php
if (count($_POST) > 0) {
    if (isset($_POST["folder_name"]) && !empty($_POST["folder_name"])) {
        if (!file_exists(($_POST["folder_path"]) . "/" . ($_POST["folder_name"]))) {
            mkdir(($_POST["folder_path"]) . "/" . ($_POST["folder_name"]), 0777, true);
        } else {
            session_start();
            $_SESSION["error_msg"] = "Папка с таким именем уже существует";
            session_write_close();
        }
    }
}
