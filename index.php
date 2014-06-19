<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once("config.php");
require_once("functions.php");
require_once("classes/character.php");
$js = "";
$js .= "<script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js'></script>";
//$js .= "<script src='/jquery-min.js'></script>";
$css = "";
$debug = "";

//$_SERVER['REQUEST_URI']
//print_r ($_SERVER);
//$path = substr($_SERVER['REQUEST_URI'],1);
if (isset($_SERVER['REDIRECT_URL']))
    $path = substr($_SERVER['REDIRECT_URL'],1);
else
    $path = 'main.php';
//echo $path;

//$debug .= "Address: $path<br/>";
$content = "";
require_once("pages/" .$path);

require_once 'templates/template.php';

?>