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
        if ($s != "P" && $s != "M" && $s != "G" && $s != "E" && $s != "S" && $s != "C" && $s!="") {
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
        $classes = $u['NoClasses'];
        $basic['classes'] = "";
        for ($i = 1; $i <= $classes;$i++)
        {
            if ($u['class'.$i] || $u['level'.$i] )
                $basic['classes'].= $u['class'.$i] . "\t". $u['level'.$i]. "\n";
        }
        
        $zaino = $u['zaino'];
        $items['borsas'] = "";
        for ($i = 1; $i <= $zaino;$i++)
        {
            if ($u['borsa'.$i] || $u['borsa'.$i."_peso"] )
                $items['borsas'].= $u['borsa'.$i] . "\t". $u['borsa'.$i."_peso"]. "\n";
        }
        $items['borsas']!= "" ? $query .= "borsas='{$items['borsas']}'," : $query .= "borsas=NULL,";
        
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
        $basic['classes']!= "" ? $query .= "classes='{$basic['classes']}'," : $query .= "classes=NULL,";
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

            
        $items['borsas']!= "" ? $query .= "borsas='{$items['borsas']}'," : $query .= "borsas=NULL,";
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
        $abil['art_fuga_check'] = $u['art_fuga_check'];
        $abil['art_fuga_gradi'] = $u['art_fuga_gradi'];
        $abil['art_fuga_vari'] = $u['art_fuga_vari'];
        $abil['ascoltare_check'] = $u['ascoltare_check'];
        $abil['ascoltare_gradi'] = $u['ascoltare_gradi'];
        $abil['ascoltare_vari'] = $u['ascoltare_vari'];
        $abil['camuffare_check'] = $u['camuffare_check'];
        $abil['camuffare_gradi'] = $u['camuffare_gradi'];
        $abil['camuffare_vari'] = $u['camuffare_vari'];
        $abil['cavalcare_check'] = $u['cavalcare_check'];
        $abil['cavalcare_gradi'] = $u['cavalcare_gradi'];
        $abil['cavalcare_vari'] = $u['cavalcare_vari'];
        $abil['cercare_check'] = $u['cercare_check'];
        $abil['cercare_gradi'] = $u['cercare_gradi'];
        $abil['cercare_vari'] = $u['cercare_vari'];
        $abil['concentrazione_check'] = $u['concentrazione_check'];
        $abil['concentrazione_gradi'] = $u['concentrazione_gradi'];
        $abil['concentrazione_vari'] = $u['concentrazione_vari'];
        $abil['conoscenze1_check'] = $u['conoscenze1_check'];
        $abil['conoscenze1_gradi'] = $u['conoscenze1_gradi'];
        $abil['conoscenze1_vari'] = $u['conoscenze1_vari'];
        $abil['conoscenze1_name'] = $u['conoscenze1_name'];
        $abil['conoscenze2_check'] = $u['conoscenze2_check'];
        $abil['conoscenze2_gradi'] = $u['conoscenze2_gradi'];
        $abil['conoscenze2_vari'] = $u['conoscenze2_vari'];
        $abil['conoscenze2_name'] = $u['conoscenze2_name'];
        $abil['conoscenze3_check'] = $u['conoscenze3_check'];
        $abil['conoscenze3_gradi'] = $u['conoscenze3_gradi'];
        $abil['conoscenze3_vari'] = $u['conoscenze3_vari'];
        $abil['conoscenze3_name'] = $u['conoscenze3_name'];
        $abil['conoscenze4_check'] = $u['conoscenze4_check'];
        $abil['conoscenze4_gradi'] = $u['conoscenze4_gradi'];
        $abil['conoscenze4_vari'] = $u['conoscenze4_vari'];
        $abil['conoscenze4_name'] = $u['conoscenze4_name'];
        $abil['conoscenze5_check'] = $u['conoscenze5_check'];
        $abil['conoscenze5_gradi'] = $u['conoscenze5_gradi'];
        $abil['conoscenze5_vari'] = $u['conoscenze5_vari'];
        $abil['conoscenze5_name'] = $u['conoscenze5_name'];
        $abil['decifrare_check'] = $u['decifrare_check'];
        $abil['decifrare_gradi'] = $u['decifrare_gradi'];
        $abil['decifrare_vari'] = $u['decifrare_vari'];
        $abil['diplomazia_check'] = $u['diplomazia_check'];
        $abil['diplomazia_gradi'] = $u['diplomazia_gradi'];
        $abil['diplomazia_vari'] = $u['diplomazia_vari'];
        $abil['disattivare_check'] = $u['disattivare_check'];
        $abil['disattivare_gradi'] = $u['disattivare_gradi'];
        $abil['disattivare_vari'] = $u['disattivare_vari'];
        $abil['equilibrio_check'] = $u['equilibrio_check'];
        $abil['equilibrio_gradi'] = $u['equilibrio_gradi'];
        $abil['equilibrio_vari'] = $u['equilibrio_vari'];
        $abil['falsificare_check'] = $u['falsificare_check'];
        $abil['falsificare_gradi'] = $u['falsificare_gradi'];
        $abil['falsificare_vari'] = $u['falsificare_vari'];
        $abil['guarire_check'] = $u['guarire_check'];
        $abil['guarire_gradi'] = $u['guarire_gradi'];
        $abil['guarire_vari'] = $u['guarire_vari'];
        $abil['intimidre_check'] = $u['intimidre_check'];
        $abil['intimidre_gradi'] = $u['intimidre_gradi'];
        $abil['intimidre_vari'] = $u['intimidre_vari'];
        $abil['intrattenere1_check'] = $u['intrattenere1_check'];
        $abil['intrattenere1_gradi'] = $u['intrattenere1_gradi'];
        $abil['intrattenere1_vari'] = $u['intrattenere1_vari'];
        $abil['intrattenere1_name'] = $u['intrattenere1_name'];
        $abil['intrattenere2_check'] = $u['intrattenere2_check'];
        $abil['intrattenere2_gradi'] = $u['intrattenere2_gradi'];
        $abil['intrattenere2_vari'] = $u['intrattenere2_vari'];
        $abil['intrattenere2_name'] = $u['intrattenere2_name'];
        $abil['intrattenere3_check'] = $u['intrattenere3_check'];
        $abil['intrattenere3_gradi'] = $u['intrattenere3_gradi'];
        $abil['intrattenere3_vari'] = $u['intrattenere3_vari'];
        $abil['intrattenere3_name'] = $u['intrattenere3_name'];
        $abil['muoversi_check'] = $u['muoversi_check'];
        $abil['muoversi_gradi'] = $u['muoversi_gradi'];
        $abil['muoversi_vari'] = $u['muoversi_vari'];
        $abil['nascondersi_check'] = $u['nascondersi_check'];
        $abil['nascondersi_gradi'] = $u['nascondersi_gradi'];
        $abil['nascondersi_vari'] = $u['nascondersi_vari'];
        $abil['nuotare_check'] = $u['nuotare_check'];
        $abil['nuotare_gradi'] = $u['nuotare_gradi'];
        $abil['nuotare_vari'] = $u['nuotare_vari'];
        $abil['osservare_check'] = $u['osservare_check'];
        $abil['osservare_gradi'] = $u['osservare_gradi'];
        $abil['osservare_vari'] = $u['osservare_vari'];
        $abil['percepiri_check'] = $u['percepiri_check'];
        $abil['percepiri_gradi'] = $u['percepiri_gradi'];
        $abil['percepiri_vari'] = $u['percepiri_vari'];
        $abil['professione1_check'] = $u['professione1_check'];
        $abil['professione1_gradi'] = $u['professione1_gradi'];
        $abil['professione1_vari'] = $u['professione1_vari'];
        $abil['professione1_name'] = $u['professione1_name'];
        $abil['professione2_check'] = $u['professione2_check'];
        $abil['professione2_gradi'] = $u['professione2_gradi'];
        $abil['professione2_vari'] = $u['professione2_vari'];
        $abil['professione2_name'] = $u['professione2_name'];
        $abil['raccogliere_check'] = $u['raccogliere_check'];
        $abil['raccogliere_gradi'] = $u['raccogliere_gradi'];
        $abil['raccogliere_vari'] = $u['raccogliere_vari'];
        $abil['raggirare_check'] = $u['raggirare_check'];
        $abil['raggirare_gradi'] = $u['raggirare_gradi'];
        $abil['raggirare_vari'] = $u['raggirare_vari'];
        $abil['rapidita_check'] = $u['rapidita_check'];
        $abil['rapidita_gradi'] = $u['rapidita_gradi'];
        $abil['rapidita_vari'] = $u['rapidita_vari'];
        $abil['saltare_check'] = $u['saltare_check'];
        $abil['saltare_gradi'] = $u['saltare_gradi'];
        $abil['saltare_vari'] = $u['saltare_vari'];
        $abil['sapienza_check'] = $u['sapienza_check'];
        $abil['sapienza_gradi'] = $u['sapienza_gradi'];
        $abil['sapienza_vari'] = $u['sapienza_vari'];
        $abil['scalare_check'] = $u['scalare_check'];
        $abil['scalare_gradi'] = $u['scalare_gradi'];
        $abil['scalare_vari'] = $u['scalare_vari'];
        $abil['scassinare_check'] = $u['scassinare_check'];
        $abil['scassinare_gradi'] = $u['scassinare_gradi'];
        $abil['scassinare_vari'] = $u['scassinare_vari'];
        $abil['sopravvivenza_check'] = $u['sopravvivenza_check'];
        $abil['sopravvivenza_gradi'] = $u['sopravvivenza_gradi'];
        $abil['sopravvivenza_vari'] = $u['sopravvivenza_vari'];
        $abil['corde_check'] = $u['corde_check'];
        $abil['corde_gradi'] = $u['corde_gradi'];
        $abil['corde_vari'] = $u['corde_vari'];
        $abil['ogetti_check'] = $u['ogetti_check'];
        $abil['ogetti_gradi'] = $u['ogetti_gradi'];
        $abil['ogetti_vari'] = $u['ogetti_vari'];
        $abil['valutare_check'] = $u['valutare_check'];
        $abil['valutare_gradi'] = $u['valutare_gradi'];
        $abil['valutare_vari'] = $u['valutare_vari'];
        $abil['unknown1_check'] = $u['unknown1_check'];
        $abil['unknown1_gradi'] = $u['unknown1_gradi'];
        $abil['unknown1_vari'] = $u['unknown1_vari'];
        $abil['unknown1_name'] = $u['unknown1_name'];
        $abil['unknown2_check'] = $u['unknown2_check'];
        $abil['unknown2_gradi'] = $u['unknown2_gradi'];
        $abil['unknown2_vari'] = $u['unknown2_vari'];
        $abil['unknown2_name'] = $u['unknown2_name'];
        $abil['unknown3_check'] = $u['unknown3_check'];
        $abil['unknown3_gradi'] = $u['unknown3_gradi'];
        $abil['unknown3_vari'] = $u['unknown3_vari'];
        $abil['unknown3_name'] = $u['unknown3_name'];
        
        /* 
        $abil['_check'] = $u['_check'];
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
        $abil['art_fuga_check'] ? $query .= "art_fuga_check='checked'," : $query .= "art_fuga_check=NULL,";
        $abil['art_fuga_gradi'] ? $query .= "art_fuga_gradi='{$abil['art_fuga_gradi']}'," : $query .= "art_fuga_gradi=NULL,";
        $abil['art_fuga_vari'] ? $query .= "art_fuga_vari='{$abil['art_fuga_vari']}'," : $query .= "art_fuga_vari=NULL,";
        $abil['ascoltare_check'] ? $query .= "ascoltare_check='checked'," : $query .= "ascoltare_check=NULL,";
        $abil['ascoltare_gradi'] ? $query .= "ascoltare_gradi='{$abil['ascoltare_gradi']}'," : $query .= "ascoltare_gradi=NULL,";
        $abil['ascoltare_vari'] ? $query .= "ascoltare_vari='{$abil['ascoltare_vari']}'," : $query .= "ascoltare_vari=NULL,";
        $abil['camuffare_check'] ? $query .= "camuffare_check='checked'," : $query .= "camuffare_check=NULL,";
        $abil['camuffare_gradi'] ? $query .= "camuffare_gradi='{$abil['camuffare_gradi']}'," : $query .= "camuffare_gradi=NULL,";
        $abil['camuffare_vari'] ? $query .= "camuffare_vari='{$abil['camuffare_vari']}'," : $query .= "camuffare_vari=NULL,";
        $abil['cavalcare_check'] ? $query .= "cavalcare_check='checked'," : $query .= "cavalcare_check=NULL,";
        $abil['cavalcare_gradi'] ? $query .= "cavalcare_gradi='{$abil['cavalcare_gradi']}'," : $query .= "cavalcare_gradi=NULL,";
        $abil['cavalcare_vari'] ? $query .= "cavalcare_vari='{$abil['cavalcare_vari']}'," : $query .= "cavalcare_vari=NULL,";
        $abil['cercare_check'] ? $query .= "cercare_check='checked'," : $query .= "cercare_check=NULL,";
        $abil['cercare_gradi'] ? $query .= "cercare_gradi='{$abil['cercare_gradi']}'," : $query .= "cercare_gradi=NULL,";
        $abil['cercare_vari'] ? $query .= "cercare_vari='{$abil['cercare_vari']}'," : $query .= "cercare_vari=NULL,";
        $abil['concentrazione_check'] ? $query .= "concentrazione_check='checked'," : $query .= "concentrazione_check=NULL,";
        $abil['concentrazione_gradi'] ? $query .= "concentrazione_gradi='{$abil['concentrazione_gradi']}'," : $query .= "concentrazione_gradi=NULL,";
        $abil['concentrazione_vari'] ? $query .= "concentrazione_vari='{$abil['concentrazione_vari']}'," : $query .= "concentrazione_vari=NULL,";
        $abil['conoscenze1_check'] ? $query .= "conoscenze1_check='checked'," : $query .= "conoscenze1_check=NULL,";
        $abil['conoscenze1_gradi'] ? $query .= "conoscenze1_gradi='{$abil['conoscenze1_gradi']}'," : $query .= "conoscenze1_gradi=NULL,";
        $abil['conoscenze1_vari'] ? $query .= "conoscenze1_vari='{$abil['conoscenze1_vari']}'," : $query .= "conoscenze1_vari=NULL,";
        $abil['conoscenze1_name'] ? $query .= "conoscenze1_name='{$abil['conoscenze1_name']}'," : $query .= "conoscenze1_name=NULL,";
        $abil['conoscenze2_check'] ? $query .= "conoscenze2_check='checked'," : $query .= "conoscenze2_check=NULL,";
        $abil['conoscenze2_gradi'] ? $query .= "conoscenze2_gradi='{$abil['conoscenze2_gradi']}'," : $query .= "conoscenze2_gradi=NULL,";
        $abil['conoscenze2_vari'] ? $query .= "conoscenze2_vari='{$abil['conoscenze2_vari']}'," : $query .= "conoscenze2_vari=NULL,";
        $abil['conoscenze2_name'] ? $query .= "conoscenze2_name='{$abil['conoscenze2_name']}'," : $query .= "conoscenze2_name=NULL,";
        $abil['conoscenze3_check'] ? $query .= "conoscenze3_check='checked'," : $query .= "conoscenze3_check=NULL,";
        $abil['conoscenze3_gradi'] ? $query .= "conoscenze3_gradi='{$abil['conoscenze3_gradi']}'," : $query .= "conoscenze3_gradi=NULL,";
        $abil['conoscenze3_vari'] ? $query .= "conoscenze3_vari='{$abil['conoscenze3_vari']}'," : $query .= "conoscenze3_vari=NULL,";
        $abil['conoscenze3_name'] ? $query .= "conoscenze3_name='{$abil['conoscenze3_name']}'," : $query .= "conoscenze3_name=NULL,";
        $abil['conoscenze4_check'] ? $query .= "conoscenze4_check='checked'," : $query .= "conoscenze4_check=NULL,";
        $abil['conoscenze4_gradi'] ? $query .= "conoscenze4_gradi='{$abil['conoscenze4_gradi']}'," : $query .= "conoscenze4_gradi=NULL,";
        $abil['conoscenze4_vari'] ? $query .= "conoscenze4_vari='{$abil['conoscenze4_vari']}'," : $query .= "conoscenze4_vari=NULL,";
        $abil['conoscenze4_name'] ? $query .= "conoscenze4_name='{$abil['conoscenze4_name']}'," : $query .= "conoscenze4_name=NULL,";
        $abil['conoscenze5_check'] ? $query .= "conoscenze5_check='checked'," : $query .= "conoscenze5_check=NULL,";
        $abil['conoscenze5_gradi'] ? $query .= "conoscenze5_gradi='{$abil['conoscenze5_gradi']}'," : $query .= "conoscenze5_gradi=NULL,";
        $abil['conoscenze5_vari'] ? $query .= "conoscenze5_vari='{$abil['conoscenze5_vari']}'," : $query .= "conoscenze5_vari=NULL,";
        $abil['conoscenze5_name'] ? $query .= "conoscenze5_name='{$abil['conoscenze5_name']}'," : $query .= "conoscenze5_name=NULL,";
        $abil['decifrare_check'] ? $query .= "decifrare_check='checked'," : $query .= "decifrare_check=NULL,";
        $abil['decifrare_gradi'] ? $query .= "decifrare_gradi='{$abil['decifrare_gradi']}'," : $query .= "decifrare_gradi=NULL,";
        $abil['decifrare_vari'] ? $query .= "decifrare_vari='{$abil['decifrare_vari']}'," : $query .= "decifrare_vari=NULL,";
        $abil['diplomazia_check'] ? $query .= "diplomazia_check='checked'," : $query .= "diplomazia_check=NULL,";
        $abil['diplomazia_gradi'] ? $query .= "diplomazia_gradi='{$abil['diplomazia_gradi']}'," : $query .= "diplomazia_gradi=NULL,";
        $abil['diplomazia_vari'] ? $query .= "diplomazia_vari='{$abil['diplomazia_vari']}'," : $query .= "diplomazia_vari=NULL,";
        $abil['disattivare_check'] ? $query .= "disattivare_check='checked'," : $query .= "disattivare_check=NULL,";
        $abil['disattivare_gradi'] ? $query .= "disattivare_gradi='{$abil['disattivare_gradi']}'," : $query .= "disattivare_gradi=NULL,";
        $abil['disattivare_vari'] ? $query .= "disattivare_vari='{$abil['disattivare_vari']}'," : $query .= "disattivare_vari=NULL,";
        $abil['equilibrio_check'] ? $query .= "equilibrio_check='checked'," : $query .= "equilibrio_check=NULL,";
        $abil['equilibrio_gradi'] ? $query .= "equilibrio_gradi='{$abil['equilibrio_gradi']}'," : $query .= "equilibrio_gradi=NULL,";
        $abil['equilibrio_vari'] ? $query .= "equilibrio_vari='{$abil['equilibrio_vari']}'," : $query .= "equilibrio_vari=NULL,";
        $abil['falsificare_check'] ? $query .= "falsificare_check='checked'," : $query .= "falsificare_check=NULL,";
        $abil['falsificare_gradi'] ? $query .= "falsificare_gradi='{$abil['falsificare_gradi']}'," : $query .= "falsificare_gradi=NULL,";
        $abil['falsificare_vari'] ? $query .= "falsificare_vari='{$abil['falsificare_vari']}'," : $query .= "falsificare_vari=NULL,";
        $abil['guarire_check'] ? $query .= "guarire_check='checked'," : $query .= "guarire_check=NULL,";
        $abil['guarire_gradi'] ? $query .= "guarire_gradi='{$abil['guarire_gradi']}'," : $query .= "guarire_gradi=NULL,";
        $abil['guarire_vari'] ? $query .= "guarire_vari='{$abil['guarire_vari']}'," : $query .= "guarire_vari=NULL,";
        $abil['intimidre_check'] ? $query .= "intimidre_check='checked'," : $query .= "intimidre_check=NULL,";
        $abil['intimidre_gradi'] ? $query .= "intimidre_gradi='{$abil['intimidre_gradi']}'," : $query .= "intimidre_gradi=NULL,";
        $abil['intimidre_vari'] ? $query .= "intimidre_vari='{$abil['intimidre_vari']}'," : $query .= "intimidre_vari=NULL,";
        $abil['intrattenere1_check'] ? $query .= "intrattenere1_check='checked'," : $query .= "intrattenere1_check=NULL,";
        $abil['intrattenere1_gradi'] ? $query .= "intrattenere1_gradi='{$abil['intrattenere1_gradi']}'," : $query .= "intrattenere1_gradi=NULL,";
        $abil['intrattenere1_vari'] ? $query .= "intrattenere1_vari='{$abil['intrattenere1_vari']}'," : $query .= "intrattenere1_vari=NULL,";
        $abil['intrattenere1_name'] ? $query .= "intrattenere1_name='{$abil['intrattenere1_name']}'," : $query .= "intrattenere1_name=NULL,";
        $abil['intrattenere2_check'] ? $query .= "intrattenere2_check='checked'," : $query .= "intrattenere2_check=NULL,";
        $abil['intrattenere2_gradi'] ? $query .= "intrattenere2_gradi='{$abil['intrattenere2_gradi']}'," : $query .= "intrattenere2_gradi=NULL,";
        $abil['intrattenere2_vari'] ? $query .= "intrattenere2_vari='{$abil['intrattenere2_vari']}'," : $query .= "intrattenere2_vari=NULL,";
        $abil['intrattenere2_name'] ? $query .= "intrattenere2_name='{$abil['intrattenere2_name']}'," : $query .= "intrattenere2_name=NULL,";
        $abil['intrattenere3_check'] ? $query .= "intrattenere3_check='checked'," : $query .= "intrattenere3_check=NULL,";
        $abil['intrattenere3_gradi'] ? $query .= "intrattenere3_gradi='{$abil['intrattenere3_gradi']}'," : $query .= "intrattenere3_gradi=NULL,";
        $abil['intrattenere3_vari'] ? $query .= "intrattenere3_vari='{$abil['intrattenere3_vari']}'," : $query .= "intrattenere3_vari=NULL,";
        $abil['intrattenere3_name'] ? $query .= "intrattenere3_name='{$abil['intrattenere3_name']}'," : $query .= "intrattenere3_name=NULL,";
        $abil['muoversi_check'] ? $query .= "muoversi_check='checked'," : $query .= "muoversi_check=NULL,";
        $abil['muoversi_gradi'] ? $query .= "muoversi_gradi='{$abil['muoversi_gradi']}'," : $query .= "muoversi_gradi=NULL,";
        $abil['muoversi_vari'] ? $query .= "muoversi_vari='{$abil['muoversi_vari']}'," : $query .= "muoversi_vari=NULL,";
        $abil['nascondersi_check'] ? $query .= "nascondersi_check='checked'," : $query .= "nascondersi_check=NULL,";
        $abil['nascondersi_gradi'] ? $query .= "nascondersi_gradi='{$abil['nascondersi_gradi']}'," : $query .= "nascondersi_gradi=NULL,";
        $abil['nascondersi_vari'] ? $query .= "nascondersi_vari='{$abil['nascondersi_vari']}'," : $query .= "nascondersi_vari=NULL,";
        $abil['nuotare_check'] ? $query .= "nuotare_check='checked'," : $query .= "nuotare_check=NULL,";
        $abil['nuotare_gradi'] ? $query .= "nuotare_gradi='{$abil['nuotare_gradi']}'," : $query .= "nuotare_gradi=NULL,";
        $abil['nuotare_vari'] ? $query .= "nuotare_vari='{$abil['nuotare_vari']}'," : $query .= "nuotare_vari=NULL,";
        $abil['osservare_check'] ? $query .= "osservare_check='checked'," : $query .= "osservare_check=NULL,";
        $abil['osservare_gradi'] ? $query .= "osservare_gradi='{$abil['osservare_gradi']}'," : $query .= "osservare_gradi=NULL,";
        $abil['osservare_vari'] ? $query .= "osservare_vari='{$abil['osservare_vari']}'," : $query .= "osservare_vari=NULL,";
        $abil['percepiri_check'] ? $query .= "percepiri_check='checked'," : $query .= "percepiri_check=NULL,";
        $abil['percepiri_gradi'] ? $query .= "percepiri_gradi='{$abil['percepiri_gradi']}'," : $query .= "percepiri_gradi=NULL,";
        $abil['percepiri_vari'] ? $query .= "percepiri_vari='{$abil['percepiri_vari']}'," : $query .= "percepiri_vari=NULL,";
        $abil['professione1_check'] ? $query .= "professione1_check='checked'," : $query .= "professione1_check=NULL,";
        $abil['professione1_gradi'] ? $query .= "professione1_gradi='{$abil['professione1_gradi']}'," : $query .= "professione1_gradi=NULL,";
        $abil['professione1_vari'] ? $query .= "professione1_vari='{$abil['professione1_vari']}'," : $query .= "professione1_vari=NULL,";
        $abil['professione1_name'] ? $query .= "professione1_name='{$abil['professione1_name']}'," : $query .= "professione1_name=NULL,";
        $abil['professione2_check'] ? $query .= "professione2_check='checked'," : $query .= "professione2_check=NULL,";
        $abil['professione2_gradi'] ? $query .= "professione2_gradi='{$abil['professione2_gradi']}'," : $query .= "professione2_gradi=NULL,";
        $abil['professione2_vari'] ? $query .= "professione2_vari='{$abil['professione2_vari']}'," : $query .= "professione2_vari=NULL,";
        $abil['professione2_name'] ? $query .= "professione2_name='{$abil['professione2_name']}'," : $query .= "professione2_name=NULL,";
        $abil['raccogliere_check'] ? $query .= "raccogliere_check='checked'," : $query .= "raccogliere_check=NULL,";
        $abil['raccogliere_gradi'] ? $query .= "raccogliere_gradi='{$abil['raccogliere_gradi']}'," : $query .= "raccogliere_gradi=NULL,";
        $abil['raccogliere_vari'] ? $query .= "raccogliere_vari='{$abil['raccogliere_vari']}'," : $query .= "raccogliere_vari=NULL,";
        $abil['raggirare_check'] ? $query .= "raggirare_check='checked'," : $query .= "raggirare_check=NULL,";
        $abil['raggirare_gradi'] ? $query .= "raggirare_gradi='{$abil['raggirare_gradi']}'," : $query .= "raggirare_gradi=NULL,";
        $abil['raggirare_vari'] ? $query .= "raggirare_vari='{$abil['raggirare_vari']}'," : $query .= "raggirare_vari=NULL,";
        $abil['rapidita_check'] ? $query .= "rapidita_check='checked'," : $query .= "rapidita_check=NULL,";
        $abil['rapidita_gradi'] ? $query .= "rapidita_gradi='{$abil['rapidita_gradi']}'," : $query .= "rapidita_gradi=NULL,";
        $abil['rapidita_vari'] ? $query .= "rapidita_vari='{$abil['rapidita_vari']}'," : $query .= "rapidita_vari=NULL,";
        $abil['saltare_check'] ? $query .= "saltare_check='checked'," : $query .= "saltare_check=NULL,";
        $abil['saltare_gradi'] ? $query .= "saltare_gradi='{$abil['saltare_gradi']}'," : $query .= "saltare_gradi=NULL,";
        $abil['saltare_vari'] ? $query .= "saltare_vari='{$abil['saltare_vari']}'," : $query .= "saltare_vari=NULL,";
        $abil['sapienza_check'] ? $query .= "sapienza_check='checked'," : $query .= "sapienza_check=NULL,";
        $abil['sapienza_gradi'] ? $query .= "sapienza_gradi='{$abil['sapienza_gradi']}'," : $query .= "sapienza_gradi=NULL,";
        $abil['sapienza_vari'] ? $query .= "sapienza_vari='{$abil['sapienza_vari']}'," : $query .= "sapienza_vari=NULL,";
        $abil['scalare_check'] ? $query .= "scalare_check='checked'," : $query .= "scalare_check=NULL,";
        $abil['scalare_gradi'] ? $query .= "scalare_gradi='{$abil['scalare_gradi']}'," : $query .= "scalare_gradi=NULL,";
        $abil['scalare_vari'] ? $query .= "scalare_vari='{$abil['scalare_vari']}'," : $query .= "scalare_vari=NULL,";
        $abil['scassinare_check'] ? $query .= "scassinare_check='checked'," : $query .= "scassinare_check=NULL,";
        $abil['scassinare_gradi'] ? $query .= "scassinare_gradi='{$abil['scassinare_gradi']}'," : $query .= "scassinare_gradi=NULL,";
        $abil['scassinare_vari'] ? $query .= "scassinare_vari='{$abil['scassinare_vari']}'," : $query .= "scassinare_vari=NULL,";
        $abil['sopravvivenza_check'] ? $query .= "sopravvivenza_check='checked'," : $query .= "sopravvivenza_check=NULL,";
        $abil['sopravvivenza_gradi'] ? $query .= "sopravvivenza_gradi='{$abil['sopravvivenza_gradi']}'," : $query .= "sopravvivenza_gradi=NULL,";
        $abil['sopravvivenza_vari'] ? $query .= "sopravvivenza_vari='{$abil['sopravvivenza_vari']}'," : $query .= "sopravvivenza_vari=NULL,";
        $abil['corde_check'] ? $query .= "corde_check='checked'," : $query .= "corde_check=NULL,";
        $abil['corde_gradi'] ? $query .= "corde_gradi='{$abil['corde_gradi']}'," : $query .= "corde_gradi=NULL,";
        $abil['corde_vari'] ? $query .= "corde_vari='{$abil['corde_vari']}'," : $query .= "corde_vari=NULL,";
        $abil['ogetti_check'] ? $query .= "ogetti_check='checked'," : $query .= "ogetti_check=NULL,";
        $abil['ogetti_gradi'] ? $query .= "ogetti_gradi='{$abil['ogetti_gradi']}'," : $query .= "ogetti_gradi=NULL,";
        $abil['ogetti_vari'] ? $query .= "ogetti_vari='{$abil['ogetti_vari']}'," : $query .= "ogetti_vari=NULL,";
        $abil['valutare_check'] ? $query .= "valutare_check='checked'," : $query .= "valutare_check=NULL,";
        $abil['valutare_gradi'] ? $query .= "valutare_gradi='{$abil['valutare_gradi']}'," : $query .= "valutare_gradi=NULL,";
        $abil['valutare_vari'] ? $query .= "valutare_vari='{$abil['valutare_vari']}'," : $query .= "valutare_vari=NULL,";
        
        $abil['unknown1_check'] ? $query .= "unknown1_check='checked'," : $query .= "unknown1_check=NULL,";
        $abil['unknown1_gradi'] ? $query .= "unknown1_gradi='{$abil['unknown1_gradi']}'," : $query .= "unknown1_gradi=NULL,";
        $abil['unknown1_vari'] ? $query .= "unknown1_vari='{$abil['unknown1_vari']}'," : $query .= "unknown1_vari=NULL,";
        $abil['unknown1_name'] ? $query .= "unknown1_name='{$abil['unknown1_name']}'," : $query .= "unknown1_name=NULL,";
        $abil['unknown2_check'] ? $query .= "unknown2_check='checked'," : $query .= "unknown2_check=NULL,";
        $abil['unknown2_gradi'] ? $query .= "unknown2_gradi='{$abil['unknown2_gradi']}'," : $query .= "unknown2_gradi=NULL,";
        $abil['unknown2_vari'] ? $query .= "unknown2_vari='{$abil['unknown2_vari']}'," : $query .= "unknown2_vari=NULL,";
        $abil['unknown2_name'] ? $query .= "unknown2_name='{$abil['unknown2_name']}'," : $query .= "unknown2_name=NULL,";
        $abil['unknown3_check'] ? $query .= "unknown3_check='checked'," : $query .= "unknown3_check=NULL,";
        $abil['unknown3_gradi'] ? $query .= "unknown3_gradi='{$abil['unknown3_gradi']}'," : $query .= "unknown3_gradi=NULL,";
        $abil['unknown3_vari'] ? $query .= "unknown3_vari='{$abil['unknown3_vari']}'," : $query .= "unknown3_vari=NULL,";
        $abil['unknown3_name'] ? $query .= "unknown3_name='{$abil['unknown3_name']}'," : $query .= "unknown3_name=NULL,";
        /*
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
        $this->basic['classes'] = $u['classes'];
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
        
        $this->items['borsas'] = $u['borsas'];
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

        $this->abil['art_fuga_check'] = $u['art_fuga_check'];
        $this->abil['art_fuga_gradi'] = $u['art_fuga_gradi'];
        $this->abil['art_fuga_vari'] = $u['art_fuga_vari'];
        $this->abil['ascoltare_check'] = $u['ascoltare_check'];
        $this->abil['ascoltare_gradi'] = $u['ascoltare_gradi'];
        $this->abil['ascoltare_vari'] = $u['ascoltare_vari'];
        $this->abil['camuffare_check'] = $u['camuffare_check'];
        $this->abil['camuffare_gradi'] = $u['camuffare_gradi'];
        $this->abil['camuffare_vari'] = $u['camuffare_vari'];
        $this->abil['cavalcare_check'] = $u['cavalcare_check'];
        $this->abil['cavalcare_gradi'] = $u['cavalcare_gradi'];
        $this->abil['cavalcare_vari'] = $u['cavalcare_vari'];
        $this->abil['cercare_check'] = $u['cercare_check'];
        $this->abil['cercare_gradi'] = $u['cercare_gradi'];
        $this->abil['cercare_vari'] = $u['cercare_vari'];
        $this->abil['concentrazione_check'] = $u['concentrazione_check'];
        $this->abil['concentrazione_gradi'] = $u['concentrazione_gradi'];
        $this->abil['concentrazione_vari'] = $u['concentrazione_vari'];
        $this->abil['conoscenze1_check'] = $u['conoscenze1_check'];
        $this->abil['conoscenze1_gradi'] = $u['conoscenze1_gradi'];
        $this->abil['conoscenze1_vari'] = $u['conoscenze1_vari'];
        $this->abil['conoscenze1_name'] = $u['conoscenze1_name'];
        $this->abil['conoscenze2_check'] = $u['conoscenze2_check'];
        $this->abil['conoscenze2_gradi'] = $u['conoscenze2_gradi'];
        $this->abil['conoscenze2_vari'] = $u['conoscenze2_vari'];
        $this->abil['conoscenze2_name'] = $u['conoscenze2_name'];
        $this->abil['conoscenze3_check'] = $u['conoscenze3_check'];
        $this->abil['conoscenze3_gradi'] = $u['conoscenze3_gradi'];
        $this->abil['conoscenze3_vari'] = $u['conoscenze3_vari'];
        $this->abil['conoscenze3_name'] = $u['conoscenze3_name'];
        $this->abil['conoscenze4_check'] = $u['conoscenze4_check'];
        $this->abil['conoscenze4_gradi'] = $u['conoscenze4_gradi'];
        $this->abil['conoscenze4_vari'] = $u['conoscenze4_vari'];
        $this->abil['conoscenze4_name'] = $u['conoscenze4_name'];
        $this->abil['conoscenze5_check'] = $u['conoscenze5_check'];
        $this->abil['conoscenze5_gradi'] = $u['conoscenze5_gradi'];
        $this->abil['conoscenze5_vari'] = $u['conoscenze5_vari'];
        $this->abil['conoscenze5_name'] = $u['conoscenze5_name'];
        $this->abil['decifrare_check'] = $u['decifrare_check'];
        $this->abil['decifrare_gradi'] = $u['decifrare_gradi'];
        $this->abil['decifrare_vari'] = $u['decifrare_vari'];
        $this->abil['diplomazia_check'] = $u['diplomazia_check'];
        $this->abil['diplomazia_gradi'] = $u['diplomazia_gradi'];
        $this->abil['diplomazia_vari'] = $u['diplomazia_vari'];
        $this->abil['disattivare_check'] = $u['disattivare_check'];
        $this->abil['disattivare_gradi'] = $u['disattivare_gradi'];
        $this->abil['disattivare_vari'] = $u['disattivare_vari'];
        $this->abil['equilibrio_check'] = $u['equilibrio_check'];
        $this->abil['equilibrio_gradi'] = $u['equilibrio_gradi'];
        $this->abil['equilibrio_vari'] = $u['equilibrio_vari'];
        $this->abil['falsificare_check'] = $u['falsificare_check'];
        $this->abil['falsificare_gradi'] = $u['falsificare_gradi'];
        $this->abil['falsificare_vari'] = $u['falsificare_vari'];
        $this->abil['guarire_check'] = $u['guarire_check'];
        $this->abil['guarire_gradi'] = $u['guarire_gradi'];
        $this->abil['guarire_vari'] = $u['guarire_vari'];
        $this->abil['intimidre_check'] = $u['intimidre_check'];
        $this->abil['intimidre_gradi'] = $u['intimidre_gradi'];
        $this->abil['intimidre_vari'] = $u['intimidre_vari'];
        $this->abil['intrattenere1_check'] = $u['intrattenere1_check'];
        $this->abil['intrattenere1_gradi'] = $u['intrattenere1_gradi'];
        $this->abil['intrattenere1_vari'] = $u['intrattenere1_vari'];
        $this->abil['intrattenere1_name'] = $u['intrattenere1_name'];
        $this->abil['intrattenere2_check'] = $u['intrattenere2_check'];
        $this->abil['intrattenere2_gradi'] = $u['intrattenere2_gradi'];
        $this->abil['intrattenere2_vari'] = $u['intrattenere2_vari'];
        $this->abil['intrattenere2_name'] = $u['intrattenere2_name'];
        $this->abil['intrattenere3_check'] = $u['intrattenere3_check'];
        $this->abil['intrattenere3_gradi'] = $u['intrattenere3_gradi'];
        $this->abil['intrattenere3_vari'] = $u['intrattenere3_vari'];
        $this->abil['intrattenere3_name'] = $u['intrattenere3_name'];
        $this->abil['muoversi_check'] = $u['muoversi_check'];
        $this->abil['muoversi_gradi'] = $u['muoversi_gradi'];
        $this->abil['muoversi_vari'] = $u['muoversi_vari'];
        $this->abil['nascondersi_check'] = $u['nascondersi_check'];
        $this->abil['nascondersi_gradi'] = $u['nascondersi_gradi'];
        $this->abil['nascondersi_vari'] = $u['nascondersi_vari'];
        $this->abil['nuotare_check'] = $u['nuotare_check'];
        $this->abil['nuotare_gradi'] = $u['nuotare_gradi'];
        $this->abil['nuotare_vari'] = $u['nuotare_vari'];
        $this->abil['osservare_check'] = $u['osservare_check'];
        $this->abil['osservare_gradi'] = $u['osservare_gradi'];
        $this->abil['osservare_vari'] = $u['osservare_vari'];
        $this->abil['percepiri_check'] = $u['percepiri_check'];
        $this->abil['percepiri_gradi'] = $u['percepiri_gradi'];
        $this->abil['percepiri_vari'] = $u['percepiri_vari'];
        $this->abil['professione1_check'] = $u['professione1_check'];
        $this->abil['professione1_gradi'] = $u['professione1_gradi'];
        $this->abil['professione1_vari'] = $u['professione1_vari'];
        $this->abil['professione1_name'] = $u['professione1_name'];
        $this->abil['professione2_check'] = $u['professione2_check'];
        $this->abil['professione2_gradi'] = $u['professione2_gradi'];
        $this->abil['professione2_vari'] = $u['professione2_vari'];
        $this->abil['professione2_name'] = $u['professione2_name'];
        $this->abil['raccogliere_check'] = $u['raccogliere_check'];
        $this->abil['raccogliere_gradi'] = $u['raccogliere_gradi'];
        $this->abil['raccogliere_vari'] = $u['raccogliere_vari'];
        $this->abil['raggirare_check'] = $u['raggirare_check'];
        $this->abil['raggirare_gradi'] = $u['raggirare_gradi'];
        $this->abil['raggirare_vari'] = $u['raggirare_vari'];
        $this->abil['rapidita_check'] = $u['rapidita_check'];
        $this->abil['rapidita_gradi'] = $u['rapidita_gradi'];
        $this->abil['rapidita_vari'] = $u['rapidita_vari'];
        $this->abil['saltare_check'] = $u['saltare_check'];
        $this->abil['saltare_gradi'] = $u['saltare_gradi'];
        $this->abil['saltare_vari'] = $u['saltare_vari'];
        $this->abil['sapienza_check'] = $u['sapienza_check'];
        $this->abil['sapienza_gradi'] = $u['sapienza_gradi'];
        $this->abil['sapienza_vari'] = $u['sapienza_vari'];
        $this->abil['scalare_check'] = $u['scalare_check'];
        $this->abil['scalare_gradi'] = $u['scalare_gradi'];
        $this->abil['scalare_vari'] = $u['scalare_vari'];
        $this->abil['scassinare_check'] = $u['scassinare_check'];
        $this->abil['scassinare_gradi'] = $u['scassinare_gradi'];
        $this->abil['scassinare_vari'] = $u['scassinare_vari'];
        $this->abil['sopravvivenza_check'] = $u['sopravvivenza_check'];
        $this->abil['sopravvivenza_gradi'] = $u['sopravvivenza_gradi'];
        $this->abil['sopravvivenza_vari'] = $u['sopravvivenza_vari'];
        $this->abil['corde_check'] = $u['corde_check'];
        $this->abil['corde_gradi'] = $u['corde_gradi'];
        $this->abil['corde_vari'] = $u['corde_vari'];
        $this->abil['ogetti_check'] = $u['ogetti_check'];
        $this->abil['ogetti_gradi'] = $u['ogetti_gradi'];
        $this->abil['ogetti_vari'] = $u['ogetti_vari'];
        $this->abil['valutare_check'] = $u['valutare_check'];
        $this->abil['valutare_gradi'] = $u['valutare_gradi'];
        $this->abil['valutare_vari'] = $u['valutare_vari'];
        $this->abil['unknown1_check'] = $u['unknown1_check'];
        $this->abil['unknown1_gradi'] = $u['unknown1_gradi'];
        $this->abil['unknown1_vari'] = $u['unknown1_vari'];
        $this->abil['unknown1_name'] = $u['unknown1_name'];
        $this->abil['unknown2_check'] = $u['unknown2_check'];
        $this->abil['unknown2_gradi'] = $u['unknown2_gradi'];
        $this->abil['unknown2_vari'] = $u['unknown2_vari'];
        $this->abil['unknown2_name'] = $u['unknown2_name'];
        $this->abil['unknown3_check'] = $u['unknown3_check'];
        $this->abil['unknown3_gradi'] = $u['unknown3_gradi'];
        $this->abil['unknown3_vari'] = $u['unknown3_vari'];
        $this->abil['unknown3_name'] = $u['unknown3_name'];


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
