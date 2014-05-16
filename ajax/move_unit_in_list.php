<?php

$uid=$_GET['uid'];
$tid=$_GET['tid'];
$dir=$_GET['dir'];
$pf=$_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt";
$players=file_get_contents($pf);
$players=  preg_split("/\n/", $players);
$ui=0;
$pi=0;
$ni=0;
$us="";
$s="";
$t=NULL;

for($i=0; $i<count($players); $i++)
{
    $p=preg_split("/;/",$players[$i]);
    if($uid==$p[1])
    {
        $ui=$i;
        $us=$players[$i];
        $i>0 ?$pi=$i-1: $pi=$ui;
        $i<count($players)-2 ?$ni=$i+1: $ni=$ui;
        
    }
}
for($i=0; $i<count($players); $i++)
{
    if($dir=="up")
    {
        if ($i==$pi && $ui!=$pi)
        {
            $t=$players[$i];
            $players[$i]=$us;
        }
        if($i==$ui && $ui!=$pi)
        {
            $players[$i]=$t;
        }
    }
     if($dir=="down")
    {
        if ($i==$ni && $ui!=$ni)
        {
             $players[$i]=$t;
        }
        if($i==$ui && $ui!=$ni)
        {
             $t=$players[$i];
            $players[$i]=$players[$i+1];
           
        }
    }
   
}
 if($dir=="2up")
    {
        if($ui!=0)
        {
            array_unshift($players, $players[$ui]);
            unset($players[$ui+1]);
           
        }
    }
      if($dir=="2down")
    {
        if($ui!= count($players)-2)
        {
            array_pop($players);
            array_push($players, $players[$ui]);
            unset($players[$ui]);
            array_push($players, "");
           
        }
    }
for($i=0;$i<count($players);$i++)
{
    if ($players[$i] != "")
    $s.=$players[$i]."\n";
}
$fh=fopen($pf,"w");
fwrite($fh, $s);
print_r($s);