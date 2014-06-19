<?php
require_once '../config.php';
$tid=$_GET['tid'];
$uid=$_GET['uid'];
$query = "DELETE FROM `units` WHERE uid='$uid';";
$db->exec($query);
unlink($_SERVER['DOCUMENT_ROOT'] . "/images/units/$uid.png");
$f=file_get_contents("../tables/$tid/players.txt");
$f=  preg_split("/\n/", $f);
$s="";
foreach ($f as $unit){
    if ($unit == "") continue;
    $u=preg_split("/;/", $unit);
    if($uid!=$u[1])
        $s.=$unit."\n";
}
$fh=fopen("../tables/$tid/players.txt","w");
fwrite($fh, $s);
