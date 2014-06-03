<?php

$outer_template = "site.php";
$css .= "<link rel='stylesheet' href='/css/site.css'>";
$inner_template = "admin_t.php";
$js .= "<script src='js/site.js'></script>";


$users = $db->query("SELECT * FROM users;");
$ul = "<table>";
foreach ($users as $u)
{
    $ul .= "<tr><td>{$u['email']}</td><td>{$u['type']}</td></tr>";
}
$ul .= "</table>";
?>
