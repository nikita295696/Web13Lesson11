<?php
include_once "table_functions/folder_creation.php";
include_once "table_functions/path_delete.php";
$path = "./uploads";
if (count($_GET) > 0) {   
    if (isset($_GET["current_dir"]) && !empty($_GET["current_dir"])) {
        $path = $_GET["current_dir"];
    }
}
$files = array_diff(scandir($path), array('.'));
$currDirectory = [];
foreach ($files as $file) {
    if (is_dir($path . "/" . $file)) {
        if ($file == "..") {
            $currDirectory[] = "<td><a href='javascript:history.go(-1)'><img src='./views/icons/folder.png' alt='folder'> $file</a></td>";
        } else {
            $currDirectory[] = "<td><a href='?current_dir=$path/$file'><img src='./views/icons/folder.png' alt='folder'> $file</a></td>";
        }       
    } else {
        $currDirectory[] = "<td><p><img src='./views/icons/file.png' alt='file'> $file</p></td>";
    }
}
?>
<form method="POST">
    <input type="text" name="folder_name">
    <input type="hidden" name="folder_path" value="<?=$path?>">
    <input type="submit" value="Create">
</form>

<table>
    <thead>
        <tr>
            <th>name</th>
            <th>operation</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($currDirectory as $key => $file) { ?>
            <tr>
                <a href="<?= $file?>" download><?= $file?></a>
                <td><form method="POST"><input type="hidden" name="path_delete" value="<?=$path . "/" . $files[$key + 1]?>"><input type="submit" value="Delete"></form></td>
            </tr>
        <?php } ?>
    </tbody>
</table>