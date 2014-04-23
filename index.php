<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once("config.php");
$js = "";
$css = "";
$debug = "";

/*
if (isset($_GET['p']) && $_GET['p'] == 'tables_list')
{
    $template = "games.php";
    require_once "tables.php";
}
else
{
$template = "battle.php";
}
*/

//$_SERVER['REQUEST_URI']
//print_r ($_SERVER);
//$path = substr($_SERVER['REQUEST_URI'],1);
if (isset($_SERVER['REDIRECT_URL']))
    $path = substr($_SERVER['REDIRECT_URL'],1);
else
    $path = 'index.php';
//echo $path;

$debug .= "Address: $path<br/>";
$content = "";
require_once("pages/" .$path);
require_once 'templates/template.php';

?>