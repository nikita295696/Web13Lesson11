<?php
// форма загрузки файлов
?>

<form action="?current_dir=<?= $_GET["current_dir"]?>" method="post" enctype="multipart/form-data">
    <input type="hidden" name="current_path" value="<?= $_GET["current_dir"]?>">
</form>
