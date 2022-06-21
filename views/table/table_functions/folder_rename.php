<?php
if (count($_POST) > 0) {
    if (isset($_POST["to"]) && !empty($_POST["to"])) {
        if (file_exists($_POST["from"])) {
            rename($_POST["from"], ($_POST["to_path"] . $_POST["to"]));
        }
        $_POST = [];
    }
}