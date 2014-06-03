<?php



class Unit {
    public $db;
    public $disabled;
    public $monster_id;
    public $email;
    public $user_name;
    public $name;
    public $avatar;
    public $uid;
    public $i;

    public function __construct($db, $uid=0,$reader=0) {
       $this->db = $db;
       /*
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
        */
       
    }
    public function process($a){
        /*
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
         * 
         */
    }
    public function debug() {
        
        //$d= $this->i;
        $d = "character!!!!!!!!!!!!!!";
      return $d;  
    }

    public function generate_template () {
        require_once("templates/character_t.php");
    }
    public function template() {
        return $t;
    }
    
    public function create_monster($user_id, $user_name) {
        $uid = uniqid();
        $this->db->exec("insert into units set uid='$uid',status='0',type='monster', user_id='$user_id',user_name='$user_name';");
        $this->load_unit($uid);
    }
    
    public function load_unit($uid)
    {
        $query = "SELECT * FROM units WHERE uid='$uid'";
        $r = $this->db->query($query);
        $u = $r->fetch();
        $this->uid = $u['uid'];
        $this->monster_id = $u['monster_id'];
        $this->user_name = $u['user_name'];
    }
};