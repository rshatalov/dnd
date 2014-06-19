<div id="wrapper">
    <div id="container">
        <div id='battle-container' style="position: relative; width: 775px; height: 425px;">
            <div id="grid-letters">
                <span class="grid-letter">a</span>
                <span class="grid-letter">b</span>
                <span class="grid-letter">c</span>
                <span class="grid-letter">d</span>
                <span class="grid-letter">e</span>
                <span class="grid-letter">f</span>
                <span class="grid-letter">g</span>
                <span class="grid-letter">h</span>
                <span class="grid-letter">i</span>
                <span class="grid-letter">j</span>
                <span class="grid-letter">k</span>
                <span class="grid-letter">l</span>
                <span class="grid-letter">m</span>
                <span class="grid-letter">n</span>
                <span class="grid-letter">o</span>
            </div>
            <div id="grid-numbers">
                <span class="grid-number">1</span><span class="grid-number">2</span><span class="grid-number">3</span><span class="grid-number">4</span><span class="grid-number">5</span><span class="grid-number">6</span><span class="grid-number">7</span><span class="grid-number">8</span><span class="grid-number">9</span><span class="grid-number">10</span><span class="grid-number">11</span><span class="grid-number">12</span><span class="grid-number">13</span><span class="grid-number">14</span><span class="grid-number">15</span><span class="grid-number">16</span><span class="grid-number">17</span><span class="grid-number">18</span><span class="grid-number">19</span><span class="grid-number">20</span><span class="grid-number">21</span><span class="grid-number">22</span>
            </div>
                <canvas id="grid" width="750" height="400"
                    style="position: absolute; z-index: 0; left: 0; top: 0;"></canvas>

            <canvas id="battle-grid" width="750" height="375"
                    style="position: absolute; left: 25px; top: 25px; z-index: 1;">
            </canvas>
            <?php if ($_SESSION['type'] == 'dm'): ?>
                <img src='/images/pencil.png' id="pencil" class="button-on-grid">
                <img src='/images/eraser.png'id="eraser" class="button-on-grid">
            <?php endif; ?>
            <canvas style="background-color: rgba(0,0,0,0.2); position: absolute; top: 25px; left: 25px; z-index: 4; display: none;" id="layer-for-moving" width="775" height="400"></canvas>
        <?php if ($_SESSION['type'] == 'dm'): ?>
            <div id="clear-all" class="button">Clear</div>
        <?php endif; ?>
        </div>
        <div id="ads"></div>
        <div id="chat">
            <div id="chat-messages-container">
                <div id="chat-messages"></div></div>
            <div id="dices">
                <img id="dise4" src="/images/dice4.png" class="dice">
                <img id="dise6" src="/images/dice6.png" class="dice">
                <img id="dise8" src="/images/dice8.png" class="dice">
                <img src="/images/loader.gif" id="loader">
            </div>

            <input type="text"id="chat-input">
            <div id="chat-send">Send</div>          

        </div>
        <div id="right-column">
            <div id="units-list-container">
                <div id="users-list"></div></div>
            <div id="add-monster">+</div>
            <div id="settings">#</div>
        </div>
    </div> <!--container-->
        <div id="scroll">
            <div id="scroll-container">
                <div id='scroll-content'></div></div>
            <?php if ($_SESSION['type'] == 'dm'): ?>
                <div id="scroll-form">
                    <textarea id='scroll-message'></textarea>
                    <div id="insert-image-in-scroll">Insert image</div>
                    <div id='insert-image-in-scroll2'>Choose another</div>
                    <div id='send-image-for-scroll'>Insert image</div>
                    <div id="send-scroll-message">Send</div>
                    <input id="hidden-image-for-scroll" type='file'>
                </div>
            <?php endif; ?>
        </div>

</div> <!--wrapper-->
<div id="popup-container">
    <div id="popup"></div>
</div>