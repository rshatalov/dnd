var curPlayer = "";

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
        $_('debug').innerHTML = data;

    });

}

function getPlayer()
{
    $.get("/ajax/get_player.php", function(data) {
        curPlayer = data;
        console.log(curPlayer);
        $_(curPlayer + "-in-list").innerHTML += " - you";
        var p = $_(curPlayer);
        p.addEventListener('mousedown', moveUnitStart, false);
       
       
    })
}

function registerEventsforPlayers()
{
    getPlayer();
   
    window.setInterval(refreshPlayersinBrowser, 2000);
}

function registerEventsforMonsters()
{
    window.setInterval(refreshMonstersinBrowser, 2000);
}

function refreshMonstersinBrowser()
{

    $.get('/tables/' + table + '/monsters.txt', function(data)
    {
     refreshUnitsinBrowser(monsters,data);  
    });
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

function refreshUnitsinBrowser(units,data)
{
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
            unit.style.width = units[i][1] * 10 + 'px';
            unit.style.height = units[i][1] * 10 + 'px';
            unit.style.top = units[i][3] - unit.offsetHeight/2 + 'px';
            unit.style.left = units[i][2] - unit.offsetWidth/2 + 'px';

        } 
}