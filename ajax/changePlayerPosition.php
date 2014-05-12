<?php

$x = $_GET['x'];
$y = $_GET['y'];
$p = $_GET['player'];
$table = $_GET['table'];
$file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $table . '/players.txt');
$file = preg_split('/\n/', $file);
$string = '';
for ($i = 0; $i < count($file); $i++) {
    $s = $file[$i];
    if ($s != "") {
        $player = preg_split('/;/', $s);
        if ($p == $player[0]) {
            $player[2] = $x;
            $player[3] = $y;
        }
        $string.= $player[0] . ';' . $player[1] . ';' . $player[2] . ';' . $player[3] . "\n";
    }
}
$fh=  fopen($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $table . '/players.txt',"wb");
fwrite($fh, $string);










//echo $string;
