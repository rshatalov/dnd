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
            console.log(e);
            e = e || window.event;
            //var mouseX = e.pageX - this.offsetLeft;
            var mouseY = e.offsetY || e.pageY - this.offsetTop;
            var mouseX = e.offsetX || e.pageX - this.offsetLeft;
            //console.log(e.pageX);

            paint = true;
            addClick(mouseX, mouseY, false);
            redraw();
            //battleGridIsChanged = true;
        }, false);
        $_('battle-grid').addEventListener('mousemove', function(e) {
            e = e || window.event;

            if (paint) {
                addClick(e.offsetX, e.offsetY, true);
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

        $_('eraser').onclick = function() {
            curColor = colorWhite;
        }
        $_('pencil').onclick = function() {
            curColor = colorBlack;
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
                draggedPlayer = e.target;
            }, false);
            p.addEventListener('mousemove', function(e)
            {
                if (draggedPlayer != "")
                {
                    draggedPlayer.style.top = e.y - 12;
                    draggedPlayer.style.left = e.x - 12;
                }
            }, false);
            p.addEventListener('mouseup', function(e)
            {
                if (draggedPlayer != "")
                {
                    //$_('players').style.backgroundColor = 'transparent';
                    //draggedPlayer.top = parseInt(e.y / 25) *25 + 'px';
                    draggedPlayer = "";
                }
            }, false);
        }
    }

    /*
     document.getElementsByClassName('player').addEventListener('mousedown', function(e)
     {
     //if (e.target.className == 'player')
     //{
     console.log('!!!');
     draggedPlayer = e.target;
     //$_('players').style.backgroundColor = 'rgba(0,0,0,0.1)';
     //
     
     }, false);
     /*
     $_('p1').addEventListener('mousemove', function(e)
     {
     if (draggedPlayer != "")
     {
     draggedPlayer.style.top = e.y - 12;
     draggedPlayer.style.left = e.x - 12;
     }
     }, false);
     $_('p1').addEventListener('mouseup', function(e)
     {
     if (draggedPlayer != "")
     {
     //$_('players').style.backgroundColor = 'transparent';
     //draggedPlayer.top = parseInt(e.y / 25) *25 + 'px';
     draggedPlayer = "";
     }
     }, false);
     //$_('players').addEventListener('mouseout', function(e)
     //{
     //draggedPlayer = "";
     // console.log(e);
     //}, false);
     */}
