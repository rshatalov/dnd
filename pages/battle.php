<?php
$outer_template = "battle_t.php";
$css .= "<link rel='stylesheet' href='/css/batle.css'>";
$js .= "<script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js'></script>";
$js .= "<script src='js/battle_grid.js'></script>";

if ($_SESSION['type'] == 'dm')
{
$js .= "<script src='js/battle_grid_dm.js'></script>";
}
else
    $js .= "<script src='js/battle_grid_player.js'></script>";
