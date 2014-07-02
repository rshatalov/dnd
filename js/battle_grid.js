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

var draggedPlayer = "";
var units = new Array();
var curPlayer = "";
var curPlayerType = "";
var curPlayerId = "";
var chat = new Array();
var unitsLocked = false;
var scrollIndex = 0;

window.onload = function()
{
    window.setInterval(refreshQueue, 1000);
    table = window.location.search.split("=")[1];
    context = $_('battle-grid').getContext('2d');
    var c = $_('grid').getContext('2d');
    drawGrid(c);

$("#scroll-container").perfectScrollbar();
$("#units-list-container").perfectScrollbar();
$("#chat-messages-container").perfectScrollbar();
    
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
    if (curPlayerType=="player" && curPlayerId != e.target.id)
    {
        console.log(curPlayerId);
        return;
    }
    unitsLocked = true;
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
        $.get('/ajax/change_unit_position.php?uid=' + u + '&x=' + x + '&y=' + y + '&tid=' + table, function(data) {
        });
        $_('layer-for-moving').style.display = 'none';
        draggedPlayer = "";
        unitsLocked = false;
    }
}
function moveUnitCancel(e)
{
    unitsLocked = false;
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
        curPlayerId = data[2];
        $.get("/tables/" + table + "/players.txt?" + new Date().getTime(), function(data)
        {
            fillUnitsList(data);
            

            $_('battle-container').addEventListener("mousedown", function(e) {
                if (e.target.className == 'player' || e.target.className == 'monster')
                    moveUnitStart(e);
            }, false);
            
            $_('chat-send').addEventListener('click', function()
            {
                var message = $_('chat-input').value;
                if (message.length < 1)
                    return;
                $.get("/ajax/add_message_to_chat.php?tid=" + table + "&message=" + message, function(data)
                {
                    refreshChat();
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

            window.setInterval(refreshUnitsList, 3000);
            if (curPlayerType == 'player')
                window.setInterval(refreshStatus, 5000);
            window.setInterval(refreshScroll, 3000);
            
        });

    });
} // getPlayer()

function refreshChat()
{
    $.get("/tables/" + table + "/chat.txt?" + new Date().getTime(), function(data) {
        data = data.split("\n");
        var s = "";
        var color = "";
        var uid = "";
        for (var i = 0; i < data.length; i++)
        {
            if (data[i] == "")
            {
                continue;
            }
            var t = data[i].split("\t");

            if (t[2] == 'dm')
                color = "red"
            else {
                uid = t[0];
                for (var j = 0; j < units.length; j++)
                {
                    if (uid == units[j][1])
                    {
                        color = units[j][6];
                    }
                }
            }
            s += "<div><div style='color: " + color + "; display:inline'>"
            if (t[2] == 'dm')
                s += 'DM: ';
            else
                s += t[1] + ': ';
            s += "</div>" + t[3];
            s += "</div>";
        }
        $_('chat-messages').innerHTML = s;
        $("#chat-messages-container").perfectScrollbar("update");
    });
}

function fillUnitsList(data)
{
    if (unitsLocked == true)
        return;
    data = data.split('\n');
    units = new Array();
    for (var i = 0; i < data.length; i++)
    {
        if (data[i] == "")
            continue
        var u = data[i].split(';');
        //var k=t[0];
        units[i] = u;
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
            if (units[i][0] == 'player' && units[i][3] == ['2']) {
            }
            else
                $_("battle-container").appendChild(u);
            if (units[i][0] == 'monster')
            {
                u.style.padding = units[i][3] * 5 + 'px';
                u.innerHTML = "<div style='position: absolute; left: " + (u.offsetWidth / 2 - 5) + "px; top: "
                        + (u.offsetHeight / 2 - 8) + "px;'>" + units[i][9] + "</div>";
                u.style.borderRadius = units[i][3] * 5 + 'px';
            }
            u.style.top = units[i][5] - u.offsetHeight / 2 + 'px';
            u.style.left = units[i][4] - u.offsetWidth / 2 + 'px';
            var folder = "";
            units[i][0] == "player" ? folder = "characters" : folder = 'monsters';
            var c = "";
            units[i][0] == "player" ? c = 'black' : c = 'white';
            if (units[i][3] == '2' && units[i][0] == 'player')
                units[i][6] = '#c0c0c0';
            s += "<div class='unit-in-list' style='color: " + c + "' id='" + units[i][1] + "-in-list'>";

            s += "<div style='background-color: " + units[i][6] + ";' class='unit-in-list-head'>";
            if (units[i][0] == 'monster')
                s += units[i][9] + " ";
            s += "<div class='unit-name'>"+units[i][2] + "</div></div>";
            s += "<img ";
            if (units[i][3] == '2' && units[i][0] == 'player')
                s += "style='-webkit-filter: grayscale(100%); -webkit-filter: grayscale(1);\n\
filter: grayscale(100%); filter: gray; '";
            s += " src='/images/units/" + units[i][1] + ".png' class='avatar-thumbnail'>";
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
                else {
                    if (units[i][3] == '1')
                        s += "<div class='disable-player'>&Oslash;</div>";
                    else if (units[i][3] == '2')
                        s += "<div class='enable-player'>&#x2713;</div>";

                    if (units[i][7] > parseInt(new Date().getTime()/1000) - 10)
                        s += "<div class='status-online'>online</div>";
                    else
                        s += "<div class='status-offline'>offline</div>";
 
                }
            }
            s += "</div>";
        }
    }
    $_("users-list").innerHTML = s;
    $("#units-list-container").perfectScrollbar("update");
    
}

function refreshUnitsList()
{
    $.get("/tables/" + table + "/players.txt?" + new Date().getTime(), function(data)
    {
        fillUnitsList(data);
    });
}

function refreshStatus()
{
    $.get("/ajax/refresh_status.php?tid=" + table, function(data)
    {
        console.log(data);
    });
}

function refreshScroll()
{
    $.get("/tables/" + table + "/scroll.txt?" + new Date().getTime(), function(data)
    {
        data = data.split("\n");
        if (scrollIndex < data.length-1)
        {
            for (var i = scrollIndex; i < data.length-1;i++)
            {
        $_("scroll-content").innerHTML += data[i];
            }
        
        scrollIndex = data.length-1;
    }
        $("#scroll-container").perfectScrollbar("update");
    });
}

function refreshQueue()
{

}
