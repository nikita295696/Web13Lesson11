<?php
// форма загрузки файлов
?>

<div class="container">
    <form class="upload_form" name="uploadForm" action="?current_dir=<?= $_GET["current_dir"] ?? "" ?>" method="post" enctype="multipart/form-data">

        <input type="hidden" name="current_path" value="<?= $_GET["current_dir"] ?? "" ?>">

        <h2>upload files</h2>

        <label for="file_input" class="btn">
            <p>Click to add file</p>
            <input type="file" name="files" id="file_input" multiple="multiple">
        </label>

        <div class="uploaded_files">
            <span class="empty">no uploaded files...</span>
        </div>

        <input class="btn" type="submit" value="UPLOAD">
    </form>
</div>