<?php
require_once '../config.php';
require_once '../classes/character.php';
$uid = $_GET['uid'];
$tid = $_GET['tid'];
$query = "SELECT * FROM `monsters` where uid='$uid';";
$ch = new Unit ($db);
$ch->load_unit($uid);

$u = $ch->clone_unit();
       $name=$u->basic['name'];
       $size=$u->basic['size'];
       $actual_hp = $u->props['actual_hp'];
       $max_hp = $u->props['max_hp'];
       $uid = $u->uid;
       
$pf=$_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt";
$players=file_get_contents($pf);
$players=  preg_split("/\n/", $players); 
$n = 1;
for($i=0; $i<count($players); $i++)
{
    if ($players[$i] == "") continue;
    $p=preg_split("/;/",$players[$i]);
    if($p[0] == 'monster' && $p[9] >= $n)
    {
        $n = $p[9]+1;
    }
}
$s = "monster;" . $uid . ";" . $name . ';' . $size . ";25;25;#000000;$max_hp;$actual_hp;$n\n";

$fh = fopen("../tables/$tid/players.txt", "a");
fwrite($fh, $s);
fclose($fh);