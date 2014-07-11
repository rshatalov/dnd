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
        if ($s != "P" && $s != "M" && $s != "G" && $s != "E" && $s != "S" && $s != "C") {
            echo "Wrong size";
            return;
        }
        $basic['size'] = $s;
        $basic['name'] = $u['name'];
        $basic['race'] = $u['race'];
        $basic['alignment'] = $u['alignment'];
        $basic['divinity'] = $u['divinity'];
        $basic['class'] = $u['class'];
        $basic['level'] = $u['level'];
        $basic['age'] = $u['age'];
        $basic['sex'] = $u['sex'];
        $basic['height'] = $u['height'];
        $basic['weight'] = $u['weight'];
        $basic['eyes_color'] = $u['eyes_color'];
        $basic['hair_color'] = $u['hair_color'];
        $basic['skin_color'] = $u['skin_color'];

        $props['strength'] = $u['strength'];
        $props['dexterity'] = $u['dexterity'];
        $props['force'] = $u['force'];
        $props['intelligence'] = $u['intelligence'];
        $props['wisdom'] = $u['wisdom'];
        $props['charism'] = $u['charism'];
        $props['resistance_at_damage'] = $u['resistance_at_damage'];
        $props['speed'] = $u['speed'];
        $props['var_initiative'] = $u['var_initiative'];
        $props['natural_armor'] = $u['natural_armor'];
        $props['deflection_armor'] = $u['deflection_armor'];
        $props['var_armor'] = $u['var_armor;'];

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
        if ($basic['race'])
            $query .= "race='{$basic['race']}',";
        if ($basic['alignment'])
            $query .= "alignment='{$basic['alignment']}',";
        if ($basic['divinity'])
            $query .= "divinity='{$basic['divinity']}',";
        if ($basic['class'])
            $query .= "class='{$basic['class']}',";
        if ($basic['level'])
            $query .= "level='{$basic['level']}',";
        if ($basic['age'])
            $query .= "age='{$basic['age']}',";
        if ($basic['sex'])
            $query .= "sex='{$basic['sex']}',";
        if ($basic['height'])
            $query .= "height='{$basic['height']}',";
        if ($basic['weight'])
            $query .= "weight='{$basic['weight']}',";
        if ($basic['eyes_color'])
            $query .= "eyes_color='{$basic['eyes_color']}',";
        if ($basic['hair_color'])
            $query .= "hair_color='{$basic['hair_color']}',";
        if ($basic['skin_color'])
            $query .= "skin_color='{$basic['skin_color']}',";


        if ($props['strength'])
            $query .= "strength='{$props['strength']}',";
        if ($props['dexterity'])
            $query .= "dexterity='{$props['dexterity']}',";
        if ($props['force'])
            $query .= "force='{$props['force']}',";
        if ($props['intelligence'])
            $query .= "intelligence='{$props['intelligence']}',";
        if ($props['wisdom'])
            $query .= "wisdom='{$props['wisdom']}',";
        if ($props['charism'])
            $query .= "charism='{$props['charism']}',";
        if ($props['resistance_at_damage'])
            $query .= "resistance_at_damage='{$props['resistance_at_damage']}',";
        if ($props['speed'])
            $query .= "speed='{$props['speed']}',";
        if ($props['var_initiative'])
            $query .= "var_initiative='{$props['var_initiative']}',";
        if ($props['natural_armor'])
            $query .= "natural_armor='{$props['natural_armor']}',";
        if ($props['deflection_armor'])
            $query .= "deflection_armor='{$props['deflection_armor']}',";
        if ($props['var_armor'])
            $query .= "var_armor='{$props['var_armor']}',";

        if ($props['max_hp'])
            $query .= "max_hp='{$props['max_hp']}',";
        if ($props['actual_hp'])
            $query .= "actual_hp='{$props['actual_hp']}',";
        if ($basic['size'] && $basic['name'] && file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/units/{$u['uid']}.png"))
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
        $this->basic['race'] = $u['race'];
        $this->basic['alignment'] = $u['alignment'];
        $this->basic['divinity'] = $u['divinity'];
        $this->basic['class'] = $u['class'];
        $this->basic['level'] = $u['level'];
        $this->basic['age'] = $u['age'];
        $this->basic['sex'] = $u['sex'];
        $this->basic['height'] = $u['height'];
        $this->basic['weight'] = $u['weight'];
        $this->basic['eyes_color'] = $u['eyes_color'];
        $this->basic['hair_color'] = $u['hair_color'];
        $this->basic['skin_color'] = $u['skin_color'];
        
        $this->props['strength'] = $u['strength'];
        $this->props['dexterity'] = $u['dexterity'];
        $this->props['force'] = $u['force'];
        $this->props['intelligence'] = $u['intelligence'];
        $this->props['wisdom'] = $u['wisdom'];
        $this->props['charism'] = $u['charism'];
        $this->props['resistance_at_damage'] = $u['resistance_at_damage'];
        $this->props['speed'] = $u['speed'];
        $this->props['var_initiative'] = $u['var_initiative'];
        $this->props['natural_armor'] = $u['natural_armor'];
        $this->props['deflection_armor'] = $u['deflection_armor'];
        $this->props['var_armor'] = $u['var_armor'];
        $this->props['max_hp'] = $u['max_hp'];
        $this->props['actual_hp'] = $u['actual_hp'];
    }

    public function clone_unit() {
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

        $p = $_SERVER['DOCUMENT_ROOT'] . "/images/units/";
        copy($p . $this->uid . ".png", $p . $u->uid . ".png");
        return $u;
    }

}

;
