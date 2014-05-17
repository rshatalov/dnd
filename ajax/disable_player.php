<?php

$uid=$_GET['uid'];
$tid=$_GET['tid'];
$fpath=$_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt";
$pf=file_get_contents($fpath);
$players =  preg_split("/\n/", $pf);
$s = "";

for($i=0; $i<count($players); $i++)
{
    $t=preg_split("/;/",$players[$i]);
    if($uid==$t[1])
    {
        $t[3] == '1'? $t[3]='2':$t[3] = '1';
        
        for ($j=0;$j<count($t);$j++)
        {
            $s.= $t[$j];
            if ($j != count($t)-1)
                $s.=";";
            else
                $s .= "\n";
        }
        
    }
    else if ($players[$i]!="")
    {
        $s.= $players[$i]."\n";
    }

}

$fh=fopen($fpath,"w");
fwrite($fh, $s);
fclose($fh);