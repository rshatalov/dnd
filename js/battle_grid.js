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


window.onload = function()
{
    table = window.location.search.split("=")[1];
    context = $_('battle-grid').getContext('2d');
    var c = $_('grid').getContext('2d');
    drawGrid(c);
    loadBattleFromServer(table);




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
              p.style.top=players[i][3]-12+'px';
              p.style.left=players[i][2]-12+'px';
              $_("battle-container").appendChild(p);
              
              p = document.createElement("div");
             // p.setAttribute('class','player');
              p.setAttribute('id',players[i][0]+"-in-list");
              p.style.color= players[i][4];
              //p.style.top=players[i][3]-12+'px';
              //p.style.left=players[i][2]-12+'px';
              p.innerHTML =players[i][0];
              $_("users-list").appendChild(p);
          }
      }
      registerEventsforPlayers();
      //console.log(players);
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