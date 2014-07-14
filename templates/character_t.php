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
            <div class="w44 fl mr">
                <input type="text" id="name" name="name" class="w44 h22" value="<?php echo $this->basic['name']; ?>" <?php echo $this->disabled; ?>>
                <div class="fs8 h01">NOME PERSONAGGIO</div>
            </div>
            <div class="fl mr w22">
                <input type="text" class="h22 w22" id="user_name" name="email" value="<?php echo $this->user_name ?>" disabled>
                <div class="fs8 h01">USER</div>
            </div>
            <div class="fl mr w22">
                <input type="text" class="h22 w22" id="" name="race" value="<?php echo $this->basic['race']; ?>">
                <div class="fs8 h01">RAZZA</div>
            </div>
            <div class="fl mr w22">
                <input type="text" class="h22 w22" id="" name="alignment" placeholder="ALLINEAMENTO" value="<?php echo $this->basic['alignment']; ?>">
                <div class="fs8 h01">ALLINEAMENTO</div>
            </div>
            <div class="fl mr w22">
                <input type="text" class="h22 w22" id="" name="divinity" placeholder="'DIVINITA'" value="<?php echo $this->basic['divinity']; ?>">
                <div class="fs8 h01">DIVINITA</div>
            </div>
            <div style="clear:both"></div>
            <div class="fl mr">
                <div id="class-container" class="ps-container w44">
                    <div id="class-content">
                        <div class="">
                            <input type="text" id="class" class="w32 fl mr" name="class" value="<?php echo $this->basic['class']; ?>">
                            <input type="text" id="level" class="w11" name="level" value="<?php echo $this->basic['level']; ?>">
                        </div>
                    </div>
                </div>
                <div class="fl w22 mr fs8">CLASSE</div>
                <div class="fl w25 fs8 bf">Add class</div>
                <div class="w11 fl fs8">LIV.</div>
            </div>


            <div class="fl">
                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="size" name="size" placeholder="TAGLIA" value="<?php echo $this->basic['size'] ?>" <?php echo $this->disabled ?>>
                    <div class="fs8 h01">TAGLIA</div>
                </div>
                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="" name="age" value="<?php echo $this->basic['age']; ?>">
                    <div class="fs8 h01">ETA</div>
                </div>
                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="" name="sex" value="<?php echo $this->basic['sex']; ?>">
                    <div class="fs8 h01">SESSO</div>
                </div>

                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="" name="height" value="<?php echo $this->basic['height']; ?>">
                    <div class="fs8 h01">ALTEZZA</div>
                </div>
                <div style="clear:both"></div>
                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="" name="weight" value="<?php echo $this->basic['weight']; ?>">
                    <div class="fs8 h01">PESO</div>
                </div>
                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="" name="eyes_color" value="<?php echo $this->basic['eyes_color']; ?>">
                    <div class="fs8 h01">OCCHI</div>
                </div>
                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="" name="hair_color" value="<?php echo $this->basic['hair_color']; ?>">
                    <div class="fs8 h01">CAPELLI</div>
                </div>
                <div class="fl mr w22">
                    <input type="text" class="h22 w22" id="" name="skin_color" value="<?php echo $this->basic['skin_color']; ?>">
                    <div class="fs8 h01">PELLE</div>
                </div>
                <div style="clear:both"></div>
            </div>
        </div>
        <div style="clear:both"></div>

        <div id="props" class='ac'>
            <div class="mb h31">
                <div class="h31 w12 black fl bf mr7">
                    <div class="first">FOR</div>
                    <div class="second fs6">FORZA</div>
                </div>

                <div class="r fl mr7 bf h31 w11"><div class="above w11 fs6">PUNTI</div><input type="text" pattern="[0-9]*" name="strength" value="<?php echo $this->props['strength']; ?>" class="h31 ac"></div>

                <div class="r fl mr7 bf h31 w11"><div class="above w11 fs6">MOD.</div>
                    4
                </div>
                <div class="h31 w11 black fl bf mr7">
                    <div class="first">PF</div>
                    <div class="second fs6">P.FERITA</div>
                </div>
                <div class='r h31 w11 mr7 fl bf'><div class="above w11 fs6">MAX</div>
                    <input name="max_hp" class="h31 w11 ac" placeholder="TOT" value="<?php echo $this->props['max_hp'] ?>" <?php echo $this->disabled ?>>
                </div>
                <div class='r h31 w22 mr7 fl bf'><div class="above w22 fs6">ATTUALI</div>
                    <input name="actual_hp" class="h31 w22 ac" placeholder="ATTUALI" value="<?php echo $this->props['actual_hp'] ?>" <?php echo $this->disabled ?>>
                </div>
                <div class="fl bf black h31 mr7 w22 fs8">RIDUZIONE DANNO</div>
                <input class="r fl mr7 bf h31 w11 ac cb" name="resistance_at_damage" value="<?php echo $this->props['resistance_at_damage'] ?>">
                <div class="fl bf black h31 mr7 w22 fs10">VELOCITA</div>
                <input class="r fl mr7 bf h31 w11 ac cb" name="speed" value="<?php echo $this->props['speed'] ?>">
            </div>
            <div style="clear:both"></div>



            <div class="h31 ac mb">
                <div class="h31 w12 black fl bf mr7">
                    <div class="first">DES</div>
                    <div class="second fs6">DESTREZZA</div>
                </div>

                <input type="text" pattern="[0-9]*" class="fl mr7 bf w11 h31 ac cb" name="dexterity" value="<?php echo $this->props['dexterity'] ?>">
                <div class="fl mr7 bf h31 w11">4</div>
                <div class="h31 w11 black fl bf mr7">
                    CA
                </div>
                <div class="r fl mr8 bf h31 w11"><div class='below fs6 w11'>TOT</div>4</div>
                <div class="r fl mr8 h31 w11"><div class='below fs6 w11'>BASE</div>10</div>
                <div class="r fl mr7 bf h31 w11"><div class='below fs6 w11'>ARMATURA</div>4</div>
                <div class="r fl mr7 bf h31 w11"><div class='below fs6 w11'>SCUDO</div>0</div>
                <div class="r fl mr7 bf h31 w11"><div class='below fs6 w11'>DESTREZZA</div>4</div>
                <div class="r fl mr7 bf h31 w11"><div class='below fs6 w11'>TAGLIA</div>4</div>
                <div class="r fl mr7 bf h31 w11"><div class='below fs6 w11'>NATURALE</div>
                    <input class="h31 w11 ac cb" name="natural_armor" value="<?php echo $this->props['natural_armor'] ?>"> 
                </div>
                <div class="r fl mr7 bf h31 w11"><div class='below fs6 w11'>DEVIAZIONE</div>
                    <input class="h31 w11 ac cb" name="deflection_armor" value="<?php echo $this->props['deflection_armor'] ?>">
                </div>
                <div class="r fl mr7 bf h31 w11"><div class='below fs6 w11'>VARI</div>
                    <input class="h31 w11 ac cb" name="var_armor" value="<?php echo $this->props['var_armor'] ?>">
                </div>
            </div>
            <div style="clear:both"></div>



            <div class="h31 ac mb">
                <div class="h31 w12 black fl bf mr7">
                    <div class="first">COS</div>
                    <div class="second fs6">COSTITUZIONE</div>
                </div>
                <input type="text" pattern="[0-9]*" class="fl mr7 bf w11 h31 ac cb" name="force" value="<?php echo $this->props['force'] ?>">
                <div class="fl mr7 bf h31 w11">4</div>
            </div>
            <div class="c"></div>
            <div class="h31 ac mb">
                <div class="h31 w12 black fl bf mr7">
                    <div class="first">INT</div>
                    <div class="second fs6">INTELLIGENZA</div>
                </div>

                <input type="text" pattern="[0-9]*" class="fl mr7 bf w11 h31 ac cb" name="intelligence" value="<?php echo $this->props['intelligence'] ?>">
                <div class="fl mr7 bf h31 w11"></div>
                <div class="h31 w22 black bf fl mr7">CONTATTO</div>
                <div class="fl mr7 bf h31 w11"></div>

            </div>
            <div style="clear:both"></div>

            <div class="h31 ac mb">
                <div class="h31 w12 black fl bf mr7">
                    <div class="first">SAG</div>
                    <div class="second fs6">SAGGEZZA</div>
                </div>

                <input type="text" pattern="[0-9]*" class="fl mr7 bf w11 h31 ac cb" name="wisdom" value="<?php echo $this->props['wisdom'] ?>">
                <div class="fl mr7 bf h31 w11"></div>
                <div class="h31 w22 black bf fl mr7">SPROVVISTA</div>
                <div class="fl mr7 bf h31 w11"></div>
            </div>
            <div style="clear:both"></div>

            <div class="h31 ac mb">
                <div class="h31 w12 black fl bf mr7">
                    <div class="first">CAR</div>
                    <div class="second">CARISMA</div>
                </div>
                <input type="text" pattern="[0-9]*" class="fl mr7 bf w11 h31 ac cb" name="charism" value="<?php echo $this->props['charism'] ?>">
                <div class="fl mr7 bf h31 w11"></div>
                <div class="h31 w11 black bf fl mr7">INIZ.</div>
                <div class="r fl mr7 bf h13 w11"><div class='below fs6 w11'>TOT</div>
                </div>
                <div class="r fl mr7 bf h13 w11"><div class='below fs6 w11'>DES</div>
                </div>
                <div class="r fl mr7 bf h13 w11"><div class='below fs6 w11'>VARI</div>
                </div>
            </div>
            <div style="clear:both"></div>
        </div>



        <div id="salvation" class='ac'>
            <div class='mb h11'>
                <div class='r bf fl h11 mr7 fs9 w12'><div class='above ac w12 fs6'>SALVEZZA</div><div class='black'>TEMPRA</div></div>
                <div class='r h11 fl bf w11 mr7'><div class='above w11 ac fs6'>TOT</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='above w11 ac fs6'>BASE</div><input class='h11'></div>
                <div class='r h11 fl bf w11 mr7'><div class='above w11 ac fs6'>MOD</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='above w11 ac fs6'>MAGIA</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='above w11 ac fs6'>VARI</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='above w11 ac fs6'>TEMP</div><div class=''></div></div>
            </div>
            <div class='mb h11'>
                <div class='bf fl h11 mr7 fs9 w12 black'>RIFLESSI</div>
                <div class='h11 fl bf w11 mr7'></div>
                <input class='h11 fl bf w11 mr7 cb'>
                <div class='h11 fl bf w11 mr7'></div>
                <input class='h11 fl bf w11 mr7 cb'>
                <input class='h11 fl bf w11 mr7 cb'>
                <input class='h11 fl bf w11 mr7 cb'>
            </div>
            <div class='mb h11'>
                <div class='bf fl h11 mr7 fs9 w12 black'>VOLONTA</div>
                <div class='h11 fl bf w11 mr7'></div>
                <input class='h11 fl bf w11 mr7 cb'>
                <div class='h11 fl bf w11 mr7'></div>
                <input class='h11 fl bf w11 mr7 cb'>
                <input class='h11 fl bf w11 mr7 cb'>
                <input class='h11 fl bf w11 mr7 cb'>
            </div>

            <div class='mb h11'>
                <div class='bf fl h11 mr7 fs9 w21 black'>ATTACCO BASE</div>
                <input class='h11 fl bf w11 mr7 cb'>
                <div class='fl h11 w11 mr9'></div>
                <div class='w22 bf fl h11 mr7 fs9 black'>RES. INC.</div>
                <input class='h11 fl bf w11 mr7 cb'>
            </div>

            <div class='mb h11'>
                <div class='bf fl h11 mr7 fs9 w12 black'>LOTTA</div>
                <div class='r h11 fl bf w11 mr7'><div class='below ac w11 fs6'>TOT</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='below2 ac w11 fs6'>ATTACCO<br/>BASE</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='below ac w11 fs6'>FOR.</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='below ac w11 fs6'>TAGLIA</div><div class=''></div></div>
                <div class='r h11 fl bf w11 mr7'><div class='below ac w11 fs6'>VARI</div><div class=''></div></div>
            </div>
        </div>
        <div style="clear:both"></div>

        <div class='bf blocki cn fs8 mb'>
            <div class='mb h31'>
                <div class="br bb w31 fl mr">
                    <div class="black height1_1 fs10">ATTACCO MISCHIA 1</div>
                    <input class="height2_1">
                </div>
                <div class="w11 fl mr br bb bl">
                    <div class="black height1_1">BONUS</div>
                    <div class="height2_1 fs10">6</div>
                </div>
                <div class="w22 fl mr br bb bl">
                    <div class="black height1_1">DANNI</div>
                    <div class="height2_1">
                        <input class='w11 fl h21'>
                        <div class='fl w01 fs10'>+</div>
                        <div class='fl width1_1 fs10'>4</div>
                    </div>
                </div>
                <div class="w11 fl bb bl">
                    <div class="black height1_1">CRITICO</div>
                    <div class="height2_1"></div>
                </div>
            </div>
            <div class='mb h12 al'>
                <div class='br bb bt fl mr7 w31'>
                    <div class='fl mr9 w21'>POTENZ. MAGICO</div>
                    <input class='w11 fl'>
                </div>
                <div class='br bb bt bl fl mr7 w22'>
                    <div class='fl mr w11'>MANI</div>
                    <input class='w11'>
                </div>
                <div class='bb bt bl fl w22'>
                    <div class='fl mr w11'>GITTATA</div>
                    <input class='w11'>
                </div>
            </div>
            <div class='mb h12 al'>
                <div class='br bb bt fl mr7 w31'>
                    <div class='fl w23'>MALUS COMB.2 ARMI</div>
                    <input class='w11 fl'>
                </div>
                <div class='br bb bt bl fl mr7 w22'>
                    <div class='fl mr w11'>PERFETTO</div>
                    <input class='w11'>
                </div>
                <div class='bb bt bl fl w22'>
                    <div class='fl mr w11'>TIPO</div>
                    <input class='w11'>
                </div>
            </div>
            <div class='h12 al'>
                <div class='br bt fl mr7 w31'>
                    <div class='fl w11 mr9'>NOTE</div>
                    <input class='w21 fl'>
                </div>
                <div class='br bt bl fl mr7 w22'>
                    <div class='fl mr w11'>B / M</div>
                    <input class='w11'>
                </div>
                <div class=' bt bl fl w22'>
                    <div class='fl mr w11'>TAGLIA</div>
                    <input class='w11'>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>



        <!--################# THINGS ##########################-->

        <div class='bf blocki cn fs8 mb'>
            <div class='mb h31'>
                <div class="br bb w31 fl mr">
                    <div class="black height1_1 fs10">ARMATURA / TUNICA</div>
                    <input class="height2_1">
                </div>
                <div class="w11 fl mr br bb bl">
                    <div class="black height1_1">BONUS</div>
                    <div class="height2_1 fs10">6</div>
                </div>
                <div class="w11 fl mr br bb bl">
                    <div class="black height1_1">DES. MAX</div>
                    <div class="height2_1 fs10">6</div>
                </div>
                <div class="w11 fl mr8 br bb bl">
                    <div class="black height1_1">PENAL</div>
                    <div class="height2_1 fs10">6</div>
                </div>
                <div class="w11 fl bb bl">
                    <div class="black height1_1">VEL</div>
                    <div class="height2_1"></div>
                </div>
            </div>
            <div class='h31'>
                <div class="h31 w32 mr7 fl">
                    <div class="h11 w32 br bb bt mb bsbb">
                    </div>
                    <div class="h11 w32 br bt bsbb">
                    </div>
                </div>
                <div class="w11 fl mr7 br bt bl">
                    <div class="black height1_1">MAG</div>
                    <div class="height2_1 fs10">6</div>
                </div>
                <div class="w11 fl mr7 br bt bl">
                    <div class="black height1_1">FAL.INC.</div>
                    <div class="height2_1 fs10">6</div>
                </div>
                <div class="h31 w22 fl">
                    <div class="h11 bl bb bt mb bsbb">
                    </div>
                    <div class="h11 bl bt bsbb">
                    </div>
                </div>
            </div>
        </div>
        <div style="clear:both"></div>

        <div class='bf blocki cn fs8 mb'>
            <div class="fl h11 bb br mr7 mb w31 black">COPRICAPO
            </div>
            <div class="fl h11 bl bb mb w40">
            </div>
            <div style="clear:both"></div>
            <div class="fl bt br h11 w51">PROPRIETA'
            </div>
            <div class="fl bt h11 w52"></div>
        </div>
        <div style="clear:both"></div>

        <div class="bf blocki cn">
            <div class="bb br black w53 h11 fl">EQUIPAGGIAMENTO INDOSSATO</div>
            <div class="bb black w11 h11 fl">PESO</div>
            <div style="clear:both"></div>
            <div class="bb br w53 h11 fl">0</div>
            <div class="bb w11 h11 fl"></div>
            <div style="clear:both"></div>
            <div class="bb br black w53 h11 fl">'ZAINO/BORSA</div>
            <div class="bb black w11 h11 fl">PESO</div>
            <div style="clear:both"></div>
            <div class="br w53 h11 fl">0</div>
            <div class="bw11 h11 fl"></div>
            <div style="clear:both"></div>
        </div>
        <div style="clear:both"></div>
        <div class="fl w31 bl br bb mr">
            <div class="w24 fl black">DENARO
            </div>
            <div class="w11 fl black ">PESO
            </div>
            <div style="clear:both"></div>
            <div class="w12 fl br">MR
            </div>
            <div class="w14 fl br">h
            </div>
            <div class="w11 fl">0
            </div>
            <div style="clear:both"></div>
        </div>
        <div class="fl w40 bl br bb">
            <div>adlkf
            </div>
        </div>
        <div style="clear:both"></div>



        <!--################# RIGHT COLUMN ##########################-->

        <div style='top: 250px; position: absolute; left: 408px;
             width: 469px;'>
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
                dsflkjasd
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