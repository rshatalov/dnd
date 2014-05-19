

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
        window.setInterval(refreshBattleinBrowser, 2000);


    })
}

function refreshBattleinBrowser()
{

    $.get('ajax/dm_load_battle_grid.php?table=' + table, function(data) {
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
    });
}



function registerEventsforUnits()
{
    
   
    window.setInterval(refreshPlayersinBrowser, 2000);
}

function refreshPlayersinBrowser()
{
    $.get('/tables/' + table + '/players.txt', function(data)
    {
      var m = data.split("\n");
        for (var i = 0; i < m.length; i++)
        {
            if (m[i].length < 3)
            {
                continue;
            }
            var t = m[i].split(';');

            units[i][4] = t[4];
            units[i][5] = t[5];
            var unit = $_(units[i][1]);
            unit.style.top = units[i][5] - unit.offsetHeight/2 + 'px';
            unit.style.left = units[i][4] - unit.offsetWidth/2 + 'px';

        } 
    });
}