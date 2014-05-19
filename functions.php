<?php

function deleteDirectory($dirPath) {
    if (is_dir($dirPath)) {
        $objects = scandir($dirPath);
        foreach ($objects as $object) {
            if ($object != "." && $object !="..") {
                if (filetype($dirPath . DIRECTORY_SEPARATOR . $object) == "dir") {
                    deleteDirectory($dirPath . DIRECTORY_SEPARATOR . $object);
                } else {
                    unlink($dirPath . DIRECTORY_SEPARATOR . $object);
                }
            }
        }
    reset($objects);
    rmdir($dirPath);
    }
}
function convert_to_png($from, $to) {
    move_uploaded_file($_FILES['file']['tmp_name'], $from);
    $ext = preg_split("/\./", $_FILES['file']['name']);
    switch ($ext[1]) {
        case "png":
             $image = imagecreatefrompng($from);
            imagepng($image, $to);
            imagedestroy($image);
            unlink($from);
            break;
        case "jpg": case "jpeg":
            $image = imagecreatefromjpeg($from);
            imagepng($image, $to);
            imagedestroy($image);
            unlink($from);
            break;
        case "gif":
            $image = imagecreatefromgif($from);
            imagepng($image, $to);
            imagedestroy($image);
            unlink($from);
            break;
        default:
            echo "wrong format";
    }
}

