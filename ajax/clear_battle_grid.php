<?php

$tid=$_GET['table'];
fopen($_SERVER['DOCUMENT_ROOT']."/tables/$tid/battle_grid.txt", "wb");
