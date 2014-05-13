<?php

$x = $_GET['x'];
$y = $_GET['y'];
$u = $_GET['unit'];
$utype = $_GET['unit_type'];
$table = $_GET['table'];
$file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $table . "/".$utype."s.txt");
$file = preg_split('/\n/', $file);
$string = '';
for ($i = 0; $i < count($file); $i++) {
    $s = $file[$i];
    if ($s != "") {
        $unit = preg_split('/;/', $s);
        if ($u == $unit[0]) {
            $unit[2] = $x;
            $unit[3] = $y;
        }
        $string.= $unit[0] . ';' . $unit[1] . ';' . $unit[2] . ';' . $unit[3] . "\n";
    }
}
$fh =  fopen($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $table . '/'.$utype.'s.txt',"wb");
fwrite($fh, $string);