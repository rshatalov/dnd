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

var playerColors = new Array("#ff00ff", "005548", "#0000ff", "#ffa800", "#33cc45");

var draggedPlayer = "";
//var players = new Array();
//var monsters = new Array();
var units = new Array();
var curPlayer = "";
var curPlayerType = "";
var chat = new Array();

window.onload = function()
{
    table = window.location.search.split("=")[1];
    context = $_('battle-grid').getContext('2d');
    var c = $_('grid').getContext('2d');
    drawGrid(c);
    loadBattleFromServer(table);

    $_('layer-for-moving').addEventListener('mousemove', moveUnit, false);
    $_('layer-for-moving').addEventListener('mouseup', moveUnitFinish, false);
    $_('layer-for-moving').addEventListener('mouseout', moveUnitCancel, false);

    getPlayer();

}
//       p.style.borderRadius = monsters[i][1]*5+'px';



function redraw() {
    context.clearRect(0, 0, context.canvas.width, context.canvas.height); // Clears the canvas
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
    drawLayerForMoving(mouseX, mouseY);
}

function moveUnitFinish(e)
{
    e = e || window.event;
    e.preventDefault();
    e.stopPropagation();
    if (draggedPlayer != "")
    {
        var x = e.offsetX || e.layerX;
        var y = e.offsetY || e.layerY;
        draggedPlayer.style.left = x - draggedPlayer.offsetWidth / 2 + 'px';
        draggedPlayer.style.top = y - draggedPlayer.offsetHeight / 2 + 'px';
        var u = draggedPlayer.getAttribute('id');
        $.get('/ajax/change_unit_position.php?unit_type=' + draggedPlayer[0] + '&unit=' + u + '&x=' + x + '&y=' + y + '&table=' + table, function(data) {
            console.log(data);
        });
        $_('layer-for-moving').style.display = 'none';
        draggedPlayer = "";
    }
}

function moveUnitCancel(e)
{
    $_('layer-for-moving').style.display = 'none';
}

function drawLayerForMoving(x, y)
{
    var context = $_('layer-for-moving').getContext('2d');
    context.clearRect(0, 0, context.canvas.width, context.canvas.height);
    context.beginPath();
    context.arc(x, y, 10, 0, 2 * Math.PI, false);
    context.lineWidth = 1;
    context.strokeStyle = draggedPlayer[6];
    context.stroke();
}
function getPlayer()
{
    $.get("/ajax/get_player.php", function(data) {
        data = data.split(';');
        curPlayer = data[0];
        curPlayerType = data[1];
        $.get("/tables/" + table + "/players.txt", function(data)
        {
            fillUnitsList(data);
            registerEventsforUnits();

            if (curPlayerType == 'player')
            {
                var p = $_(curPlayer);
                p.addEventListener('mousedown', moveUnitStart, false);
            }
            $_('chat-send').addEventListener('click', function()
            {
                var message = $_('chat-input').value;
                $.get("/ajax/add_message_to_chat.php?tid=" + table + "&message=" + message, function(data)
                {
                });
                $_('chat-input').value = "";
            }, false);
            window.setInterval(refreshChat, 2000);

            $_('dices').addEventListener('click', function(e) {
                $_('loader').style.display = 'block'
                $.get("/ajax/get_dice_number.php?dice=" + e.target.id, function(data) {
                    console.log(data);
                    $_('loader').style.display = 'none'
                })
            }, false);
            
            window.setInterval(refreshUnitsList,3000);
        });

    });
} // getPlayer()

function refreshChat()
{
    $.get("/tables/" + table + "/chat.txt", function(data) {
        data = data.split("\n");
        var s = "";
        for (var i = 0; i < data.length; i++)
        {
            if (data[i] == "")
            {
                continue;
            }
            var t = data[i].split("\t");
            var color = "red";
            s += "<div><div style='color: " + color + "; display:inline'>"
            if (t[1] == 'dm')
            {
                s += 'DM: ';
            }
            else
            {
                s += t[0] + ': ';
            }
            s += "</div>" + t[2];
            s += "</div>"
        }
        $_('chat-messages').innerHTML = s;
    });
}

function fillUnitsList(data)
{
    data = data.split('\n');
    units = new Array();
    for (var i = 0; i < data.length; i++)
    {
        if (data[i] == "")
            continue
        var u = data[i].split(';');
        //var k=t[0];
        if (u[0] == 'player')
            t = new Array(u[0], u[1], u[2], u[3], u[4], u[5], playerColors[i]);
        else
            t = new Array(u[0], u[1], u[2], u[3], u[4], u[5], "#000000");
        units[i] = t;
    }

    var s = "";
    for (var i = 0; i < units.length; i++)
    {
        if (units[i][3] != '0')
        {
            var u = document.createElement("div");
            u.setAttribute('class', units[i][0]);
            if ($_(units[i][1]))
                $_("battle-container").removeChild($_(units[i][1]));
            u.setAttribute('id', units[i][1]);
            u.style.backgroundColor = units[i][6];
            $_("battle-container").appendChild(u);
            u.style.top = units[i][5] - u.offsetHeight / 2 + 'px';
            u.style.left = units[i][4] - u.offsetWidth / 2 + 'px';
            var folder = "";
            units[i][0] == "player" ? folder = "characters" : folder = 'monsters';
            var c = "";
            units[i][0] == "player" ? c = 'black' : c = 'white';
            s += "<div class='unit-in-list' style='color: " + c + "' id='" + units[i][1] + "-in-list'>";

            s += "<div style='background-color: " + units[i][6] + ";' class='unit-in-list-head'>" + units[i][2] + "</div>";
            s += "<img src='/images/" + folder + "/" + units[i][1] + ".jpg' class='avatar-thumbnail'>";
            if (curPlayerType == 'dm') {
                s += "\
<img class='up-arrow' src='/images/up_arrow.png'>\n\
<img class='up-2arrow' src='/images/up_2arrow.png'>\n\
<img class='down-arrow' src='/images/down_arrow.png'>\n\
<img class='down-2arrow' src='/images/down_2arrow.png'>\n\
";
                if (units[i][0] == 'monster')
                {
                    s += "<div id='' class='delete-monster'>X</div>";
                }
            }
            s += "</div>";
        }
    }
    $_("users-list").innerHTML = s;
}

function refreshUnitsList()
{
    $.get("/tables/" + table + "/players.txt", function(data)
    {
    fillUnitsList(data);
    });
}