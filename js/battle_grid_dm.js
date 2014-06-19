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

    $_("send-scroll-message").addEventListener("click", function() {
        var m = $_("scroll-message").value;
        if (m.length < 1)
            return;
        $.post("/ajax/new_message_in_scroll.php",
                {
                    tid: table,
                    message: m
                }, function(data) {
            refreshScroll();
        });
        $_("scroll-message").value = "";
    }, false);

    $_("insert-image-in-scroll").addEventListener('click', function()
    {
        $('#hidden-image-for-scroll').click();
    }, false);
    $_("insert-image-in-scroll2").addEventListener('click', function()
    {
        $('#hidden-image-for-scroll').click();
    }, false);
    $_("hidden-image-for-scroll").addEventListener('change', function() {
        $_("insert-image-in-scroll").style.display = 'none';
        $_("insert-image-in-scroll2").style.display = 'block';
        $_("send-image-for-scroll").style.display = 'block';
    }, false);
    $_("send-image-for-scroll").addEventListener("click", function() {
        var file = $_('hidden-image-for-scroll').files[0];
        //console.log($_('hidden-image-for-scroll'));
        var fd = new FormData();
        fd.append('file', file);
        fd.append('tid',table);
        $.ajax({
            url: "/ajax/add_image_to_scroll.php",
            type: "POST",
            data: fd,
            processData: false, // tell jQuery not to process the data
            contentType: false,   // tell jQuery not to set contentType
            success: function(data){
                console.log(data);
        $_("insert-image-in-scroll").style.display = 'block';
        $_("insert-image-in-scroll2").style.display = 'none';
        $_("send-image-for-scroll").style.display = 'none';
            }
        });

    }, false);

    $_('add-monster').addEventListener('click', function() {
        $_('popup-container').style.display = "block";
        $.get("/ajax/get_monsters.php", function(data) {
            $_('popup').innerHTML = data;
        })
    }, false);

    $_('users-list').addEventListener('click', function(e) {
        var c = e.target.className;
        if (c == 'up-arrow') {
            var uid = e.target.parentNode.id.split('-')[0];
            $.get("/ajax/move_unit_in_list.php?tid=" + table + "&uid=" + uid + "&dir=up", function(data) {
                refreshUnitsList();
                console.log(data);
            })
        }
        if (c == 'up-2arrow') {

            var uid = e.target.parentNode.id.split('-')[0];
            $.get("/ajax/move_unit_in_list.php?tid=" + table + "&uid=" + uid + "&dir=2up", function(data) {
                refreshUnitsList();
                console.log(data);
            })
        }
        if (c == 'down-arrow') {
            var uid = e.target.parentNode.id.split('-')[0];
            $.get("/ajax/move_unit_in_list.php?tid=" + table + "&uid=" + uid + "&dir=down", function(data) {
                refreshUnitsList();
                console.log(data);
            })
        }
        if (c == 'down-2arrow') {

            var uid = e.target.parentNode.id.split('-')[0];
            $.get("/ajax/move_unit_in_list.php?tid=" + table + "&uid=" + uid + "&dir=2down", function(data) {
                refreshUnitsList();
                console.log(data);
            })
        }
        if (c == 'disable-player' || c == 'enable-player')
        {
            var uid = e.target.parentNode.id.split('-')[0];
            $.get("/ajax/disable_player.php?tid=" + table + "&uid=" + uid, function(data) {
                refreshUnitsList();
            });
        }

        if (c == 'delete-monster')
        {
            var t = e.target.parentNode;
            var uid = e.target.parentNode.id.split('-')[0];
            console.log(uid);
            t.parentNode.removeChild(t);
            $.get("/ajax/delete_monster.php?tid=" + table + "&uid=" + uid, function(data) {

            })
        }
        if (c=="unit-name")
        {
           var uid = e.target.parentNode.parentNode.id.split("-")[0];
           $_('popup').style.innerHTML="";
           $_('popup').style.width="900px";
           $_('popup-container').style.display="block";
           $.get("/ajax/get_character.php?tid="+table+"&uid="+uid,function(data){
               $_("popup").innerHTML=data;
           })
        }
    }, false);

    $_('popup').addEventListener('click', function(e) {
        if (e.target.className == 'add-monster-from-stack') {
            var uid = e.target.id.split('-')[0];
            $.get("/ajax/add_monster.php?tid=" + table + "&uid=" + uid, function(data) {
                console.log(data);
            })
        }
    }, false);

    $_('popup-container').addEventListener('click', function(e) {
        if (e.target.id == 'popup-container')
            $_('popup-container').style.display = "none";
    }, false);
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
