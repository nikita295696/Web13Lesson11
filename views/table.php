
<?php
include_once "table_functions/folder_creation.php";
include_once "table_functions/path_delete.php";
$path = "../uploads";
if (count($_GET) > 0) {   
    if (isset($_GET["current_dir"]) && !empty($_GET["current_dir"])) {
        $path = $_GET["current_dir"];
    }
}
$files = array_diff(scandir($path), array('.'));
$currDirectory = [];
echo "<select><option>Copy file</option>/><option>Delete file</option>/></select> <button onClick='Cheking()'>GO</button>";
$listOfChekedElements = [];
foreach ($files as $file) {
    if (is_dir($path . "/" . $file)) {
        if ($file == "..") {
            $currDirectory[] = "<td><a href='javascript:history.go(-1)'><img src='./icons/folder.png' alt='folder'> $file</a></td>";
        } else {
            $currDirectory[] = "<td><a href='?current_dir=$path/$file'><img src='./icons/folder.png' alt='folder'> $file</a></td>";
        }       
    } else {
        $currDirectory[] = "<td><input class='chekboxClass' id='$file' type='checkbox'><img src='./icons/file.png' alt='file'><p>$file</p></td>";
    }
}

?>

<script>
    function Cheking(){
            document.querySelectorAll('.chekboxClass::cheked')
    }
</script>


<form method="POST">
    <input type="text" name="folder_name">
    <input type="hidden" name="folder_path" value="<?=$path?>">
    <input type="submit" value="Create">
</form>

<style>
    p{
        display: inline-block;
    }
</style>

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
                <?= $file?>
                <td><form method="POST"></form></td>
            </tr>
        <?php } ?>
    </tbody>
</table>