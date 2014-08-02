<div id="character">

    <div id="avatar-container">
        <img class="unit-avatar" id='<?php echo $this->uid; ?>-avatar' height="150" width="150" src="<?php
        if ($this->uid && file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/units/{$this->uid}.png"))
            echo "/images/units/{$this->uid}.png";
        else if ($this->monster_id && file_exists($_SERVER['DOCUMENT_ROOT'] . "/images/units/{$this->monster_id}.png"))
            echo "/images/units/{$this->monster_id}.png";
        ?>">
        <div id='choose-avatar-image'>Choose</div>
        <div id='upload-avatar-image'>Upload</div>
        <div id='choosed-avatar-image'></div>
        <input type='file' id='hidden-avatar-uploader'>
    </div>
    <div class="post-unit" id='post-unit'>Send</div>

    <form id='unit-form' method="post" action="/character.php">
        <input type='hidden' id='uid' name='uid' value='<?php echo $this->uid; ?>'>
        <input type='hidden' name='a' value='edit_unit'>
        <input type='hidden' name='type' value='<?php echo $this->type; ?>'>

        <div id="basic">
            <div class="w289 fl mr9">
                <input type="text" id="name" name="name" class="w289 h28" value="<?php echo $this->basic['name']; ?>" <?php echo $this->disabled; ?>>
                <div class="fs8 h17 bt">NOME PERSONAGGIO</div>
            </div>
            <div class="fl mr9 w129">
                <input type="text" class="h28 w129" id="user_name" name="email" value="<?php echo $this->user_name ?>" disabled>
                <div class="fs8 h17 bt">USER</div>
            </div>
            <div class="fl mr9 w129">
                <input type="text" class="h28 w129" id="" name="race" value="<?php echo $this->basic['race']; ?>">
                <div class="fs8 h17 bt">RAZZA</div>
            </div>
            <div class="fl mr9 w129">
                <input type="text" class="h28 w129" id="" name="alignment" value="<?php echo $this->basic['alignment']; ?>">
                <div class="fs8 h17 bt">ALLINEAMENTO</div>
            </div>
            <div class="fl mr9 w129">
                <input type="text" class="h28 w129" id="" name="divinity" value="<?php echo $this->basic['divinity']; ?>">
                <div class="fs8 h17 bt">DIVINITA</div>
            </div>
            <div style="clear:both"></div>
            <div class="fl mr9">
                <div id="class-container" class="ps-container w289 h85">
                    <div id="class-content">
                        <div class="" id="classes-and-levels">
                            <?php
                            if (isset($this->basic['classes'])) {
                                $t = $this->basic['classes'];
                                $t = preg_split("/\n/", $t);
                                $count = 0;
                                foreach ($t as $class) {
                                    if ($class == "")
                                        continue;
                                    $c = preg_split("/\t/", $class);
                                    $count++;
                                    echo "                                   
                                    <div class='bb'>
                                <input type='text' id='class$count' class='w219 h28 fl mr9' placeholder='CLASSE' name='class$count'  value='{$c[0]}'>
                                <input type='text' id='level$count' class='w60 h28 ac' placeholder='LIV.' name='level$count' value='{$c[1]}'>
                            </div>
                        
                        ";
                                }
                                echo "<input type='hidden' id='NoClasses' name='NoClasses' value='$count'>";
                            }
                            else {
                                ?>
                                <input type="hidden" id="NoClasses" name="NoClasses" value="1">
                                <div class="bb">
                                    <input type="text" id="class1" class="w219 h28 fl mr9" placeholder="CLASSE" name="class1"  value="<?php echo $this->basic['class']; ?>">
                                    <input type="text" id="level1" class="w60 h28 ac" placeholder="LIV." name="level1" value="<?php echo $this->basic['level']; ?>">
                                </div>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="fl w289 fs8 bf" id="add-class">Add class</div>
            </div>


            <div class="fl">
                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="size" name="size" placeholder="TAGLIA" value="<?php echo $this->basic['size'] ?>" <?php echo $this->disabled ?>>
                    <div class="fs8 h27 bt">TAGLIA</div>
                </div>
                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="" name="age" value="<?php echo $this->basic['age']; ?>">
                    <div class="fs8 h27 bt">ETA</div>
                </div>
                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="" name="sex" value="<?php echo $this->basic['sex']; ?>">
                    <div class="fs8 h27 bt">SESSO</div>
                </div>

                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="" name="height" value="<?php echo $this->basic['height']; ?>">
                    <div class="fs8 h27 bt">ALTEZZA</div>
                </div>
                <div style="clear:both"></div>
                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="" name="weight" value="<?php echo $this->basic['weight']; ?>">
                    <div class="fs8 h17 bt">PESO</div>
                </div>
                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="" name="eyes_color" value="<?php echo $this->basic['eyes_color']; ?>">
                    <div class="fs8 h17 bt">OCCHI</div>
                </div>
                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="" name="hair_color" value="<?php echo $this->basic['hair_color']; ?>">
                    <div class="fs8 h17 bt">CAPELLI</div>
                </div>
                <div class="fl mr9 w29">
                    <input type="text" class="h28 w129" id="" name="skin_color" value="<?php echo $this->basic['skin_color']; ?>">
                    <div class="fs8 h17 bt">PELLE</div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div style="clear:both"></div>

        <div id="props" class='ac'>
            <div class="mb h39">
                <div class="h37 w80 black fl bf mr7">
                    <div class="fs12 mt3">FOR</div>
                    <div class="fs6">FORZA</div>
                </div>

                <div class="r fl mr9 bf h37 w58"><div class="above w58 fs6">PUNTI</div><input type="text" pattern="[0-9]*" name="strength" value="<?php echo $this->props['strength']; ?>" id="strength-points" class="h37 ac fs13"></div>

                <div class="r fl mr9 bf h37 w58 fs13"><div class="above w58 fs6">MOD.</div><div id="strength-mod" class="mt9"></div></div>
                <div class="h37 w58 black fl bf mr9">
                    <div class="fs12 mt3">PF</div>
                    <div class="fs6">P.FERITA</div>
                </div>
                <div class='r h37 w58 mr9 fl bf'><div class="above w58 fs6">MAX</div>
                    <input name="max_hp" class="h37 w58 fs12 ac" value="<?php echo $this->props['max_hp'] ?>" <?php echo $this->disabled ?>>
                </div>
                <div class='r h37 w127 mr9 fl bf'><div class="above w127 fs6">ATTUALI</div>
                    <input name="actual_hp" class="h37 w127 ac fs12" value="<?php echo $this->props['actual_hp'] ?>" <?php echo $this->disabled ?>>
                </div>
                <div class="fl bf black h37 mr9 w125 fs10"><div class="mt9">RIDUZIONE DANNO</div></div>
                <input class="r fl mr9 bf h37 w58 ac cb fs12" name="resistance_at_damage" value="<?php echo $this->props['resistance_at_damage'] ?>">
                <div class="fl bf black h37 mr9 w127 fs10"><div class="mt9">VELOCITA</div></div>
                <input class="r fl bf h37 w58 ac cb fs12" name="speed" value="<?php echo $this->props['speed'] ?>">
            </div>
            <div style="clear:both"></div>



            <div class="h39 ac mb">
                <div class="h37 w80 black fl bf mr7">
                    <div class="fs12 mt3">DES</div>
                    <div class="fs6">DESTREZZA</div>
                </div>

                <input type="text" pattern="[0-9]*" class="fl mr9 bf w58 h37 fs13 ac cb" name="dexterity" id="dexterity-points" value="<?php echo $this->props['dexterity'] ?>">
                <div class="fl mr9 bf h37 w58"><div id="dexterity-mod" class="fs13 mt9"></div></div>
                <div class="h37 w58 black fl bf mr9">
                    <div class="mt9">CA</div>
                </div>
                <div class="r fl mr9 bf h37 w58"><div class='below fs6 w58'>TOT</div><div class="fs13 mt9">T</div></div>
                <div class="r fl mr9 h39 w60"><div class='below fs6 w60'>BASE</div><div class="fs13 mt9">10</div></div>
                <div class="r fl mr9 bf h37 w58"><div class='below fs6 w58'>ARMATURA</div><div class="fs13 mt9">T</div></div>
                <div class="r fl mr11 bf h37 w56"><div class='below fs6 w56'>SCUDO</div><div class="fs13 mt9">T</div></div>
                <div class="r fl mr9 bf h37 w56"><div class='below fs6 w56'>DESTREZZA</div><div class="fs13 mt9" id="dexterity-armor"></div></div>
                <div class="r fl mr9 bf h37 w58"><div class='below fs6 w58'>TAGLIA</div><div class="fs13 mt9" id="size-armor"></div></div>
                <div class="r fl mr11 bf h37 w58"><div class='below fs6 w56'>NATURALE</div>
                    <input class="h37 w56 ac cb fs13" name="natural_armor" value="<?php echo $this->props['natural_armor'] ?>"> 
                </div>
                <div class="r fl mr9 bf h37 w56"><div class='below fs6 w56'>DEVIAZIONE</div>
                    <input class="h37 w56 ac cb fs13" name="deflection_armor" value="<?php echo $this->props['deflection_armor'] ?>">
                </div>
                <div class="r fl bf h37 w58"><div class='below fs6 w58'>VARI</div>
                    <input class="h37 w58 ac cb fs13" name="var_armor" value="<?php echo $this->props['var_armor'] ?>">
                </div>
            </div>
            <div style="clear:both"></div>



            <div class="h39 ac mb">
                <div class="h37 w80 black fl bf mr">
                    <div class="fs12 mt3">COS</div>
                    <div class="fs6">COSTITUZIONE</div>
                </div>
                <input type="text" pattern="[0-9]*" class="fl mr9 bf w58 h37 fs13 ac cb" name="force" id="force-points" value="<?php echo $this->props['force'] ?>">
                <div class="fl mr9 bf h37 w58"><div id="force-mod" class="mt9 fs13"></div></div>
            </div>
            <div class="c"></div>
            <div class="h39 ac mb">
                <div class="h37 w80 black fl bf mr">
                    <div class="fs12 mt3">INT</div>
                    <div class="fs6">INTELLIGENZA</div>
                </div>

                <input type="text" pattern="[0-9]*" class="fl mr9 bf w58 h37 fs13 ac cb" name="intelligence" id="intelligence-points" value="<?php echo $this->props['intelligence'] ?>">
                <div class="fl mr9 bf h37 w58"><div class="mt9 fs13" id="intelligence-mod"></div></div>
                <div class="h37 w127 black bf fl mr9"><div class="fs12 mt9">CONTATTO</div></div>
                <div class="fl bf h37 w58"><div class="mt9 fs13">T</div></div>

            </div>
            <div style="clear:both"></div>

            <div class="h39 ac mb">
                <div class="h37 w80 black fl bf mr">
                    <div class="fs12 mt3">SAG</div>
                    <div class="fs6">SAGGEZZA</div>
                </div>

                <input type="text" pattern="[0-9]*" class="fl mr9 bf w58 h37 fs13 ac cb" name="wisdom" id="wisdom-points" value="<?php echo $this->props['wisdom'] ?>">
                <div class="fl mr9 bf h37 w58"><div class="mt9 fs13" id="wisdom-mod"></div></div>
                <div class="h37 w127 black bf fl mr9"><div class="fs12 mt9">SPROVVISTA</div></div>
                <div class="fl bf h37 w58"><div class="mt9 fs13">T</div></div>
            </div>
            <div style="clear:both"></div>

            <div class="h39 ac mb">
                <div class="h37 w80 black fl bf mr">
                    <div class="fs12 mt3">CAR</div>
                    <div class="fs6">CARISMA</div>
                </div>
                <input type="text" pattern="[0-9]*" class="fl mr9 bf w58 h37 fs13 ac cb" name="charism" id="charism-points" value="<?php echo $this->props['charism'] ?>">
                <div class="fl mr9 bf h37 w58"><div class="mt9 fs13" id="charism-mod"></div></div>
                <div class="h37 w58 black bf fl mr9"><div class="mt9 fs12">INIZ.</div></div>
                <div class="r fl mr9 bf h24 w58"><div class='below fs6 w58'>TOT</div>
                    <div class="mt3" id="tot-initiative"></div>
                </div>
                <div class="r fl mr9 bf h24 w58"><div class='below fs6 w58'>DES</div>
                    <div id="dexterity-initiative" class="mt3"></div>
                </div>
                <div class="r fl mr9 bf h24 w58"><div class='below fs6 w58'>VARI</div>
                    <input type="text" class="w58 fs10 ac h24" name="var_initiative" id="var-initiative" value="<?php echo $this->props['var_initiative'] ?>">
                </div>
            </div>
            <div style="clear:both"></div>
        </div>



        <div id="salvation" class='ac'>
            <div class='mb9 h19'>
                <div class='r bf fl h19 mr9 fs9 w80 black'><div class='above ac w80 fs6'>SALVEZZA</div><div class="mt2">TEMPRA</div></div>
                <div class='r h19 fl bf w58 mr9'><div class='above w58 ac fs6'>TOT</div><div class="fs10 mt2" id='tempra-tot'></div></div>
                <div class='r h19 fl bf w58 mr9'><div class='above w58 ac fs6'>BASE</div><input class='h19 fs10 ac' name="tempra_base" id="tempra-base" value="<?php echo $this->salvezza['tempra_base'] ?>"></div>
                <div class='r h19 fl bf w58 mr9'><div class='above w58 ac fs6'>MOD</div><div class="fs10 mt2" id="tempra-mod"></div></div>
                <div class='r h19 fl bf w58 mr9'><div class='above w58 ac fs6'>MAGIA</div><input class='h19 fs10 ac' name="tempra_magia" id="tempra-magia" value="<?php echo $this->salvezza['tempra_magia'] ?>"></div>
                <div class='r h19 fl bf w58 mr9'><div class='above w58 ac fs6'>VARI</div><input class='h19 fs10 ac' name="tempra_vari" id="tempra-vari" value="<?php echo $this->salvezza['tempra_vari'] ?>"></div>
                <div class='r h19 fl bf w58 mr9'><div class='above w58 ac fs6'>TEMP</div><input class='h19 fs10 ac' name="tempra_temp" id="tempra-temp" value="<?php echo $this->salvezza['tempra_temp'] ?>"></div>
            </div>
            <div class='mb9 h19'>
                <div class='bf fl h19 mr9 fs9 w80 black'><div class='mt2'>RIFLESSI</div></div>
                <div class='h19 fl bf w58 mr9 fs10'><div class='mt2' id='riflessi-tot'></div></div>
                <input class='h19 fl bf w58 mr9 cb ac fs10' name="riflessi_base" id="riflessi-base" value="<?php echo $this->salvezza['riflessi_base'] ?>">
                <div class='h19 fl bf w58 mr9'><div class='mt2 fs10' id="riflessi-mod"></div></div>
                <input class='h19 fl bf w58 mr9 ac cb' name="riflessi_magia" id="riflessi-magia" value="<?php echo $this->salvezza['riflessi_magia'] ?>">
                <input class='h19 fl bf w58 mr9 ac cb' name="riflessi_vari" id="riflessi-vari" value="<?php echo $this->salvezza['riflessi_vari'] ?>">
                <input class='h19 fl bf w58 mr9 ac cb' name="riflessi_temp" id="riflessi-temp" value="<?php echo $this->salvezza['riflessi_temp'] ?>">
            </div>
            <div class='mb9 h19'>
                <div class='bf fl h19 mr9 fs9 w80 black'><div class='mt2'>VOLONTA</div></div>
                <div class='h19 fl bf w58 mr9 fs10'><div class='mt2' id='volonta-tot'></div></div>
                <input class='h19 fl bf w58 mr9 cb ac fs10' name="volonta_base" id="volonta-base" value="<?php echo $this->salvezza['volonta_base'] ?>">
                <div class='h19 fl bf w58 mr9'><div class='mt2 fs10' id="volonta-mod"></div></div>
                <input class='h19 fl bf w58 mr9 ac cb' name="volonta_magia" id="volonta-magia" value="<?php echo $this->salvezza['volonta_magia'] ?>">
                <input class='h19 fl bf w58 mr9 ac cb' name="volonta_vari" id="volonta-vari" value="<?php echo $this->salvezza['volonta_vari'] ?>">
                <input class='h19 fl bf w58 mr9 ac cb' name="volonta_temp" id="volonta-temp" value="<?php echo $this->salvezza['volonta_temp'] ?>">
            </div>

            <div class='mb9 h19'>
                <div class='bf fl h19 mr9 fs9 w149 black'><div class="mt2 fs11">ATTACCO BASE</div></div>
                <input class='h19 fl bf w58 mr9 ac cb' name='attaco_base' id='attaco-base' value="<?php echo $this->salvezza['attaco_base'] ?>">
                <div class='fl h19 w60 mr9'></div>
                <div class='w127 bf fl h19 mr9 fs11 black'>RES. INC.</div>
                <input class='h19 fl bf w58 mr9 cb' name="res_inc" id="res-inc" value="<?php echo $this->salvezza['res_inc'] ?>">
            </div>

            <div class='mb9 h19'>
                <div class='bf fl h19 mr9 fs9 w80 black'><div class='mt2'>LOTTA</div></div>
                <div class='r h19 fl bf w58 mr9'><div class='below ac w58 fs6'>TOT</div><div class='fs10 mt2'>T</div></div>
                <div class='r h19 fl bf w58 mr9'><div class='below2 ac w58 fs6'>ATTACCO<br/>BASE</div><div class="fs10 mt2" id='lotta-attaco-base'>T</div></div>
                <div class='r h19 fl bf w58 mr9'><div class='below ac w58 fs6'>FOR.</div><div id="lotta-for"></div></div>
                <div class='r h19 fl bf w58 mr9'><div class='below ac w58 fs6'>TAGLIA</div><div class='fs10'>T</div></div>
                <div class='r h19 fl bf w58 mr9'><div class='below ac w58 fs6'>VARI</div><input name="lotta_vari" class="h19" id="lotta-vari" value="<?php echo $this->salvezza['lotta_vari'] ?>"></div>
            </div>
        </div>
        <div style="clear:both"></div>

        <div class='bf blocki cn fs8 mb'>
            <div class='mb9 h31'>
                <div class="mb9 br bb w218 fl mr9">
                    <div class="black bb h19 fl w218"><div class="fs10 mt3">ATTACCO MISCHIA 1</div></div>
                    <input class="h29" name="attacco_mischia_1" id="attacco-mischia-1" value="<?php echo $this->mischia['attacco_mischia_1'] ?>">
                </div>
                <div class="w58 fl mr9 br bb bl">
                    <div class="black h19 bb w58"><div class="fs10">BONUS</div></div>
                    <div class="h29 w58"><div class="fs10">T</div></div>
                </div>
                <div class="w127 fl mr9 br bb bl">
                    <div class="black h19">DANNI</div>
                    <div class="h29">
                        <input class='w58 fl h29 ac' name="danni_mischia_1" id="danni-mischia-1" value="<?php echo $this->mischia['danni_mischia_1'] ?>">
                        <div class='fl fs10'>+</div>
                        <div class='fl w58 fs10'>T</div>
                    </div>
                </div>
                <div class="w58 fl bb bl">
                    <div class="black h19">CRITICO</div>
                    <input class="h29 ac" name="critico_mischia_1" id="critico-mischia-1" value="<?php echo $this->mischia['critico_mischia_1'] ?>">
                </div>
            </div>
            <div style="clear:both"></div>
            <div class='mb9 al'>
                <div class='mb9 br bb bt fl h19 mr9 w218'>
                    <div class='fl w159'>POTENZ. MAGICO</div>
                    <input class='w58 fl ac h19' name="magico_mischia_1" id="magico-mischia-1" value="<?php echo $this->mischia['magico_mischia_1'] ?>">
                </div>
                <div class='br bb bt bl fl mr9 w127 h19'>
                    <div class='fl mr9 w58'>MANI</div>
                    <input class='w58 h19 ac' name="mani_mischia_1" id="mani-mischia-1" value="<?php echo $this->mischia['mani_mischia_1'] ?>">
                </div>
                <div class='bb bt bl fl h19 w127'>
                    <div class='fl mr9 w58'>GITTATA</div>
                    <input class='w58 h19 ac' name="gittata_mischia_1" id="gittata-mischia-1" value="<?php echo $this->mischia['gittata_mischia_1'] ?>">
                </div>
            </div>
            <div style="clear:both"></div>
            <div class='mb9 h19 al'>
                <div class='br bb bt fl mr9 mb9 w218'>
                    <div class='fl w159'>MALUS COMB.2 ARMI</div>
                    <input class='w58 h19 fl ac' name="malus_mischia_1" id="malus-mischia-1" value="<?php echo $this->mischia['malus_mischia_1'] ?>">
                </div>
                <div class='br bb bt bl fl mr7 w127 h19'>
                    <div class='fl mr9 w58'>PERFETTO</div>
                    <input class='w58 h19 ac' name="perfetto_mischia_1" id="perfetto-mischia-1" value="<?php echo $this->mischia['perfetto_mischia_1'] ?>">
                </div>
                <div class='bb bt bl fl w127 h19'>
                    <div class='fl mr9 w58'>TIPO</div>
                    <input class='w58 h19 ac' name="tipo_mischia_1" id="tipo-mischia-1" value="<?php echo $this->mischia['tipo_mischia_1'] ?>">
                </div>
            </div>
            <div style="clear:both"></div>
            <div class='h19 al'>
                <div class='br bt h19 fl mr9 w218'>
                    <div class='fl w58 mr9'>NOTE</div>
                    <input class='w150 h19 fl' name="note_mischia_1" id="note-mischia-1" value="<?php echo $this->mischia['note_mischia_1'] ?>">
                </div>
                <div class='br bt bl fl mr9 w127'>
                    <div class='fl mr9 w58'>B / M</div>
                    <input class='w58 h19 ac' name="bm_mischia_1" id="bm-mischia-1" value="<?php echo $this->mischia['bm_mischia_1'] ?>">
                </div>
                <div class='bt bl fl h19 w127'>
                    <div class='fl mr9 w58'>TAGLIA</div>
                    <input class='w58 h19 ac' name="taglia_mischia_1" id="taglia-mischia-1" value="<?php echo $this->mischia['taglia_mischia_1'] ?>">
                </div>
            </div>
        </div>
        <div style="clear:both"></div>



        <!--################# THINGS ##########################-->

        <div class='bf blocki cn fs8 mb'>
            <div class='mb h31'>
                <div class="mb9 br bb w218 fl mr9">
                    <div class="black fs10 h19 w218">ARMATURA / TUNICA</div>
                    <input class="h29" name='tunica_armatura'>
                </div>
                <div class="w58 fl mr9 br bb bl">
                    <div class="black h19">BONUS</div>
                    <div class=""><input class="h29 w58 ac fs10" type='text' name='tunica_bonus'></div>
                </div>
                <div class="w58 fl mr9 br bb bl">
                    <div class="black h19">DES. MAX</div>
                    <div class="h29 fs10"><input class="h29 fs10 ac w58" type='text' name='tunica_des'></div>
                </div>
                <div class="w58 fl mr9 br bb bl">
                    <div class="black h19">PENAL</div>
                    <div class="h29 fs10"><input class="h29 fs10 ac w58" type='text' name='tunica_penal'></div>
                </div>
                <div class="w58 fl bb bl">
                    <div class="black h19">VEL</div>
                    <div class="h29"><input class="h29 fs10 ac w58" type='text' name='tunica_vel'></div>
                </div>
            </div>
            <div style="clear:both"></div>
            <div class=''>
                <div class="w218 mr9 fl">
                    <div class="h19 w218 br bb bt mb9">
                        <div class='fl w70 mr9'>PROPRIETA</div>
                        <input class='fl w139 h19' type='text' name='tunica_proprieta'>
                    </div>
                    <input type="text" class="h19 w218 br bt cb">
                </div>
                <div class="w58 fl mr9 br bt bl">
                    <div class="black h19 bb">MAG</div>
                    <div class="h29 fs10"><input class="h29 fs10 ac" type='text' name='tunica_mag'></div>
                </div>
                <div class="w58 fl mr9 br bt bl">
                    <div class="black h19 bb">FAL.INC.</div>
                    <div class="h29 fs10"><input class="h29 fs10 ac" type='text' name='tunica_fal'></div>
                </div>
                <div class="h31 bt w127 fl">
                    <div class="h19 bl bb mb9">
                        <div class="fl mr9 al w58">TIPO</div>
                        <input class="fl w58 h19" type='text' name='tunica_tipo'>
                    </div>
                    <div class="h19 bl bt">
                        <div class="fl w58 mr9 al">PESO</div>
                        <div class="fl w58">T</div>
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">COPRICAPO
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">OCCHI
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">COLLANA
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">VESTE
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">CINTURA
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">MANTELLO
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">BRACCIALI
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">GUANTI
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">ANELLO 1
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">ANELLO 2
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class='bf mb9 blocki cn'>
            <div class="fl h19 bb br mr9 mb9 w218 black">STIVALI
            </div>
            <input class="fl h19 bl bb cb w265" id="" name="" value="<?php echo $this->items[''] ?>">
            <div style="clear:both"></div>
            <div class="fl bt br h19 w70 fs8">PROPRIETA
            </div>
            <input class="h19 fl bt cb w421" id="-proprieta" name="_proprieta" value="<?php echo $this->items['_proprieta'] ?>"></div>
        <div style="clear:both"></div>

        <div class="bf w494">
            <div class="bb br black w435 h19 fl ac">EQUIPAGGIAMENTO INDOSSATO</div>
            <div class="bb black w58 h19 fl ac fs8">PESO</div>
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>
            <div class="bb br w435 h19 fl" id="-peso">T</div>
            <input type="text" class="cb bb w58 h19 fl" name="_peso" id="-peso" value="<?php echo $this->items['_peso']; ?>">
            <div style="clear:both"></div>

            <div class="bb br black w435 h19 fl ac">ZAINO/BORSA</div>
            <div class="bb black w58 h19 fl fs8 ac">PESO</div>
            <div style="clear: both"></div>
            <div class="fl mr9">
                <div id="borsa-container" class="ps-container w494 h100">
                    <div id="borsa-content">
                        <div class="" id="borsas">
                            <?php
                            if (isset($this->items['borsas'])) {
                                $t = $this->items['borsas'];
                                $t = preg_split("/\n/", $t);
                                $count = 0;
                                foreach ($t as $class) {
                                    if ($class == "")
                                        continue;
                                    $c = preg_split("/\t/", $class);
                                    $count++;
                                    echo "                                   
                            <input type='text' id='borsa$count' class='cb w435 bb br h19 fl' placeholder='Item' name='borsa$count' value='{$c[0]}'>
                                    <input type='text' class='cb bb w58 h19 fl' id='borsa$count-peso' placeholder='Peso' name='borsa{$count}_peso' value='{$c[1]}'>
                                <div style='clear: both'></div>
                        
                        ";
                                }
                                echo "<input type='hidden' id='zaino' name='zaino' value='$count'>";
                            }
                            else {
                                ?>
                                <input type='hidden' id='zaino' name='zaino' value='1'>

                                <input type='text' id='borsa1' class='cb w435 bb br h19 fl' placeholder='Item' name='borsa1'>
                                <input type='text' id='borsa1-peso' class='cb bb w58 h19 fl' id='borsa1-peso' placeholder='Peso' name='borsa1_peso'>
                                <div style='clear: both'></div>

                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="fl w494 fs12 h19 ac" id="add-borsa">Add item</div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
        <div class="fl w218 bl br bb mr9">
            <div class="w161 fl br black fs11 h19">DENARO
            </div>
            <div class="w56 fl black h19 fs8 ac">PESO
            </div>
            <div style="clear:both"></div>
            <div class="w80 fl br bb h19 fs10">MR</div>
            <input class="w80 fl bb cb h19 ac">
            <div class="w56 bb bl fl h19">T</div>
            <div style="clear:both"></div>
            <div class="w80 fl br bb h19 fs10">MA</div>
            <input class="w80 fl bb cb h19 ac">
            <div class="w56 bb bl fl h19">T</div>
            <div style="clear:both"></div>
            <div class="w80 fl br bb h19 fs10">MO</div>
            <input class="w80 fl bb cb h19 ac">
            <div class="w56 bb bl fl h19">T</div>
            <div style="clear:both"></div>
            <div class="w80 fl br h19 fs10">MP</div>
            <input class="w80 fl cb h19 ac">
            <div class="w56 bl fl h19">T</div>
            <div style="clear:both"></div>
        </div>
        <div class="fl w bl br bb w265">
            <div class="h39 w208 fl black bb ac"><div class="mt9">PESO TOTALE</div></div>
            <div class="w56 fl h39 ac bb"><div class="fs13 mt9">T</div></div>
            <div style="clear:both"></div>
            <div class="ac h19 w80 fl br bb fs8">S.TESTA</div>
            <div class="ac h19 w45 fl br bb"></div>
            <div class="ac h19 w80 fl br bb fs8">LEGGERO</div>
            <div class="h19 w56 fl bb">T</div>
            <div style="clear:both"></div>
            <div class="ac w80 fl br bb">S.TESTA</div>
        </div>
        <div style="clear:both"></div>



        <!--################# RIGHT COLUMN ##########################-->

        <div style='top: 280px; position: absolute; left: 550px;
             width: 602px;'>
            <div id="abilities_head" class="black bf">
                <div id="vertical" class="fs9" style="position: absolute; left: 5px; top: 0;">DI CLASSE</div>
                <div style='position: absolute; top: 0; left: 50px; font-size: 20pt;'>ABILITIES</div>
                <div style='position: absolute; left: 50px; top: 40px;'>NOME ABILITA</div>
                <div style='position: absolute; left: 200px;'>GRADI MAX:</div>
                <div style='position: absolute; left: 300px;' class='ac'>4<br/><span class='fs6'>CLASSE</span></div>
                <div style='position: absolute; left: 350px;' class='ac'>4<br/><span class='fs6'>NON CLASSE</span></div>
                <div style='position: absolute; left: 180px; top: 50px;'>CAR</div>
            </div>
            <div id="abilities" style='' class="bf mb">
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='acrobazia_check' <?php echo $this->abil['acrobazia_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Acrobazia</div>
                    <div class='fl w58 fs8 mr10'>DES*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='acrobazia_gradi' value="<?php echo $this->abil['acrobazia_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='acrobazia_vari' value="<?php echo $this->abil['acrobazia_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='add_animali_check' <?php echo $this->abil['add_animali_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Add. Animali</div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='add_animali_gradi' value="<?php echo $this->abil['add_animali_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='add_animali_vari' value="<?php echo $this->abil['add_animali_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='artigianato1_check' <?php echo $this->abil['artigianato1_check'] ?>></div>
                    <div class='fl w127 fs9'>Artigianato</div>
                    <div class='w70 fl mr10'><input class='h13 w70' name='artigianato1_name' value="<?php echo $this->abil['artigianato1_name'] ?>"></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='artigianato1_gradi' value="<?php echo $this->abil['artigianato1_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='artigianato1_vari' value="<?php echo $this->abil['artigianato1_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='artigianato2_check' <?php echo $this->abil['artigianato2_check'] ?>></div>
                    <div class='fl w127 fs9'>Artigianato</div>
                    <div class='w70 fl mr10'><input class='h13 w70' name='artigianato2_name' value="<?php echo $this->abil['artigianato2_name'] ?>"></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='artigianato2_gradi' value="<?php echo $this->abil['artigianato2_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='artigianato2_vari' value="<?php echo $this->abil['artigianato2_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='artigianato3_check' <?php echo $this->abil['artigianato3_check'] ?>></div>
                    <div class='fl w127 fs9'>Artigianato</div>
                    <div class='w70 fl mr10'><input class='h13 w70' name='artigianato3_name' value="<?php echo $this->abil['artigianato3_name'] ?>"></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='artigianato3_gradi' value="<?php echo $this->abil['artigianato3_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='artigianato3_vari' value="<?php echo $this->abil['artigianato3_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='art_fuga_check' <?php echo $this->abil['art_fuga_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Artista della fuga</div>
                    <div class='fl w58 fs8 mr10'>DES*</div>
                    <div class='w57 bf fl ac fs10 mr10'></div>
                    <div class='w58 fl ac fs10 mr11'></div>
                    <input type='text' class='w58 h13 fl mr11' name='art_fuga_gradi' value="<?php echo $this->abil['art_fuga_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='art_fuga_vari' value="<?php echo $this->abil['art_fuga_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='ascoltare_check' <?php echo $this->abil['ascoltare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Ascoltare</div>
                    <div class='fl w58 fs8 mr10'>SAG</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='ascoltare_gradi' value="<?php echo $this->abil['ascoltare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='ascoltare_vari' value="<?php echo $this->abil['ascoltare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='camuffare_check' <?php echo $this->abil['camuffare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Camuffare</div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='camuffare_gradi' value="<?php echo $this->abil['camuffare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='camuffare_vari' value="<?php echo $this->abil['camuffare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='cavalcare_check' <?php echo $this->abil['cavalcare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Cavalcare</div>
                    <div class='fl w58 fs8 mr10'>DES</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='cavalcare_gradi' value="<?php echo $this->abil['cavalcare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='cavalcare_vari' value="<?php echo $this->abil['cavalcare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='cercare_check' <?php echo $this->abil['cercare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Cercare</div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='cercare_gradi' value="<?php echo $this->abil['cercare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='cercare_vari' value="<?php echo $this->abil['cercare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='concentrazione_check' <?php echo $this->abil['concentrazione_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Concentrazione</div>
                    <div class='fl w58 fs8 mr10'>COS</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='concentrazione_gradi' value="<?php echo $this->abil['concentrazione_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='concentrazione_vari' value="<?php echo $this->abil['concentrazione_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='conoscenze1_check' <?php echo $this->abil['conoscenze1_check'] ?>></div>
                    <div class='fl w127 fs9'>Conoscenze</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='conoscenze1_gradi' value="<?php echo $this->abil['conoscenze1_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='conoscenze1_vari' value="<?php echo $this->abil['conoscenze1_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='conoscenze2_check' <?php echo $this->abil['conoscenze2_check'] ?>></div>
                    <div class='fl w127 fs9'>Conoscenze</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='conoscenze2_gradi' value="<?php echo $this->abil['conoscenze2_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='conoscenze2_vari' value="<?php echo $this->abil['conoscenze2_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='conoscenze3_check' <?php echo $this->abil['conoscenze3_check'] ?>></div>
                    <div class='fl w127 fs9'>Conoscenze</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='conoscenze3_gradi' value="<?php echo $this->abil['conoscenze3_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='conoscenze3_vari' value="<?php echo $this->abil['conoscenze3_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='conoscenze4_check' <?php echo $this->abil['conoscenze4_check'] ?>></div>
                    <div class='fl w127 fs9'>Conoscenze</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='conoscenze4_gradi' value="<?php echo $this->abil['conoscenze4_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='conoscenze4_vari' value="<?php echo $this->abil['conoscenze4_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='conoscenze5_check' <?php echo $this->abil['conoscenze5_check'] ?>></div>
                    <div class='fl w127 fs9'>Conoscenze</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='conoscenze5_gradi' value="<?php echo $this->abil['conoscenze5_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='conoscenze5_vari' value="<?php echo $this->abil['conoscenze5_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='decifrare_check' <?php echo $this->abil['decifrare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Decifrare scritture</div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='decifrare_gradi' value="<?php echo $this->abil['decifrare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='decifrare_vari' value="<?php echo $this->abil['decifrare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='diplomazia_check' <?php echo $this->abil['diplomazia_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Diplomazia</div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='diplomazia_gradi' value="<?php echo $this->abil['diplomazia_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='diplomazia_vari' value="<?php echo $this->abil['diplomazia_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='disattivare_check' <?php echo $this->abil['disattivare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Disattivare congegni</div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='disattivare_gradi' value="<?php echo $this->abil['disattivare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='disattivare_vari' value="<?php echo $this->abil['disattivare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='equilibrio_check' <?php echo $this->abil['equilibrio_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Equilibrio</div>
                    <div class='fl w58 fs8 mr10'>DES*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='equilibrio_gradi' value="<?php echo $this->abil['equilibrio_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='equilibrio_vari' value="<?php echo $this->abil['equilibrio_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='falsificare_check' <?php echo $this->abil['falsificare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Falsificare</div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='falsificare_gradi' value="<?php echo $this->abil['falsificare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='falsificare_vari' value="<?php echo $this->abil['falsificare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='guarire_check' <?php echo $this->abil['guarire_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Guarire</div>
                    <div class='fl w58 fs8 mr10'>SAG</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='guarire_gradi' value="<?php echo $this->abil['guarire_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='guarire_vari' value="<?php echo $this->abil['guarire_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='intimidre_check' <?php echo $this->abil['intimidre_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Intimidre</div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='intimidre_gradi' value="<?php echo $this->abil['intimidre_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='intimidre_vari' value="<?php echo $this->abil['intimidre_vari'] ?>">
                </div>
                <div style="clear:both"></div>


                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='intrattenere1_check' <?php echo $this->abil['intrattenere1_check'] ?>></div>
                    <div class='fl w127 fs9'>Intrattenere</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='intrattenere1_gradi' value="<?php echo $this->abil['intrattenere1_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='intrattenere1_vari' value="<?php echo $this->abil['intrattenere1_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='intrattenere2_check' <?php echo $this->abil['intrattenere2_check'] ?>></div>
                    <div class='fl w127 fs9'>Intrattenere</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='intrattenere2_gradi' value="<?php echo $this->abil['intrattenere2_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='intrattenere2_vari' value="<?php echo $this->abil['intrattenere2_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='intrattenere3_check' <?php echo $this->abil['intrattenere3_check'] ?>></div>
                    <div class='fl w127 fs9'>Intrattenere</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='intrattenere3_gradi' value="<?php echo $this->abil['intrattenere3_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='intrattenere3_vari' value="<?php echo $this->abil['intrattenere3_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='muoversi_check' <?php echo $this->abil['muoversi_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Muoversi silenziosamente</div>
                    <div class='fl w58 fs8 mr10'>DES*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='muoversi_gradi' value="<?php echo $this->abil['muoversi_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='muoversi_vari' value="<?php echo $this->abil['muoversi_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='nascondersi_check' <?php echo $this->abil['nascondersi_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Nascondersi</div>
                    <div class='fl w58 fs8 mr10'>DES*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='nascondersi_gradi' value="<?php echo $this->abil['nascondersi_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='nascondersi_vari' value="<?php echo $this->abil['nascondersi_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='nuotare_check' <?php echo $this->abil['nuotare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Nuotare</div>
                    <div class='fl w58 fs8 mr10'>FOR*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='nuotare_gradi' value="<?php echo $this->abil['nuotare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='nuotare_vari' value="<?php echo $this->abil['nuotare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='osservare_check' <?php echo $this->abil['osservare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Osservare</div>
                    <div class='fl w58 fs8 mr10'>SAG</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='osservare_gradi' value="<?php echo $this->abil['osservare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='osservare_vari' value="<?php echo $this->abil['osservare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='percepiri_check' <?php echo $this->abil['percepiri_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Percepire intenzioni</div>
                    <div class='fl w58 fs8 mr10'>SAG</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='percepiri_gradi' value="<?php echo $this->abil['percepiri_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='percepiri_vari' value="<?php echo $this->abil['percepiri_vari'] ?>">
                </div>
                <div style="clear:both"></div>



                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='professione1_check' <?php echo $this->abil['professione1_check'] ?>></div>
                    <div class='fl w127 fs9'>Professione</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>SAG</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='professione1_gradi' value="<?php echo $this->abil['professione1_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='professione1_vari' value="<?php echo $this->abil['professione1_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='professione2_check' <?php echo $this->abil['professione2_check'] ?>></div>
                    <div class='fl w127 fs9'>Professione</div>
                    <div class='w70 fl mr10'><input class='h13 w70'></div>
                    <div class='fl w58 fs8 mr10'>SAG</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='professione2_gradi' value="<?php echo $this->abil['professione2_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='professione2_vari' value="<?php echo $this->abil['professione2_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='raccogliere_check' <?php echo $this->abil['raccogliere_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Raccogliere informazioni</div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='raccogliere_gradi' value="<?php echo $this->abil['raccogliere_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='raccogliere_vari' value="<?php echo $this->abil['raccogliere_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='raggirare_check' <?php echo $this->abil['raggirare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Raggirare</div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='raggirare_gradi' value="<?php echo $this->abil['raggirare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='raggirare_vari' value="<?php echo $this->abil['raggirare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='rapidita_check' <?php echo $this->abil['rapidita_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Rapidità di mano</div>
                    <div class='fl w58 fs8 mr10'>DES*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='rapidita_gradi' value="<?php echo $this->abil['rapidita_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='rapidita_vari' value="<?php echo $this->abil['rapidita_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='saltare_check' <?php echo $this->abil['saltare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Saltare</div>
                    <div class='fl w58 fs8 mr10'>FOR*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='saltare_gradi' value="<?php echo $this->abil['saltare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='saltare_vari' value="<?php echo $this->abil['saltare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='sapienza_check' <?php echo $this->abil['sapienza_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Sapienza magica</div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='sapienza_gradi' value="<?php echo $this->abil['sapienza_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='sapienza_vari' value="<?php echo $this->abil['sapienza_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='scalare_check' <?php echo $this->abil['scalare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Scalare</div>
                    <div class='fl w58 fs8 mr10'>FOR*</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='scalare_gradi' value="<?php echo $this->abil['scalare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='scalare_vari' value="<?php echo $this->abil['scalare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='scassinare_check' <?php echo $this->abil['scassinare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Scassinare serrature</div>
                    <div class='fl w58 fs8 mr10'>DES</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='scassinare_gradi' value="<?php echo $this->abil['scassinare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='scassinare_vari' value="<?php echo $this->abil['scassinare_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='sopravvivenza_check' <?php echo $this->abil['sopravvivenza_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Sopravvivenza</div>
                    <div class='fl w58 fs8 mr10'>SAG</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='sopravvivenza_gradi' value="<?php echo $this->abil['sopravvivenza_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='sopravvivenza_vari' value="<?php echo $this->abil['sopravvivenza_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='corde_check' <?php echo $this->abil['corde_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Utilizzare corde</div>
                    <div class='fl w58 fs8 mr10'>DES</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='corde_gradi' value="<?php echo $this->abil['corde_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='corde_vari' value="<?php echo $this->abil['corde_gradi'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='ogetti_check' <?php echo $this->abil['ogetti_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Utilizzare oggetti magici</div>
                    <div class='fl w58 fs8 mr10'>CAR</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='ogetti_gradi' value="<?php echo $this->abil['ogetti_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='ogetti_vari' value="<?php echo $this->abil['ogetti_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='valutare_check' <?php echo $this->abil['valutare_check'] ?>></div>
                    <div class='fl w127 mr80 fs9'>Valutare</div>
                    <div class='fl w58 fs8 mr10'>INT</div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='valutare_gradi' value="<?php echo $this->abil['valutare_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='valutare_vari' value="<?php echo $this->abil['valutare_vari'] ?>">
                </div>
                <div style="clear:both"></div>



                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='unknown1_check' <?php echo $this->abil['unknown1_check'] ?>></div>
                    <div class='fl w196 mr10 fs9'><input class='w196 h13'></div>
                    <div class='fl w58 fs8 mr11'><input class='h13 w58'></div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='unknown1_gradi' value="<?php echo $this->abil['unknown1_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='unknown1_vari' value="<?php echo $this->abil['unknown1_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='unknown2_check' <?php echo $this->abil['unknown2_check'] ?>></div>
                    <div class='fl w196 mr10 fs9'><input class='w196 h13'></div>
                    <div class='fl w58 fs8 mr11'><input class='h13 w58'></div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='unknown2_gradi' value="<?php echo $this->abil['unknown2_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='unknown2_vari' value="<?php echo $this->abil['unknown2_vari'] ?>">
                </div>
                <div style="clear:both"></div>
                <div class='h13 mt12 mb12'>
                    <div class='w15 fl mr11'><input type='checkbox' name='unknown3_check' <?php echo $this->abil['unknown3_check'] ?>></div>
                    <div class='fl w196 mr10 fs9'><input class='w196 h13'></div>
                    <div class='fl w58 fs8 mr11'><input class='h13 w58'></div>
                    <div class='w57 bf fl ac fs10 mr10'>t</div>
                    <div class='w58 fl ac fs10 mr11'>b</div>
                    <input type='text' class='w58 h13 fl mr11' name='unknown3_gradi' value="<?php echo $this->abil['unknown3_gradi'] ?>">
                    <input type='text' class='w58 h13 fl' name='unknown3_vari' value="<?php echo $this->abil['unknown3_vari'] ?>">
                </div>
                <div style="clear:both"></div>
            </div>

            <div class='black w41 fl bf ac'>
                TALENTI
            </div>
            <div class='black w42 fl bb bt bl ac'>CAPACITA' SPECIALI
            </div>
            <input class='fl bl br bb w41'>
            <input class='fl br bb w42'>

            <div class='c'></div>
            <div class='mt7'>
                <div class='black ac'>
                    INCANTESIMI
                </div>
                <div class='w41 fl fs9'>DOMINI / SCUOLE DI SPECIALIZZAZIONE:</div>
                <div class='w42 fl'>fd</div>
                <div class='w13 fl bf black'>1&deg;</div>
                <div class='h31 w43 fl br'>sdfasf</div>
                <div class='c'></div>
                <div class='w13 fl bf black'>2&deg;</div>
                <div class='h31 w43 fl br bt'>sdfasf</div>
            </div>
            <div class='c'></div>

            <div class='w35 black fl fs10 ac mr7'>SALVEZZA INCANTESIMI</div>
            <div class='w11 bf fl mr7'></div>
            <div class='w34 black fl fs10 ac mr7'>FALLIMENTO ARCANI</div>
            <div class='w11 bf fl fs10 ac'>10%</div>
            <div class='c'></div>

            <div class='w37 fs8 ac fl'>INC. CONOSCIUTI</div>
            <div class='w11 fs8 ac fl mr9'>CD</div>
            <div class='w11 fs8 ac fl mr9'>LIVELLO</div>
            <div class='w34 fs8 ac fl mr7'>INC. AL GIORNO</div>
            <div class='w11 fs8 ac fl'>BONUS</div>

            <div class='fl w11 bf ac ml50 mr48'>k</div>
            <div class='fl w11 bf ac mr8'>k</div>
            <div class='fl w11 ac mr9'>k</div>
            <div class='fl w11 bf ac ml52 mr61'>k</div>
            <div class='fl w11 ac'>k</div>

        </div>

    </form>

</div>