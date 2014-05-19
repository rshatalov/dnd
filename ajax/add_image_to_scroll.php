<?php
$tid = $_POST['tid'];

$iid = uniqid();
$to = "../tables/$tid/scroll/". $iid.".png";
convert_to_png($to,$tid);

$message = "<img class='image-in-scroll' src='/tables/$tid/scroll/$iid.png'>\n";
$fh = fopen($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $tid . "/scroll.txt",'a');
fwrite($fh,$message);
fclose();

function convert_to_png ($to,$tid)
{
    $from = "../tables/$tid/".$_FILES['file']['name'];
    $ext = preg_split("/\./",$_FILES['file']['name']);
    if (move_uploaded_file($_FILES['file']['tmp_name'], $from))
    {
        switch ($ext[1]) {
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
               echo "PNG Given";
        }
        echo "OK";
    }
    else
    {
         echo "ERROR";
    }
}
