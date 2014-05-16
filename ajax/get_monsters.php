<?php

require_once '../config.php';
 $query = "SELECT * FROM `monsters`;";

        $mlist = "";
        foreach ($db->query($query) as $m) {
          $mlist.="<div class='monster-in-stack'><img width='100' height='100' align='left' src='/images/monsters/".$m['mid'].".jpg'>";
          $mlist .= $m['name']."<br/>Size: ".$m['size']."<div id='{$m['mid']}-in-stack' class='add-monster-from-stack'>Add</div></div>";
        }
        echo $mlist;