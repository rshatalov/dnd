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
            if (draggedPlayer == "" && paint)
            {
                var mouseY = e.offsetY || e.pageY - this.offsetTop;
                var mouseX = e.offsetX || e.pageX - this.offsetLeft;
                addClick(mouseX, mouseY, true);
                redraw();
                //battleGridIsChanged = true;
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
            $.get("/ajax/clear_battle_grid.php?tid=" + table, function(data) {
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
    if (x == "")
        return;
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

function registerEventsforUnits()
{
    for (var i = 0; i < units.length; i++)
    {
        var u = $_(units[i][1]);
        if (u)
            u.addEventListener('mousedown', moveUnitStart, false);
    }
    window.setInterval(refreshUnitsInBrowser, 2000);
}


function refreshUnitsInBrowser()
{
    $.get('/tables/' + table + '/players.txt', function(data)
    {
        var data = data.split("\n");
        for (var i = 0; i < data.length; i++)
        {
            if (data[i].length < 3)
            {
                continue;
            }
            var u = data[i].split(';');

            units[i][4] = u[4];
            units[i][5] = u[5];
            var unit = $_(units[i][1]);
            unit.style.top = units[i][5] - unit.offsetHeight / 2 + 'px';
            unit.style.left = units[i][4] - unit.offsetWidth / 2 + 'px';
        }
    });
}
