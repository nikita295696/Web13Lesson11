<?php

include_once "functions.php";
// Главная страница с формой и таблицой с содержимым папки uploads
if (!isAuth()) {
    header("Location: auth.php");
}
echo "<div style='text-align: right'><a href='exit.php'>Exit</a></div>";
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./styles/main-styles.css">
    <title>Document</title>
    <style>
        a{
            font-size: 24px;
            display: flex;
            align-items: center;
        }
        p{
            font-size: 24px;
            display: flex;
            align-items: center;
        }
    </style>
</head>

<body>

    <?php
    include_once "views/uploads_form.php";
    include_once "views/table.php";
    ?>
    <script src="./scripts/upload-form.js"></script>
    <script src="./scripts/modal_script.js"></script>

</body>

</html>