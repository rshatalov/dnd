<?php
$fh = fopen($_SERVER['DOCUMENT_ROOT']."/tables/".$_POST['table']."/battle_grid.txt",'wb');
fwrite ($fh, $_POST['content']);
