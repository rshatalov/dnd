function $_(e) {
    return document.getElementById(e);
}

var paint = false;
var context;

var clickX = new Array();
var clickY = new Array();
var clickDrag = new Array();
var colorWhite = 'rgba(1,1,1,1)';
var colorBlack = "#000000";
var curColor = colorBlack;
var clickColor = new Array();
var table = "";
var battleGridIsChanged = false;
var nextClickIndex = 0;
var lastSavedClick = 0;
var clickSaving = false;

window.onload = function()
{
    table = window.location.search.split("=")[1];
    //console.log(table);
    context = $_('battle-grid').getContext('2d');
    var c = $_('grid').getContext('2d');
    drawGrid(c);
    window.setInterval(refreshBattleOnServer, 1000);

    $_('battle-grid').onmousedown = function(e) {
        e = e || window.event;
        //var mouseX = e.pageX - this.offsetLeft;
        var mouseY = e.offsetY || e.pageY - this.offsetTop;
        var mouseX = e.offsetX || e.pageX - this.offsetLeft;
        //console.log(e.pageX);

        paint = true;
        addClick(mouseX, mouseY);
        redraw();
        //battleGridIsChanged = true;
    };
    $_('battle-grid').onmousemove = function(e) {
        e = e || window.event;

        if (paint) {
            addClick(e.offsetX, e.offsetY, true);
            redraw();
            //battleGridIsChanged = true;
        }
    };
    $_('battle-grid').onmouseup = function(e) {
        paint = false;
    };
    $_('battle-grid').onmouseleave = function(e) {
        paint = false;
    };

    $_('eraser').onclick = function() {
        curColor = colorWhite;
    }
    $_('pencil').onclick = function() {
        curColor = colorBlack;
    }
}


function addClick(x, y, dragging)
{
    clickX.push(x);
    clickY.push(y);
    clickDrag.push(dragging);
    clickColor.push(curColor);
    ++nextClickIndex;
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
        context.closePath();
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
        //$_('info').innerHTML = clickX;
    }
}

function drawGrid(c)
{
    for (var x = 0.5; x < 500; x += 50)
    {
        c.moveTo(x, 0);
        c.lineTo(x, 300);
    }
    for (var y = 0.5; y < 300; y += 50)
    {
        c.moveTo(0, y);
        c.lineTo(500, y);
    }
    c.strokeStyle = '#aaa';
    c.lineWidth = 1;
    c.stroke();
}


function refreshBattleOnServer()
{
    if (nextClickIndex > lastSavedClick && clickSaving == false)
    {
        clickSaving = true;
        lastSavedClick = nextClickIndex;
        $.post('ajax/dm_refresh_battle_grid.php',
                {
                    table: table,
                    message: 'hello'
                }, function(data) {
            console.log(lastSavedClick);
            clickSaving = false;
        });
    }

    //battleGridIsChanged = false;

}