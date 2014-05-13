<div id="wrapper">
    <div id="container">
        <div id='battle-container' style="position: relative; width: 780px; height: 480px;">
            <canvas id="grid" width="775" height="475"
                    style="position: absolute; left: 0; top: 0; z-index: 0;"></canvas>

            <canvas id="battle-grid" width="775" height="475"
                    style="position: relative; z-index: 1;">
            </canvas>
            <?php if ($_SESSION['type'] == 'dm'): ?>
                <div id="pencil" class="button-on-grid">P</div>
                <div id="eraser" class="button-on-grid">E</div> 
            <?php endif; ?>
                <canvas style="background-color: rgba(0,0,0,0.2); position: absolute; top: 0; left: 0; z-index: 4; display: none;" id="layer-for-moving" width="775" height="475"></canvas>

        </div>

        <?php if ($_SESSION['type'] == 'dm'): ?>
            <div id="clear-all" class="button">Clear</div>
        <?php endif; ?>
        <div id="ads"></div>
        <div id="chat"></div>
    </div><!--container-->
    <!--<div id="scroll"></div>-->
    <div id="users-list"></div>
</div> <!--wrapper-->
