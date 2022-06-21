<?php
include_once "table/table_functions/folder_creation.php";
include_once "table/table_functions/path_delete.php";
include_once "table/table_functions/folder_rename.php";
$path = "./uploads";
$files = array_diff(scandir($path), array('.', '..'));
$check = false;
if (count($_GET) > 0) {   
    if (isset($_GET["current_dir"]) && !empty($_GET["current_dir"])) {
        $path = $_GET["current_dir"];
        $files = array_diff(scandir($path), array('.'));
        $check = true;
        if ($_GET["current_dir"] == "./uploads") {
            $check = false;
        }
    }
}
$files = array_diff(scandir($path), array('.'));
$currDirectory = [];
foreach ($files as $file) {
    if (is_dir($path . "/" . $file)) {
        if ($file == "..") {
            $pos = strrpos($path, "/");
            $res = mb_strimwidth($path, 0, $pos);
            if ($res !== '.') {
                $currDirectory[] = "<td><a href='?current_dir=$res'><img src='./views/icons/folder.png' alt='folder'> $file</a></td>";
            }
        } else {
            $currDirectory[] = "<td><a href='?current_dir=$path/$file'><img src='./views/icons/folder.png' alt='folder'> $file</a></td>";
        }
    } else {
        $currDirectory[] = "<td><p><img src='./views/icons/file.png' alt='file'> $file</p></td>";
    }
}

if (isset($_SESSION["error_msg"])) {
    echo $_SESSION["error_msg"];
}
?>
<style>
    p{
        display: inline-block;
    }
</style>

<div class="container">
    <div class="table_body">
        <form method="POST">
            <label for="folder_name">Create folder</label>
            <input type="text" name="folder_name">
            <input type="hidden" name="folder_path" value="<?= $path ?>">
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
                    <?= $file ?>
                    <?php if ($check && $files[$key + 1] == "..") {
                        "";
                    } else { ?>
                        <td>
                            <form method="POST">
                                <input type="hidden" name="path_delete" value="<?= $path . "/" . $files[$check ? ($key + 1) : ($key + 2)] ?>">
                                <input type="submit" value="Delete">
                            </form>
                            <button class="rename_modal rename_<?= $key ?>">Rename</button>
                        </td>
                        <?php include "table_rename_modal.php";
                    } ?>
                </tr>
            <?php } ?>
            </tbody>
        </table>
    </div>

</div>

