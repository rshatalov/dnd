<?php
session_start();
$tid=$_GET['tid'];
$email=$_SESSION['email'];
$uid = $_SESSION['uid'];
$type=$_SESSION['type'];
$m=$_GET['message'];
$fh = fopen($_SERVER['DOCUMENT_ROOT']."/tables/$tid/chat.txt","a");
fwrite($fh,"$uid\t$email\t$type\t$m\n");
fclose($fh);