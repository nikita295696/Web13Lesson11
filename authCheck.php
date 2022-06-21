<?php
include_once "functions.php";

if (count($_POST) > 0 && login($_POST)) {
    $answer = "ok";

} else $answer = "error";

header("Content-Type: application/json");
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST');
header("Access-Control-Allow-Headers: X-Requested-With, Content-Type");
echo json_encode($answer);
