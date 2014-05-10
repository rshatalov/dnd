<?php
//echo $_GET['table'];
$content = file_get_contents($_SERVER['DOCUMENT_ROOT']."/tables/".
           $_GET['table']."/battle_grid.txt");
echo ($content);
