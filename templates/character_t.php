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
            <input type="text" id="name" name="name" placeholder="NOME PERSONAGGIO" value="<?php echo $this->basic['name'];?>" <?php echo $this->disabled;?>>
            <input type="text" id="user_name" placeholder="email" value="<?php echo $this->user_name ?>" disabled>
            <input type="text" id="" placeholder="RAZZA">
            <input type="text" id="" placeholder="ALLINEAMENTO">
            <input type="text" id="" placeholder="'DIVINITA'"><br/>
            <input type="text" id="class" placeholder="classe">
            <input type="text" id="level" placeholder="LIV.">
            <input type="text" id="size" name="size" placeholder="TAGLIA" value="<?php echo $this->basic['size']?>" <?php echo $this->disabled?>>
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

                <div class="rel block tall narrow"><div class="above narrow">'PUNTI</div><input type="text" pattern="[0-9]*" class=""></div>

                <div class="rel block tall narrow"><div class="above narrow">MOD.</div></div>
                <div class="tall narrow black block">PF</div>
                <input name="max_hp" class="tall narrow block" placeholder="TOT" value="<?php echo $this->props['max_hp']?>" <?php echo $this->disabled?>>
                <input name="actual_hp" class="tall medium block" placeholder="ATTUALI" value="<?php echo $this->props['actual_hp']?>" <?php echo $this->disabled?>>
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
                <div class="tall narrow black block">CA</div>
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
                <div class="tall narrow block black">INIZ.</div>
            </div>
            <div style="clear:both"></div>
        </div>
        <div id="basic2">
            <div class="tall string">
            </div>                 
        </div>
        <div style="clear:both"></div>

        <div id="">
            <div class='string small'>
                <div class='rel small half-medium block'><div class='above half-medium'>SALVEZZA</div><div class='black'>TEMPRA</div></div>
                <div class='rel small narrow block'><div class='above narrow'>TOT</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='above narrow'>BASE</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='above narrow'>MAGIA</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='above narrow'>VARI</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='above narrow'>TEMP</div><div class=''></div></div>
            </div>

            <div class='string small'>
                <div class='small half-medium block black'>RIFLESSI</div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
            </div>

            <div class='string small'>
                <div class='small half-medium block black'>VOLONTA'</div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
            </div>

            <div class='string small'>
                <div class='small half-medium block black'>ATTACCO BASE</div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
                <div class='small narrow block'></div>
            </div>

            <div class='string small'>
                <div class='rel small half-medium block'><div class='black'>TEMPRA</div></div>
                <div class='rel small narrow block'><div class='below narrow'>'TOT</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='below narrow'>'ATTACCO<br/>BASE</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='below narrow'>'FOR.</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='below narrow'>'TAGLIA</div><div class=''></div></div>
                <div class='rel small narrow block'><div class='below narrow'>'VARI</div><div class=''></div></div>
            </div>
        </div>
        <div style="clear:both"></div>

        <div style="border:1px solid black; display:inline-block;">
            <div class='string tall2'>
                <div class="block wide">
                    <div class="black small">'ATTACCO MISCHIA 1</div>
                    <div class="tall"></div>
                </div>
                <div class="block narrow">
                    <div class="black small">BONUS</div>
                    <div class="tall"></div>
                </div>
                <div class="block wide">
                    <div class="black small">DANNI</div>
                    <div class="tall"></div>
                </div>
                <div class="block narrow">
                    <div class="black small">CRITICO</div>
                    <div class="tall"></div>
                </div>
            </div>    
        </div>
        <div style="clear:both"></div>
        
    </form>

</div>