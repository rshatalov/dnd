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
$_('add-monster').addEventListener('click',function(){
    $_('popup-container').style.display="block";
    $.get("/ajax/get_monsters.php",function(data){
        $_('popup').innerHTML=data;
    })
},false);

$_('users-list').addEventListener('click',function(e){
    var c=e.target.className;
    if(c=='up-arrow'){
       var uid=e.target.parentNode.id.split('-')[0];
       $.get("/ajax/move_unit_in_list.php?tid="+table+"&uid="+uid+"&dir=up",function(data){
           refreshUnitsList();
           console.log(data);
       })
    }
     if(c=='up-2arrow'){
  
       var uid=e.target.parentNode.id.split('-')[0];
       $.get("/ajax/move_unit_in_list.php?tid="+table+"&uid="+uid+"&dir=2up",function(data){
           refreshUnitsList();
           console.log(data);
       })
    }
     if(c=='down-arrow'){
       var uid=e.target.parentNode.id.split('-')[0];
       $.get("/ajax/move_unit_in_list.php?tid="+table+"&uid="+uid+"&dir=down",function(data){
           refreshUnitsList();
           console.log(data);
       })
    }
     if(c=='down-2arrow'){

       var uid=e.target.parentNode.id.split('-')[0];
       $.get("/ajax/move_unit_in_list.php?tid="+table+"&uid="+uid+"&dir=2down",function(data){
           refreshUnitsList();
           console.log(data);
       })
    }
    if(c=='delete-monster')
    {
     var t=e.target.parentNode;
     var mid=e.target.parentNode.id.split('-')[0];
        console.log(mid);
        t.parentNode.removeChild(t);
        $.get("/ajax/delete_monster.php?tid="+table+"&mid="+mid,function(data){
            
        })
    }
},false);

$_('popup').addEventListener('click',function(e){
    if(e.target.className=='add-monster-from-stack'){
        var mid= e.target.id.split('-')[0];
       $.get("/ajax/add_monster.php?tid="+table+"&mid="+mid,function(data){
           console.log(data);
       })
    }
},false);

$_('popup-container').addEventListener('click',function(e){
    if (e.target.id=='popup-container')
    $_('popup-container').style.display="none";
},false);
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

}
