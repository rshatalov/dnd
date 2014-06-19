<?php

require_once '../config.php';
 $query = "SELECT * FROM `units` WHERE type='monster' && status='1' && monster_id IS NULL;";

        $mlist = "";
        foreach ($db->query($query) as $m) {
          $mlist.="<div class='monster-in-stack'><img width='100' height='100' align='left' src='/images/units/".$m['uid'].".png'>";
          $mlist .= $m['name']."<br/>Size: ".$m['size']."<div id='{$m['uid']}-in-stack' class='add-monster-from-stack'>Add</div></div>";
        }
        echo $mlist;