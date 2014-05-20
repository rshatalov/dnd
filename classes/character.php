<?php



class Character {
    public $db;
    public $disabled;
    public $email;
    public $name;
    public $avatar;
    public $uid;
    public $i;

    public function __construct($uid,$reader,$db) {
        $this->uid = $uid;
        $this->db = $db;
       $r = $db->query("select * from users where uid='$uid'");
       $r = $r->fetch();
       $this->email=$r['email'];
       $r = $db->query("select * from characters where uid='$uid'");
       $r = $r->fetch();
       $this->disabled="";
       if ($r != NULL){
           if($uid==$reader)
               $this->disabled="disabled";
        $this->i['name']=$r['name'];
        $this->i['size']=$r['size'];
         $this->i['cur_hp']=$r['cur_hp'];
       }
      
       
    }
    public function process($a){
    $this->i =$a; 
    if (count($this->i)!=3)return;
    
    $q =<<<QUERY
insert into characters set
    uid='{$this->uid}',
    cid='{$this->uid}',
    name='{$this->i['name']}',
    size='{$this->i['size']}',
    cur_hp='{$this->i['cur_hp']}'
QUERY;
      $this->db->exec($q);
    
    //$this->name=$a['name'];
    }
    public function debug() {
        $d= $this->i;
      return $d;  
    }

    public function template() {
        $t = <<<TEMPLATE
<div id="character">
                <form method="post" action="/character.php">
<div id="basic">
    <input name="name" type="text" id="name" placeholder="NOME PERSONAGGIO" value="{$this->i['name']}" {$this->disabled}>
    <input type="text" id="email" placeholder="email" value="{$this->email}" disabled>
    <input type="text" id="" placeholder="RAZZA">
    <input type="text" id="" placeholder="ALLINEAMENTO">
    <input type="text" id="" placeholder="'DIVINITA'"><br/>
    <input type="text" id="class" placeholder="classe">
    <input type="text" id="level" placeholder="LIV.">
    <input name="size" type="text" id="size" placeholder="TAGLIA" value="{$this->i['size']}" {$this->disabled}>
    <input type="text" id="" placeholder="ETA'">
    <input type="text" id="" placeholder="SESSO">
    <input type="text" id="" placeholder="ALTEZZA"><br/>
    <input type="text" id="" placeholder="PESO">
    <input type="text" id="" placeholder="OCCHI">
    <input type="text" id="" placeholder="CAPELLI">
    <input type="text" id="" placeholder="PELLE">
 </div>

<div id="props">
    <div class="string tall">
        <div class="tall narrow black block">
            <div class="first">FOR</div>
            <div class="second"></div>
        </div>
        
        <input type="text" pattern="[0-9]*" class="tall narrow block">
        <div class="tall narrow block"></div>
                 <div class="tall narrow black block"></div>
                <input name="" class="tall narrow block" placeholder="TOT">
                <input name="cur_hp" class="tall medium block" placeholder="ATTUALI" value="{$this->i['cur_hp']}" {$this->disabled}>
                 <div class="tall medium block black">'RIDUZIONE DANNO</div>
                 <div class="tall narrow block"></div>
                 <div class="tall medium block black">'VELOCITA'</div>
                 <div class="tall narrow block"></div>
    </div>
    <div style="clear:both"></div>
                
                
                
    <div class="string tall">
        <div class="tall narrow black block">
            <div class="first">DES</div>
            <div class="second"></div>
        </div>
        
        <input type="text" pattern="[0-9]*" class="tall narrow block">
        <div class="tall narrow block"></div>
                  <div class="tall narrow black block"></div>
                 <div class="tall narrow block"></div>
                 <div class="tall narrow block"></div>
                 <div class="tall narrow block"></div>
                 <div class="tall narrow block"></div>
                 <div class="tall narrow block"></div>
                 <div class="tall narrow block"></div>
                 <div class="tall narrow block"></div> 
                 <div class="tall narrow block"></div>
    </div>
    <div style="clear:both"></div>
                
                
                
    <div class="string tall">
        <div class="tall narrow black block">
            <div class="first">COS</div>
            <div class="second"></div>
        </div>
        
        <input type="text" pattern="[0-9]*" class="tall narrow block">
        <div class="tall narrow block"></div>
    </div>
    <div class="c"></div>
    <div class="string tall">
        <div class="tall narrow black block">
            <div class="first">INT</div>
            <div class="second"></div>
        </div>
        
        <input type="text" pattern="[0-9]*" class="tall narrow block">
        <div class="tall narrow block"></div>
         <div class="tall medium block black">CONTATTO</div>
                <div class="tall narrow block"></div>
             
    </div>
    <div style="clear:both"></div>
  
                  <div class="string tall">
        <div class="tall narrow black block">
            <div class="first">SAG</div>
            <div class="second"></div>
        </div>
        
        <input type="text" pattern="[0-9]*" class="tall narrow block">
        <div class="tall narrow block"></div>
                 <div class="tall medium block black">SPROVVISTA</div>
                <div class="tall narrow block"></div>
    </div>
    <div style="clear:both"></div>
                
                  <div class="string tall">
        <div class="tall narrow black block">
            <div class="first">CAR</div>
            <div class="second"></div>
        </div>
        
        <input type="text" pattern="[0-9]*" class="tall narrow block">
        <div class="tall narrow block"></div>
    </div>
    <div style="clear:both"></div>
                  
</div>
                <div id="basic2">
   <div class="tall string">
      
       </div>                 
   </div>
                <div style="clear:both"></div>
                
                 <div class="tall string">
     
       </div>                 
   </div>
                 <div style="clear:both"></div>
                <input type="submit">
   <div class="tall medium">Send</div></form></div>             
{$this->uid} {$this->name}

TEMPLATE;
        return $t;
    }

}

;
/*
$ch_info['avatar'] = "";
        $image = 'images/characters/' . $_SESSION['uid'] . '.png';
        if (file_exists($image))
            $ch_info['avatar'] = $image;
        
        
$ch = $_SESSION['email'];
$ch .= <<<m
        <hr/>
    <div id="avatar"><img height="150" width="150" src="{$ch_info['avatar']}"></div>
    <form enctype="multipart/form-data" method="post">
        <input type="file" name="file">
    <input type="submit">
    <input type="hidden" name="a" value="file_upload">
    </form>

m;

*/