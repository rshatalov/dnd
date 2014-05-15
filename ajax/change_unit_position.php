<?php

$x = $_GET['x'];
$y = $_GET['y'];
$u = $_GET['unit'];
$utype = $_GET['unit_type'];
$table = $_GET['table'];
$file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $table . "/players.txt");
$file = preg_split('/\n/', $file);
$string = '';
for ($i = 0; $i < count($file); $i++) {
    $s = $file[$i];
    if ($s != "") {
        $unit = preg_split('/;/', $s);
        if ($u == $unit[1]) {
            $unit[4] = $x;
            $unit[5] = $y;
        }
        $string.= $unit[0] . ';' . $unit[1] . ';' . $unit[2] . ';' . $unit[3] .";" . $unit[4] .";" .$unit[5] ."\n";
    }
}
$fh =  fopen($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $table . '/players.txt',"w");
fwrite($fh, $string);