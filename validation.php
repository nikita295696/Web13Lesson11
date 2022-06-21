<?php

function validUploadFile(): void {
    if (isset($_FILES["multiple_files"]) && !empty($_FILES["multiple_files"]["name"])) {

        $multiple = $_FILES["multiple_files"];

        foreach ($multiple["name"] as $idx => $name) {
            $oldPath = $multiple["tmp_name"][$idx];
            $size = $multiple["size"][$idx];
            $info = pathinfo($name);
            $basename = $info["basename"];
            $ext = $info["extension"];
            if ($size > 20000000) {
                session_start();
                $_SESSION["error_msg"] = "Размер загружаемого файла ($name) должен быть не более 20 Мб";
                $newPath = "";
                session_write_close();
            } else {
                switch ($ext) {
                    case "txt":
                    case "xls":
                    case "doc":
                    case "docx":
                    case "odt":
                    case "pdf":
                    case "jpeg":
                    case "jpg":
                    case "png":
                    case "svg":
                    case "webp":
                        $newPath = "uploads" . "/" . time() . "_" . $basename;
                        break;
                    default:
                        session_start();
                        $_SESSION["error_msg"] = "Формат файла ($name) должен быть txt, xls, doc, docx, odt, pdf, jpeg, jpg, png, svg, webp";
                        $newPath = "";
                        session_write_close();
                        break;
                }

                if (!empty($newPath)) {
                    move_uploaded_file($oldPath, $newPath);
                }
            }
        }
    }
}

function validCreateDir(): void {

}
