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
                    addClick(e.offsetX, e.offsetY, true);
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
        var p = $_(players[i][0]);
        if (p)
            p.addEventListener('mousedown', moveUnitStart, false);
    }
}

function registerEventsforMonsters()
{
    for (var i = 0; i < monsters.length; i++)
    {
        var p = $_(monsters[i][0]);
        if (p) p.addEventListener('mousedown', moveUnitStart, false);
    }
}

function moveUnitStart(e)
{
    e = e || window.event;
    e.preventDefault();
    e.stopPropagation();
    unitType = e.target.className;
    console.log(unitType);
    $_('layer-for-moving').style.display = 'block';
    draggedPlayer = e.target;
}
function moveUnit(e)
{
    e = e || window.event;
    e.preventDefault();
    e.stopPropagation();
    drawLayerForMoving(e.offsetX,e.offsetY);
}

function moveUnitFinish(e)
{
    e = e || window.event;
    e.preventDefault();
    e.stopPropagation();
    if (draggedPlayer != "")
    {
        var ml = window.getComputedStyle($_('wrapper'), null).getPropertyValue("margin-left");
        var x = e.offsetX;
        var y = e.offsetY;
        draggedPlayer.style.left = x - draggedPlayer.offsetWidth / 2 + 'px';
        draggedPlayer.style.top = y - draggedPlayer.offsetHeight / 2 + 'px';
        var p = e.target.id;
        $.get('/ajax/change_unit_position.php?'+unitType+'=' + p + '&x=' + x + '&y=' + y + '&table=' + table,function(){});
        $_('layer-for-moving').style.display = 'none';
        draggedPlayer = "";
    }
}

function moveUnitCancel(e)
{
 $_('layer-for-moving').style.display = 'none';   
}

function drawLayerForMoving(x,y)
{
    var context = $_('layer-for-moving').getContext('2d');
    context.clearRect(0, 0, context.canvas.width, context.canvas.height);
     context.beginPath();
      context.arc(x, y, 10, 0, 2 * Math.PI, false);
      //context.fillStyle = 'green';
      //context.fill();
      context.lineWidth = 1;
      context.strokeStyle = '#ffffff';
      context.stroke();
}