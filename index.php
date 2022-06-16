<?php

include_once "functions.php";
// Главная страница с формой и таблицой с содержимым папки uploads
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./styles/main-styles.css">
    <title>Document</title>
</head>

<body>

    <?php
    include_once "views/uploads_form.php";
    include_once "views/table.php";
    ?>
    <script src="./scripts/upload-form.js"></script>
</body>

</html>