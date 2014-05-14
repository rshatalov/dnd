function $_(e) {
    return document.getElementById(e);
}

var table = "";
var context;
var colorWhite = 'rgba(1,1,1,1)';
var colorBlack = "#000000";
var clickX = new Array();
var clickY = new Array();
var clickDrag = new Array();
var clickColor = new Array();

var playerColors = new Array("#ff0000", "00ff00", "#0000ff");

var draggedPlayer = "";
var players = new Array();
var monsters = new Array();

window.onload = function()
{
    table = window.location.search.split("=")[1];
    context = $_('battle-grid').getContext('2d');
    var c = $_('grid').getContext('2d');
    drawGrid(c);
    loadBattleFromServer(table);

    $_('layer-for-moving').addEventListener('mousemove',moveUnit,false);
    $_('layer-for-moving').addEventListener('mouseup',moveUnitFinish,false);
    $_('layer-for-moving').addEventListener('mouseout',moveUnitCancel,false);


    $.get("/tables/" + table + "/players.txt", function(data)
    {

        var pf = data;
        pf = pf.split('\n');
        for (var i = 0; i < pf.length; i++)
        {
            var t = pf[i].split(';');
            if (t[1] != null) {
                players[i] = new Array(t[0],t[1],t[2],t[3],playerColors[i]);
            }
        }
        
      for (var i =0; i<players.length;i++)
      {
          if (players[i][1]=='1')
          {
              var p = document.createElement("div");
              p.setAttribute('class','player');
              p.setAttribute('id',players[i][0]);
              p.style.backgroundColor= players[i][4];
               $_("battle-container").appendChild(p);
              p.style.top=players[i][3]-p.offsetHeight/2+'px';
              p.style.left=players[i][2]-p.offsetWidth/2+'px';
             
              
              p = document.createElement("div");
              p.setAttribute('id',players[i][0]+"-in-list");
              p.style.color= players[i][4];
              p.innerHTML =players[i][0];
              $_("users-list").appendChild(p);
          }
      }
      registerEventsforPlayers();
      //console.log(players);
    });

$.get('/tables/'+ table + '/monsters.txt',function(data)
{
  var m = data.split("\n");
  for (var i=0; i<m.length; i++)
  {
      if(m[i].length<3)
      {
          continue;
      }
      var t = m[i].split(';');
      monsters[i]=new Array();
      monsters[i][0]=t[0];
      monsters[i][1]=t[1];
      monsters[i][2]=t[2];
      monsters[i][3]=t[3];
       var p = document.createElement("div");
              p.setAttribute('class','monster');
              p.setAttribute('id',monsters[i][0]);
               p.style.width = monsters[i][1]*10+'px';
              p.style.height = monsters[i][1]*10+'px';
                $_("battle-container").appendChild(p);
              p.style.top= monsters[i][3]-p.offsetHeight/2+'px';
              p.style.left= monsters[i][2]-p.offsetWidth/2+'px';
              p.innerHTML = monsters[i][1];
             
              p.style.borderRadius = monsters[i][1]*5+'px';
            
              
              p = document.createElement("div");
             p.innerHTML = monsters[i][0];
              $_("users-list").appendChild(p);
  }
  
  registerEventsforMonsters();
});
}


function redraw() {
    context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
    //drawGrid(context);
    context.lineJoin = "round";
    context.lineWidth = 3;

    for (var i = 0; i < clickX.length; i++) {
        context.beginPath();
        if (clickDrag[i] && i) {
            context.moveTo(clickX[i - 1], clickY[i - 1]);
        } else {
            context.moveTo(clickX[i] - 1, clickY[i]);
        }
        context.lineTo(clickX[i], clickY[i]);
        //context.closePath();
        context.strokeStyle = clickColor[i];
        var con = context.globalCompositeOperation;
        if (context.strokeStyle != colorBlack)
        {
            context.globalCompositeOperation = 'destination-out';
            context.lineWidth = 10;
        }
        else
        {
            context.lineWidth = 3;
        }
        context.stroke();
        context.globalCompositeOperation = con;

    }
}

function drawGrid(c)
{
    for (var x = 24.5; x < 774; x += 25)
    {
        c.moveTo(x, 0);
        c.lineTo(x, 475);
    }
    for (var y = 24.5; y < 474; y += 25)
    {
        c.moveTo(0, y);
        c.lineTo(775, y);
    }
    c.strokeStyle = '#aaa';
    c.lineWidth = 1;
    c.stroke();
}
function moveUnitStart(e)
{
    e = e || window.event;
    e.preventDefault();
    e.stopPropagation();
    unitType = e.target.className;
    $_('layer-for-moving').style.display = 'block';
    draggedPlayer = e.target;
}
function moveUnit(e)
{
    e = e || window.event;
    e.preventDefault();
    e.stopPropagation();
    var mouseX = e.offsetX || e.layerX;
    var mouseY = e.offsetY || e.layerY;
    drawLayerForMoving(mouseX,mouseY);
}

function moveUnitFinish(e)
{
    e = e || window.event;
    e.preventDefault();
    e.stopPropagation();
    if (draggedPlayer != "")
    {
        var ml = window.getComputedStyle($_('wrapper'), null).getPropertyValue("margin-left");
        var x = e.offsetX || e.layerX;
        var y = e.offsetY || e.layerY;
        draggedPlayer.style.left = x - draggedPlayer.offsetWidth / 2 + 'px';
        draggedPlayer.style.top = y - draggedPlayer.offsetHeight / 2 + 'px';
        var u = draggedPlayer.getAttribute('id');
        $.get('/ajax/change_unit_position.php?unit_type='+unitType+'&unit=' + u + '&x=' + x + '&y=' + y + '&table=' + table,function(data){console.log(data);});
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
      context.lineWidth = 1;
      context.strokeStyle = '#ffffff';
      context.stroke();
}
