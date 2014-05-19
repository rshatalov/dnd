<?php
$tid = $_POST['tid'];
$message = $_POST['message'];
$message = "<div>". str_replace("\n","<br/>",$message);
$message .= "<div>\n";
$fh = fopen($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $tid . "/scroll.txt",'a');
fwrite($fh,$message);
fclose();