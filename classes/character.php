<?php

class Unit {

    public $db;
    public $disabled;
    public $monster_id;
    public $type;
    public $email;
    public $user_name;
    public $name;
    public $avatar;
    public $uid;
    public $i;
    public $basic;
    public $props;

    public function __construct($db, $uid = 0, $reader = 0) {
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

    public function process_input($u) {
        print_r($u);
        $s = strtoupper($u['size']);
    if ($s != "P" && $s != "M" && $s != "G" && $s != "E" && $s != "S" && $s != "C")
    {
        echo "Wrong size";
        return;
    }
        $basic['size'] = $s;
        $basic['name'] = $u['name'];
        $props['max_hp'] = $u['max_hp'];
        $props['actual_hp'] = $u['actual_hp'];
        if ($u['a'] == 'edit_unit')
            $query = "UPDATE units SET ";
        else
            $query = "INSERT INTO units SET ";
        if ($basic['size'])
            $query .= "size='{$basic['size']}',";
        if ($basic['name'])
            $query .= "name='{$basic['name']}',";
        if ($props['max_hp'])
            $query .= "max_hp='{$props['max_hp']}',";
        if ($props['actual_hp'])
            $query .= "actual_hp='{$props['actual_hp']}',";
        if ($basic['size'] && $basic['name'] && file_exists($_SERVER['DOCUMENT_ROOT']."/images/units/{$u['uid']}.png"))
            $query .= "status='1',";
        $query .= "type='{$u['type']}' ";
        if ($u['a'] == 'edit_unit')
            $query .= "WHERE uid='{$u['uid']}';";
        echo $query;
        $this->db->exec($query);
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

    public function generate_template() {
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

    public function load_unit($uid) {
        $query = "SELECT * FROM units WHERE uid='$uid'";
        $r = $this->db->query($query);
        $u = $r->fetch();
        $this->type = $u['type'];
        $this->uid = $u['uid'];
        $this->monster_id = $u['monster_id'];
        $this->user_name = $u['user_name'];
        $this->basic['name'] = $u['name'];
        $this->basic['size'] = $u['size'];
        $this->props['max_hp'] = $u['max_hp'];
        $this->props['actual_hp'] = $u['actual_hp'];
    }
    
    public function clone_unit()
    {
        $u = clone $this;
        $uid = uniqid();
        $u->uid = $uid;
        $query = "CREATE TEMPORARY TABLE tmptable_1 SELECT * FROM units WHERE uid='{$this->uid}'";
        $this->db->query($query);
        $query = "UPDATE tmptable_1 SET uid='$uid', monster_id='{$this->uid}'";
        $this->db->query($query);
        $query = "INSERT INTO units SELECT * FROM tmptable_1";
        $this->db->query($query);
        $query = "DROP TEMPORARY TABLE IF EXISTS tmptable_1";
        $this->db->query($query);
        
        $p = $_SERVER['DOCUMENT_ROOT']."/images/units/";
        copy($p.$this->uid.".png",$p.$u->uid.".png");
        return $u;
    }

}

;
