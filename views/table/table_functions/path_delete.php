<?php
if (count($_POST) > 0) {
    if (isset($_POST["path_delete"]) && !empty($_POST["path_delete"])) {
        if (file_exists($_POST["path_delete"])) {
            if (is_dir($_POST["path_delete"])) {
                rmdir($_POST["path_delete"]);
            } else {
                unlink($_POST["path_delete"]);
            }
        }      
        $_POST = [];
    }
}