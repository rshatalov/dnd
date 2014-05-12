var paint = false;
var curColor = colorBlack;
var battleGridIsChanged = false;
var nextClickIndex = 0;
var lastSavedClick = 0;
var clickSaving = false;


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
            else
            {
                if (e.offsetX)
                {
                    draggedPlayer.style.top = (e.offsetY) - 12 + 'px';
                    draggedPlayer.style.left = (e.offsetX) - 12 + 'px';
                    console.log("!!");
                }
                else
                {
                    draggedPlayer.style.top = (e.pageY - this.offsetTop) - 12 + 'px';
                    draggedPlayer.style.left = (e.pageX - this.offsetLeft) - 12 + 'px';
                    //console.log("!!");
                }
                //console.log("!!");
                //console.log(draggedPlayer);
            }
            
            //console.log(e);
        }, false);

        $_('battle-grid').addEventListener('mouseup', function(e) {
            paint = false;
        }, false);
        $_('battle-grid').addEventListener('mouseleave', function(e) {
            paint = false;
        }, false);

        $_('eraser').onclick = function() {
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
        {
            p.addEventListener('mousedown', function(e)
            {
                e.stopPropagation();
                draggedPlayer = e.target;
                console.log(e);
            }, false);
            p.addEventListener('mousemove', function(e)
            {
                e.stopPropagation();
                if (draggedPlayer != "")
                {
                    //draggedPlayer.style.top = e.y - 12 + 'px';
                    //draggedPlayer.style.left = e.x - 12 + 'px';
                    
                }
            }, false);
            p.addEventListener('mouseup', function(e)
            {
                e.stopPropagation();
                if (draggedPlayer != "")
                {
                    var x = e.x;
                    var y = e.y;
                    var p = e.target.id;
                    $.get('/ajax/changePlayerPosition.php?player=' + p + '&x=' + x + '&y=' + y + '&table=' + table, function(data)
                    {
                        console.log('!!!');
                    });
                    draggedPlayer = "";
                }
            }, false);
        }
    }
}

function registerEventsforMonsters()
{
    for (var i = 0; i < monsters.length; i++)
    {
        var p = $_(monsters[i][0]);

        if (p)
        {
            p.addEventListener('mousedown', function(e)
            {
                draggedPlayer = e.target;
            }, false);
            p.addEventListener('mousemove', function(e)
            {
                if (draggedPlayer != "")
                {
                    draggedPlayer.style.top = e.y - 12 + 'px';
                    draggedPlayer.style.left = e.x - 12 + 'px';
                }
            }, false);
            p.addEventListener('mouseup', function(e)
            {
                if (draggedPlayer != "")
                {
                    var x = e.x;
                    var y = e.y;
                    var p = e.target.id;
                    $.get('/ajax/change_monster_position.php?monster=' + p + '&x=' + x + '&y=' + y + '&table=' + table, function(data)
                    {
                        console.log('!!!');
                    });
                    draggedPlayer = "";
                }
            }, false);
        }
    }

}
