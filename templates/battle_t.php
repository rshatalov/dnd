<div id="wrapper">
    <div id="container">
        <div id='battle-container' style="position: relative; width: 780px; height: 480px;">
            <canvas id="grid" width="775" height="475"
                    style="position: absolute; left: 0; top: 0; z-index: 0;"></canvas>

            <canvas id="battle-grid" width="775" height="475"
                    style="position: relative; z-index: 1;">
            </canvas>
            <?php if ($_SESSION['type'] == 'dm'): ?>
            <img src='/images/pencil.png' id="pencil" class="button-on-grid">
                <img src='/images/eraser.png'id="eraser" class="button-on-grid">
            <?php endif; ?>
                <canvas style="background-color: rgba(0,0,0,0.2); position: absolute; top: 0; left: 0; z-index: 4; display: none;" id="layer-for-moving" width="775" height="475"></canvas>

        </div>

        <?php if ($_SESSION['type'] == 'dm'): ?>
            <div id="clear-all" class="button">Clear</div>
        <?php endif; ?>
        <div id="ads"></div>
        <div id="chat">
            <div id="chat-messages"></div>
            <div id="dices">
                <img id="dise4" src="/images/dice4.png" class="dice">
                <img id="dise6" src="/images/dice6.png" class="dice">
                <img id="dise8" src="/images/dice8.png" class="dice">
                <img src="/images/loader.gif" id="loader">
            </div>
           
                <input type="text"id="chat-input">
                <div id="chat-send">Send</div>          
            
        </div>
    </div><!--container-->
    <!--<div id="scroll"></div>-->
    <div id="right-column"> 
       <div id="users-list"></div>
       <div id="add-monster">+</div>
           
   </div>
</div> <!--wrapper-->
<div id="popup-container">
    <div id="popup"></div>
</div>

