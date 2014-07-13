<?php

if (!isset($_SESSION['uid']))
    header("Location: /users.php?tab=login");
$outer_template = "battle_t.php";
$css .= "<link rel='stylesheet' href='/css/batle.css'>";
$css .= "<link rel='stylesheet' href='/css/character.css'>";

$js .= "<script src='js/battle_grid.js'></script>";

if ($_SESSION['type'] == 'dm')
    $js .= "<script src='js/battle_grid_dm.js'></script>";
else
    $js .= "<script src='js/battle_grid_player.js'></script>";