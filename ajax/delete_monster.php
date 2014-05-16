<?php

$tid=$_GET['tid'];
$mid=$_GET['mid'];
$f=file_get_contents("../tables/$tid/players.txt");
$f=  preg_split("/\n/", $f);
$s="";
foreach ($f as $unit){
    $u=preg_split("/;/", $unit);
    if($mid!=$u[1])
        $s.=$unit."\n";
}
$fh=fopen("../tables/$tid/players.txt","w");
fwrite($fh, $s);
