<?php
require_once '../config.php';
$mid = $_GET['mid'];
$tid = $_GET['tid'];
 $query = "SELECT * FROM `monsters` where mid='$mid';";

       $m=$db->query($query);
       $m=$m->fetch();
       $name=$m['name'];
       $size=$m['size'];
       

$pf=$_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt";
$players=file_get_contents($pf);
$players=  preg_split("/\n/", $players); 
$n = 1;
for($i=0; $i<count($players); $i++)
{
    if ($players[$i] == "") continue;
    $p=preg_split("/;/",$players[$i]);
    if($p[0] == 'monster')
    {
        $n++;
        
    }
}
$s = "monster;" . $mid . ";" . $name . ';' . $size . ";25;25;#000000;$n\n";

$fh = fopen("../tables/$tid/players.txt", "a");
fwrite($fh, $s);
fclose($fh);