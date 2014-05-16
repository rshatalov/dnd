<?php

$host = $_SERVER['SERVER_NAME'];
if ($host == 'dnd.localhost')
{
    $host = "localhost";
    $dbname = "dnd";
    $user = 'root';
    $pswd = "11111";
}
else
{
    $host = "62.149.150.157";
    $dbname = "Sql554176_4";
    $user = "Sql554176";
    $pswd = "5d9b192d";
}
$db = new PDO("mysql:host=$host;dbname=$dbname",$user,$pswd);
