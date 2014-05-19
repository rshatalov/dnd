<?php
require_once '../functions.php';
$tid = $_POST['tid'];
$iid = uniqid();
$to = "../tables/$tid/scroll/" . $iid . ".png";
$from = "../tables/$tid/scroll/" . $_FILES['file']['name'];
convert_to_png($from, $to, $tid);
$message = "<img class='image-in-scroll' src='/tables/$tid/scroll/$iid.png'>\n";
$fh = fopen($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $tid . "/scroll.txt", 'a');
fwrite($fh, $message);
fclose();


