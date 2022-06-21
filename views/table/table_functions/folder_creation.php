<?php
if (count($_POST) > 0) {
    if (isset($_POST["folder_name"]) && !empty($_POST["folder_name"])) {

        $files = array_diff(scandir($_POST["folder_path"]), array('.', '..'));
        $check = 0;
        foreach ($files as $file) {
            if ($file == $_POST["folder_name"]) {
                $check++;
            }
        }
        if ((!file_exists($_POST["folder_path"]) . "/" . ($_POST["folder_name"])) && $check == 0) {
            mkdir(($_POST["folder_path"]) . "/" . ($_POST["folder_name"]), 0777, true);
        } else {
            echo ("Folder already exists");
        }

        if (!file_exists(($_POST["folder_path"]) . "/" . ($_POST["folder_name"]))) {
            mkdir(($_POST["folder_path"]) . "/" . ($_POST["folder_name"]), 0777, true);
        } else {
            session_start();
            $_SESSION["error_msg"] = "Папка с таким именем уже существует";
            session_write_close();
        }

        $_POST = [];
    }
}
