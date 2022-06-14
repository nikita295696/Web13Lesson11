<?php

$files = scandir("uploads");
foreach ($files as $file){
    if(is_dir("uploads/" . $file)){
        echo "is_dir $file";
    }else{
        echo "all files";
    }
}