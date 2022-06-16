<?php
function isAuth(){
    return isset($_COOKIE["login"]) && !empty($_COOKIE["login"]);
}
function getJSON($fileName){
    $strJSON = "[]";
    if(file_exists($fileName)){
        $strJSON = file_get_contents($fileName);
    }

    return json_decode($strJSON, true);
}
function clean($value = "") {
    $value = trim($value);
    $value = stripslashes($value);
    $value = strip_tags($value);

    return $value;
}
function login($users){
    $login = clean($users["login"]);
    $password = md5(clean($users["password"]));

    $users = getJSON("users.json");

    foreach ($users as $user){
        if($user["login"] == $login && $user["password"] == $password){
           setcookie("login", $user["login"], time() + 3600);
            return true;
        }
    }

    return false;
}