<?php
session_start();
$tid = $_GET['tid'];
$uid = $_SESSION['uid'];
$file = file_get_contents($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $tid . "/players.txt");
$units = preg_split('/\n/', $file);
$string = '';

for ($i = 0; $i < count($units); $i++) {
     $unit = $units[$i];
    if ($unit == "")
        continue;
    $u = preg_split('/;/', $unit);
    if ($uid == $u[1]) {
        $u[7] = time();
        //print_r($u);
        for ($j=0;$j < count($u);$j++)
        {
            $string .= $u[$j];
            if ($j == count($u)-1)
                $string .= "\n";
            else
                $string .= ";";
        }
    }
    else {
        $string .= $units[$i] . "\n";
    }
}
$fh = fopen($_SERVER['DOCUMENT_ROOT'] . '/tables/' . $tid . '/players.txt', "w");
fwrite($fh, $string);
fclose($fh);