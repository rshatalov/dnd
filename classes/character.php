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
    public $salvezza;
    public $mischia;
    public $abil;

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
        $props['var_armor'] = $u['var_armor'];

        $props['max_hp'] = $u['max_hp'];
        $props['actual_hp'] = $u['actual_hp'];

        $salvezza['tempra_base'] = $u['tempra_base'];
        $salvezza['tempra_magia'] = $u['tempra_magia'];
        $salvezza['tempra_vari'] = $u['tempra_vari'];
        $salvezza['tempra_temp'] = $u['tempra_temp'];
        $salvezza['riflessi_base'] = $u['riflessi_base'];
        $salvezza['riflessi_magia'] = $u['riflessi_magia'];
        $salvezza['riflessi_vari'] = $u['riflessi_vari'];
        $salvezza['riflessi_temp'] = $u['riflessi_temp'];
        $salvezza['volonta_base'] = $u['volonta_base'];
        $salvezza['volonta_magia'] = $u['volonta_magia'];
        $salvezza['volonta_vari'] = $u['volonta_vari'];
        $salvezza['volonta_temp'] = $u['volonta_temp'];
        $salvezza['res_inc'] = $u['res_inc'];
        $salvezza['lotta_vari'] = $u['lotta_vari'];
        $salvezza['attaco_base'] = $u['attaco_base'];
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
            $query .= "`force`='{$props['force']}',";
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
        if ($salvezza['tempra_base'])
            $query .= "tempra_base='{$salvezza['tempra_base']}',";
        if ($salvezza['tempra_magia'])
            $query .= "tempra_magia='{$salvezza['tempra_magia']}',";
        if ($salvezza['tempra_vari'])
            $query .= "tempra_vari='{$salvezza['tempra_vari']}',";
        if ($salvezza['tempra_temp'])
            $query .= "tempra_temp='{$salvezza['tempra_temp']}',";
        if ($salvezza['riflessi_base'])
            $query .= "riflessi_base='{$salvezza['riflessi_base']}',";
        if ($salvezza['riflessi_magia'])
            $query .= "riflessi_magia='{$salvezza['riflessi_magia']}',";
        if ($salvezza['riflessi_vari'])
            $query .= "riflessi_vari='{$salvezza['riflessi_vari']}',";
        if ($salvezza['riflessi_temp'])
            $query .= "riflessi_temp='{$salvezza['riflessi_temp']}',";
        if ($salvezza['volonta_base'])
            $query .= "volonta_base='{$salvezza['volonta_base']}',";
        if ($salvezza['volonta_magia'])
            $query .= "volonta_magia='{$salvezza['volonta_magia']}',";
        if ($salvezza['volonta_vari'])
            $query .= "volonta_vari='{$salvezza['volonta_vari']}',";
        if ($salvezza['volonta_temp'])
            $query .= "volonta_temp='{$salvezza['volonta_temp']}',";
        if ($salvezza['res_inc'])
            $query .= "res_inc='{$salvezza['res_inc']}',";
        if ($salvezza['lotta_vari'])
            $query .= "lotta_vari='{$salvezza['lotta_vari']}',";
        if ($salvezza['attaco_base'])
            $query .= "attaco_base='{$salvezza['attaco_base']}',";


        $mischia['attacco_mischia_1'] = $u['attacco_mischia_1'];
        $mischia['danni_mischia_1'] = $u['danni_mischia_1'];
        $mischia['critico_mischia_1'] = $u['critico_mischia_1'];
        $mischia['magico_mischia_1'] = $u['magico_mischia_1'];
        $mischia['mani_mischia_1'] = $u['mani_mischia_1'];
        $mischia['gittata_mischia_1'] = $u['gittata_mischia_1'];
        $mischia['malus_mischia_1'] = $u['malus_mischia_1'];
        $mischia['perfetto_mischia_1'] = $u['perfetto_mischia_1'];
        $mischia['tipo_mischia_1'] = $u['tipo_mischia_1'];
        $mischia['note_mischia_1'] = $u['note_mischia_1'];
        $mischia['bm_mischia_1'] = $u['bm_mischia_1'];
        $mischia['taglia_mischia_1'] = $u['taglia_mischia_1'];

        if ($mischia['attacco_mischia_1'])
            $query .= "attacco_mischia_1='{$mischia['attacco_mischia_1']}',";
        if ($mischia['danni_mischia_1'])
            $query .= "danni_mischia_1='{$mischia['danni_mischia_1']}',";
        if ($mischia['critico_mischia_1'])
            $query .= "critico_mischia_1='{$mischia['critico_mischia_1']}',";
        if ($mischia['magico_mischia_1'])
            $query .= "magico_mischia_1='{$mischia['magico_mischia_1']}',";
        if ($mischia['mani_mischia_1'])
            $query .= "mani_mischia_1='{$mischia['mani_mischia_1']}',";
        if ($mischia['gittata_mischia_1'])
            $query .= "gittata_mischia_1='{$mischia['gittata_mischia_1']}',";
        if ($mischia['malus_mischia_1'])
            $query .= "malus_mischia_1='{$mischia['malus_mischia_1']}',";
        if ($mischia['perfetto_mischia_1'])
            $query .= "perfetto_mischia_1='{$mischia['perfetto_mischia_1']}',";
        if ($mischia['tipo_mischia_1'])
            $query .= "tipo_mischia_1='{$mischia['tipo_mischia_1']}',";
        if ($mischia['note_mischia_1'])
            $query .= "note_mischia_1='{$mischia['note_mischia_1']}',";
        if ($mischia['bm_mischia_1'])
            $query .= "bm_mischia_1='{$mischia['bm_mischia_1']}',";
        if ($mischia['taglia_mischia_1'])
            $query .= "taglia_mischia_1='{$mischia['taglia_mischia_1']}',";

        $abil['acrobazia_check'] = $u['acrobazia_check'];
        $abil['acrobazia_gradi'] = $u['acrobazia_gradi'];
        $abil['acrobazia_vari'] = $u['acrobazia_vari'];
        $abil['add_animali_check'] = $u['add_animali_check'];
        $abil['add_animali_gradi'] = $u['add_animali_gradi'];
        $abil['add_animali_vari'] = $u['add_animali_vari'];
        $abil['artigianato1_check'] = $u['artigianato1_check'];
        $abil['artigianato1_gradi'] = $u['artigianato1_gradi'];
        $abil['artigianato1_vari'] = $u['artigianato1_vari'];
        $abil['artigianato1_name'] = $u['artigianato1_name'];
        $abil['artigianato2_check'] = $u['artigianato2_check'];
        $abil['artigianato2_gradi'] = $u['artigianato2_gradi'];
        $abil['artigianato2_vari'] = $u['artigianato2_vari'];
        $abil['artigianato2_name'] = $u['artigianato2_name'];
        $abil['artigianato3_check'] = $u['artigianato3_check'];
        $abil['artigianato3_gradi'] = $u['artigianato3_gradi'];
        $abil['artigianato3_vari'] = $u['artigianato3_vari'];
        $abil['artigianato3_name'] = $u['artigianato3_name'];
        /* $abil['_check'] = $u['_check'];
          $abil['_gradi'] = $u['_gradi'];
          $abil['_vari'] = $u['_vari'];
          $abil['_name'] = $u['_name'];

         */
        isset($abil['acrobazia_check']) ? $query .= "acrobazia_check='checked'," : $query .= "acrobazia_check=NULL,";
        $abil['acrobazia_gradi'] ? $query .= "acrobazia_gradi='{$abil['acrobazia_gradi']}'," : $query .= "acrobazia_gradi=NULL,";
        $abil['acrobazia_vari'] ? $query .= "acrobazia_vari='{$abil['acrobazia_vari']}'," : $query .= "acrobazia_vari=NULL,";
        $abil['add_animali_check'] ? $query .= "add_animali_check='checked'," : $query .= "add_animali_check=NULL,";
        $abil['add_animali_gradi'] ? $query .= "add_animali_gradi='{$abil['add_animali_gradi']}'," : $query .= "add_animali_gradi=NULL,";
        $abil['add_animali_vari'] ? $query .= "add_animali_vari='{$abil['add_animali_vari']}'," : $query .= "add_animali_vari=NULL,";
        $abil['artigianato1_check'] ? $query .= "artigianato1_check='checked'," : $query .= "artigianato1_check=NULL,";
        $abil['artigianato1_gradi'] ? $query .= "artigianato1_gradi='{$abil['artigianato1_gradi']}'," : $query .= "artigianato1_gradi=NULL,";
        $abil['artigianato1_vari'] ? $query .= "artigianato1_vari='{$abil['artigianato1_vari']}'," : $query .= "artigianato1_vari=NULL,";
        $abil['artigianato1_name'] ? $query .= "artigianato1_name='{$abil['artigianato1_name']}'," : $query .= "artigianato1_name=NULL,";
        $abil['artigianato2_check'] ? $query .= "artigianato2_check='checked'," : $query .= "artigianato2_check=NULL,";
        $abil['artigianato2_gradi'] ? $query .= "artigianato2_gradi='{$abil['artigianato2_gradi']}'," : $query .= "artigianato2_gradi=NULL,";
        $abil['artigianato2_vari'] ? $query .= "artigianato2_vari='{$abil['artigianato2_vari']}'," : $query .= "artigianato2_vari=NULL,";
        $abil['artigianato2_name'] ? $query .= "artigianato2_name='{$abil['artigianato2_name']}'," : $query .= "artigianato2_name=NULL,";
        $abil['artigianato3_check'] ? $query .= "artigianato3_check='checked'," : $query .= "artigianato3_check=NULL,";
        $abil['artigianato3_gradi'] ? $query .= "artigianato3_gradi='{$abil['artigianato3_gradi']}'," : $query .= "artigianato3_gradi=NULL,";
        $abil['artigianato3_vari'] ? $query .= "artigianato3_vari='{$abil['artigianato3_vari']}'," : $query .= "artigianato3_vari=NULL,";
        $abil['artigianato3_name'] ? $query .= "artigianato3_name='{$abil['artigianato3_name']}'," : $query .= "artigianato3_name=NULL,";
        /*
         * $abil['_check'] ? $query .= "_check='{$abil['_check']}'," : $query .= "_check=NULL,";
          $abil['_check'] ? $query .= "_check='checked'," : $query .= "_check=NULL,";
          $abil['_gradi'] ? $query .= "_gradi='{$abil['_gradi']}'," : $query .= "_gradi=NULL,";
          $abil['_vari'] ? $query .= "_vari='{$abil['_vari']}'," : $query .= "_vari=NULL,";
          $abil['_name'] ? $query .= "_name='{$abil['_name']}'," : $query .= "_name=NULL,";
          if ($abil[''])
          $query .= "='{$abil['']}',"; */

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

        $this->salvezza['tempra_base'] = $u['tempra_base'];
        $this->salvezza['tempra_magia'] = $u['tempra_magia'];
        $this->salvezza['tempra_vari'] = $u['tempra_vari'];
        $this->salvezza['tempra_temp'] = $u['tempra_temp'];
        $this->salvezza['riflessi_base'] = $u['riflessi_base'];
        $this->salvezza['riflessi_magia'] = $u['riflessi_magia'];
        $this->salvezza['riflessi_vari'] = $u['riflessi_vari'];
        $this->salvezza['riflessi_temp'] = $u['riflessi_temp'];
        $this->salvezza['volonta_base'] = $u['volonta_base'];
        $this->salvezza['volonta_magia'] = $u['volonta_magia'];
        $this->salvezza['volonta_vari'] = $u['volonta_vari'];
        $this->salvezza['volonta_temp'] = $u['volonta_temp'];
        $this->salvezza['res_inc'] = $u['res_inc'];
        $this->salvezza['lotta_vari'] = $u['lotta_vari'];
        $this->salvezza['attaco_base'] = $u['attaco_base'];


        $this->mischia['attacco_mischia_1'] = $u['attacco_mischia_1'];
        $this->mischia['danni_mischia_1'] = $u['danni_mischia_1'];
        $this->mischia['critico_mischia_1'] = $u['critico_mischia_1'];
        $this->mischia['magico_mischia_1'] = $u['magico_mischia_1'];
        $this->mischia['mani_mischia_1'] = $u['mani_mischia_1'];
        $this->mischia['gittata_mischia_1'] = $u['gittata_mischia_1'];
        $this->mischia['malus_mischia_1'] = $u['malus_mischia_1'];
        $this->mischia['perfetto_mischia_1'] = $u['perfetto_mischia_1'];
        $this->mischia['tipo_mischia_1'] = $u['tipo_mischia_1'];
        $this->mischia['note_mischia_1'] = $u['note_mischia_1'];
        $this->mischia['bm_mischia_1'] = $u['bm_mischia_1'];
        $this->mischia['taglia_mischia_1'] = $u['taglia_mischia_1'];
        $this->abil['acrobazia_check'] = $u['acrobazia_check'];
        $this->abil['acrobazia_gradi'] = $u['acrobazia_gradi'];
        $this->abil['acrobazia_vari'] = $u['acrobazia_vari'];
        $this->abil['add_animali_check'] = $u['add_animali_check'];
        $this->abil['add_animali_gradi'] = $u['add_animali_gradi'];
        $this->abil['add_animali_vari'] = $u['add_animali_vari'];
        $this->abil['artigianato1_check'] = $u['artigianato1_check'];
        $this->abil['artigianato1_gradi'] = $u['artigianato1_gradi'];
        $this->abil['artigianato1_vari'] = $u['artigianato1_vari'];
        $this->abil['artigianato1_name'] = $u['artigianato1_name'];
        $this->abil['artigianato2_check'] = $u['artigianato2_check'];
        $this->abil['artigianato2_gradi'] = $u['artigianato2_gradi'];
        $this->abil['artigianato2_vari'] = $u['artigianato2_vari'];
        $this->abil['artigianato2_name'] = $u['artigianato2_name'];
        $this->abil['artigianato3_check'] = $u['artigianato3_check'];
        $this->abil['artigianato3_gradi'] = $u['artigianato3_gradi'];
        $this->abil['artigianato3_vari'] = $u['artigianato3_vari'];
        $this->abil['artigianato3_name'] = $u['artigianato3_name'];

        // $this->abil[''] = $u[''];
        /*
          $this->abil['_check'] = $u['_check'];
          $this->abil['_gradi'] = $u['_gradi'];
          $this->abil['_vari'] = $u['_vari'];
          $this->abil['_name'] = $u['_name'];

         */
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
