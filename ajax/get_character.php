<?php
session_start();
require_once '../config.php';
require_once '../classes/character.php';
$tid=$_GET['tid'];
$uid=$_GET['uid'];

$ch=new Character($uid, $_SESSION['uid'],$db);
echo $ch->template();