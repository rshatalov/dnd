<?php

$ch= new Character($_SESSION['uid'],$_SESSION['uid'],$db);
$ch->process($_POST);
print_r ($ch->debug());
//print_r($_GET);
