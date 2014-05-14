<?php

$tid=$_GET['tid'];
fopen($_SERVER['DOCUMENT_ROOT']."/tables/$tid/battle_grid.txt", "wb");
