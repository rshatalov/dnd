var paint = false;
var curColor = colorBlack;
var battleGridIsChanged = false;
var nextClickIndex = 0;
var lastSavedClick = 0;
var clickSaving = false;
var unitType = "";


function loadBattleFromServer(table)
{
    $.get("ajax/dm_load_battle_grid.php?table=" + table, function(data)
    {

        var content = data.split('\n');
        for (var i = 0; i < content.length; i++)
        {
            var c = content[i].split(';');
            clickX[i] = c[0];
            clickY[i] = c[1];
            clickDrag[i] = c[2];
            if (c[2] == "false")
                clickDrag[i] = false;
            clickColor[i] = c[3];

        }
        redraw();
        window.setInterval(refreshBattleOnServer, 1000);

        $_('battle-grid').addEventListener('mousedown', function(e) {
            if (draggedPlayer == "")
            {
                e = e || window.event;
                var mouseY = e.offsetY || e.pageY - this.offsetTop;
                var mouseX = e.offsetX || e.pageX - this.offsetLeft;

                paint = true;
                addClick(mouseX, mouseY, false);
                redraw();
            }
        }, false);
        $_('battle-grid').addEventListener('mousemove', function(e)
        {
            e = e || window.event;
            if (draggedPlayer == "")
            {

                if (paint) {
                     var mouseY = e.offsetY || e.pageY - this.offsetTop;
                var mouseX = e.offsetX || e.pageX - this.offsetLeft;
                    addClick(mouseX,mouseY, true);
                    redraw();
                    //battleGridIsChanged = true;
                }
            }
        }, false);

        $_('battle-grid').addEventListener('mouseup', function(e) {
            paint = false;
        }, false);
        $_('battle-grid').addEventListener('mouseleave', function(e) {
            paint = false;
        }, false);

        $_('eraser').onclick = function(e) {
            e.preventDefault();
            curColor = colorWhite;
        }
        $_('pencil').onclick = function() {
            curColor = colorBlack;
        }
        $_('clear-all').onclick = function() {

            $.get("/ajax/clear_battle_grid.php?table=" + table, function(data) {
                clickX = new Array();
                clickY = new Array();
                clickDrag = new Array();
                clickColor = new Array();
                redraw();
            });
        }
    }); // load battle grid

}

function addClick(x, y, dragging)
{
    clickX.push(x);
    clickY.push(y);
    clickDrag.push(dragging);
    clickColor.push(curColor);
    ++nextClickIndex;
}

function refreshBattleOnServer()
{
    if (nextClickIndex > lastSavedClick && clickSaving == false)
    {
        clickSaving = true;
        lastSavedClick = nextClickIndex;
        var s = "";
        for (var i = 0; i < clickX.length; i++)
        {
            s += clickX[i] + ";" + clickY[i] + ";" +
                    clickDrag[i] + ";" +
                    clickColor[i] + "\n";
        }

        $.post('ajax/dm_refresh_battle_grid.php',
                {
                    table: table,
                    content: s
                }, function(data) {
            clickSaving = false;

        });
    }
    //battleGridIsChanged = false;
}
function registerEventsforPlayers()
{
    for (var i = 0; i < players.length; i++)
    {
        var u = $_(players[i][0]);
        if (u)
            u.addEventListener('mousedown', moveUnitStart, false);
    }
    window.setInterval(refreshPlayersinBrowser,2000);
}
function registerEventsforMonsters()
{
    for (var i = 0; i < monsters.length; i++)
    {
        var u = $_(monsters[i][0]);
        if (u) u.addEventListener('mousedown', moveUnitStart, false);
    }
      window.setInterval(refreshMonstersinBrowser,2000);
}

function refreshPlayersinBrowser()
{
    $.get('/tables/' + table + '/players.txt', function(data)
    {
        units=players;
      var m = data.split("\n");
        for (var i = 0; i < m.length; i++)
        {
            if (m[i].length < 3)
            {
                continue;
            }
            var t = m[i].split(';');

            units[i][2] = t[2];
            units[i][3] = t[3];
            var unit = $_(units[i][0]);
            unit.style.top = units[i][3] - unit.offsetHeight/2 + 'px';
            unit.style.left = units[i][2] - unit.offsetWidth/2 + 'px';

        } 
    });
}

function refreshMonstersinBrowser()
{
    $.get('/tables/' + table + '/monsters.txt', function(data)
    {
        units=monsters;
      var m = data.split("\n");
        for (var i = 0; i < m.length; i++)
        {
            if (m[i].length < 3)
            {
                continue;
            }
            var t = m[i].split(';');

            units[i][2] = t[2];
            units[i][3] = t[3];
            var unit = $_(units[i][0]);
            unit.style.top = units[i][3] - unit.offsetHeight/2 + 'px';
            unit.style.left = units[i][2] - unit.offsetWidth/2 + 'px';

        } 
    });
}