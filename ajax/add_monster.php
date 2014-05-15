<?php
require_once '../config.php';
$mid = $_GET['mid'];
$tid = $_GET['tid'];
 $query = "SELECT * FROM `monsters` where mid='$mid';";

       $m=$db->query($query);
      // $m=$m->();
       $m=$m->fetch();
       $name=$m['name'];
       $size=$m['size'];
       
$s = "monster;" . $mid . ";" . $name . ';' . $size . ";25;25\n";

$fh = fopen("../tables/$tid/players.txt", "a");
fwrite($fh, $s);

print_r($m);