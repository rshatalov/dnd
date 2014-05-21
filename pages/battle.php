<?php

if (!isset($_SESSION['uid']))
    header("Location: /users.php?tab=login");
$outer_template = "battle_t.php";
$css .= "<link rel='stylesheet' href='/css/batle.css'>";
$css .= "<link rel='stylesheet' href='/css/character.css'>";
$css .= "<link href='/css/perfect-scrollbar-0.4.10.min.css' rel='stylesheet'>";
$js .= "<script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js'></script>";
$js .= "<script src='/js/perfect-scrollbar-0.4.10.with-mousewheel.min.js'></script>";
$js .= "<script src='js/battle_grid.js'></script>";

if ($_SESSION['type'] == 'dm')
    $js .= "<script src='js/battle_grid_dm.js'></script>";
else
    $js .= "<script src='js/battle_grid_player.js'></script>";