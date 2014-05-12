var curPlayer="";

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
   $.get("/ajax/get_player.php",function(data){
       curPlayer = data;
       console.log(curPlayer);
       $_(curPlayer+"-in-list").innerHTML+=" - you";
       var p=$_(curPlayer);
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
                    var x=e.x;
                    var y =e.y;
                    var p=e.target.id;
                    $.get('/ajax/changePlayerPosition.php?player='+p+'&x='+x+'&y='+y+'&table='+table,function (data)
                    {
                      console.log('!!!');  
                    });
                    draggedPlayer = "";
                }
            }, false);
   }) 
}

function registerEventsforPlayers()
{
    getPlayer();
}

function registerEventsforMonsters()
{
    
}