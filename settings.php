<?php
include_once "functions.php";
$users = getJSON("users.json");
$error = [];

if (isset($_POST) && !empty($_POST)) {
    foreach ($users as &$user) {
        if ($user["login"] == $_POST["login"] && $user["password"] == md5($_POST["passwordOld"]) ) {
            if (isset($_POST["loginNew"]) && !empty(trim($_POST["loginNew"]))) {
                if (checkLogin($users, $_POST)) {
                    $user["login"] = $_POST["loginNew"];
                } else {
                    $error = ["newLog" => "Такой логин уже существует"];
                }
            } else {
                $user["login"] = $_POST["login"];
            }
            if (isset($_POST["passwordNew"]) && !empty(trim($_POST["passwordNew"])) && $_POST["passwordNew"] == $_POST["passwordConfirm"]) {
                $user["password"] = md5($_POST["passwordNew"]);
            } else if ($_POST["passwordNew"] !== $_POST["passwordConfirm"]) {
                $error = ["confirmPass" => "Проверьте правильность ввода пароля"];
            }
        } else if ($user["login"] == $_POST["login"] && $user["password"] !== md5($_POST["passwordOld"])) {
            $error = ["oldPass" => "Пароль введен не верно"];
        }
    }
    if (count($error) == 0) {
        if (!empty($_POST["loginNew"])) {
            setcookie("login", $_POST["loginNew"], time() + 3600);
        } else {setcookie("login", $_POST["login"], time() + 3600);}
        setJSON($users);
        unset($user);
        header("Location: settings.php");
    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<style>
    .nav {
        text-align: right;
        padding: 0 30px;
    }
    .nav a {
        font-size: 18px;
        color: #2a6a6a;
        font-weight: bold;
    }
    .container {
        max-width: 800px;
        margin: auto;
        text-align: center;
        padding: 30px 0;
    }
    form {
        border: 2px solid teal;
        padding: 30px;
    }
    input, button {
        width: 90%;
        padding: 15px 10px;
        margin-bottom: 15px;
        border: 1px solid teal;
        font-size: 18px;
    }
    input:focus {
        outline: 2px solid orange;
        border: none;
    }
    button {
        width: 93%;
        background-color: white;
        font-size: 20px;
        font-weight: bold;
    }
    .error {
        color: red;
        font-size: 20px;
        text-align: left;
        padding-left: 30px;
    }
</style>
<div class="nav"><a href="index.php">Back to main</a></div>
<div class="container">
    <form id="auth" method="POST">
        <h2>Change login or password</h2>
        <input type="text"  value="<?=$_COOKIE["login"] ?? ""?>" name="login" placeholder="Login"><br>
        <input type="text"  name="loginNew" placeholder="New Login"><br>
        <?php if (count($error) > 0 && !empty($error["newLog"])) {
            echo "<div class='error'><h2>$error[newLog]</h2></div>";
        } ?>
        <input type="password" name="passwordOld" placeholder="Old Password"><br>
        <?php if (count($error) > 0 && !empty($error["oldPass"])) {
            echo "<div class='error'><h2>$error[oldPass]</h2></div>";
        } ?>
        <input type="password" name="passwordNew" placeholder="New Password"><br>
        <input type="password" name="passwordConfirm" placeholder="Confirm Password"><br>
        <?php if (count($error) > 0 && !empty($error["confirmPass"])) {
            echo "<div class='error'><h2>$error[confirmPass]</h2></div>";
        } ?>
        <button type="submit">Change</button>
    </form>
</div>
</body>
</html>
