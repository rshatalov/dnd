window.addEventListener('load', function() {
    if (!$_("choose-avatar-image")) {
        return;
    }
    $("#class-container").perfectScrollbar({
        suppressScrollX: true
    });
    $_("choose-avatar-image").onclick = function()
    {
        $("#hidden-avatar-uploader").click();
    };
    $_("hidden-avatar-uploader").onchange = function() {
        $_("upload-avatar-image").style.display = 'block';
    };
    $_("upload-avatar-image").onclick = function()
    {
        var file = $_('hidden-avatar-uploader').files[0];
        var fd = new FormData();
        fd.append('file', file);
        fd.append('a', 'upload_image');
        fd.append('uid', $_('uid').value);
        $.ajax({
            url: "/character.php",
            type: "POST",
            data: fd,
            processData: false, // tell jQuery not to process the data
            contentType: false, // tell jQuery not to set contentType
            success: function(data) {
                console.log(data);
                $_("upload-avatar-image").style.display = 'none';
                $_(data + "-avatar").src = '/images/units/' + data + ".png?" + new Date().getTime();
            }
        });
    };
    $_("add-class").addEventListener("click", function() {
        var NoClasses = parseInt($_("NoClasses").value) + 1;
        $_("NoClasses").value = NoClasses;
        var t = document.createElement('div');
        t.innerHTML = "<div class='bb'><input type='text' id='class"+NoClasses+"' class='w219 h28 fl mr9' name='class"+NoClasses+"' placeholder='CLASSE'><input type='text' id='level"+NoClasses+"' class='w60 h28 ac' name='level"+NoClasses+"' placeholder='LIV.'></div>";
        $_("classes-and-levels").appendChild(t);
        $('#class-container').perfectScrollbar('update');

    }, false);
    
    $_("add-borsa").addEventListener("click", function() {
        var b = parseInt($_("zaino").value) + 1;
        $_("zaino").value = b;
        var t = document.createElement('div');
        t.innerHTML = "<input type='text' id='borsa"+b+"' class='cb w435 bb br h19 fl' placeholder='Item' name='borsa"+b+"'><input type='text' id='borsa"+b+"-peso' class='cb bb w58 h19 fl' id='borsa"+b+"-peso' placeholder='Peso' name='borsa"+b+"_peso'><div style='clear: both'></div>";
        $_("borsas").appendChild(t);

    }, false);

    $_("post-unit").addEventListener("click", function() {

        var fd = $('#unit-form').serialize();
        $.post("character.php", fd, function(data) {
            console.log(data);
        });
    }, false);


    function recompute()
    {
        $_('strength-mod').innerHTML = parseInt(($_('strength-points').value - 10) / 2);
        $_('force-mod').innerHTML = parseInt(($_('force-points').value - 10) / 2);
        $_('dexterity-mod').innerHTML = parseInt(($_('dexterity-points').value - 10) / 2);
        $_('intelligence-mod').innerHTML = parseInt(($_('intelligence-points').value - 10) / 2);
        $_('wisdom-mod').innerHTML = parseInt(($_('wisdom-points').value - 10) / 2);
        $_('charism-mod').innerHTML = parseInt(($_('charism-points').value - 10) / 2);
        $_('dexterity-armor').innerHTML = $_('dexterity-mod').innerHTML;
        $_('dexterity-initiative').innerHTML = $_('dexterity-mod').innerHTML;
        $_('tot-initiative').innerHTML = parseInt($_('dexterity-initiative').innerHTML) + parseInt($_('var-initiative').value);
        switch ($_('size').value)
        {
            case 'P':
                $_('size-armor').innerHTML = '1';
                break;
            case 'M':
                $_('size-armor').innerHTML = '0';
                break;
            case 'G':
                $_('size-armor').innerHTML = '-1';
                break;
            case 'E':
                $_('size-armor').innerHTML = '-2';
                break;
            case 'S':
                $_('size-armor').innerHTML = '-3';
                break;
            case 'C':
                $_('size-armor').innerHTML = '-4';
                break;
            default:
                $_('size-armor').innerHTML = '';
        }
        
        $_('gradi-max-classe').innerHTML = parseInt($_("level1").value)+3;
        $_('gradi-max-nonclasse').innerHTML = parseInt(parseInt($_('gradi-max-classe').innerHTML) /2);
        $_('tempra-mod').innerHTML = $_('force-mod').innerHTML;
        $_('riflessi-mod').innerHTML = $_('dexterity-mod').innerHTML;
        $_('volonta-mod').innerHTML = $_('wisdom-mod').innerHTML;
        $_('lotta-for').innerHTML = $_('strength-mod').innerHTML;
        $_('tempra-tot').innerHTML = parseInt($_('tempra-base').value) + parseInt($_('tempra-mod').innerHTML)+ parseInt($_('tempra-magia').value)+ parseInt($_('tempra-vari').value) + parseInt($_('tempra-temp').value);
        
        $_('riflessi-tot').innerHTML = parseInt($_('riflessi-base').value) + parseInt($_('riflessi-mod').innerHTML)+ parseInt($_('riflessi-magia').value)+ parseInt($_('riflessi-vari').value) + parseInt($_('riflessi-temp').value);
       
        $_('volonta-tot').innerHTML = parseInt($_('volonta-base').value) + parseInt($_('volonta-mod').innerHTML)+ parseInt($_('volonta-magia').value)+ parseInt($_('volonta-vari').value) + parseInt($_('volonta-temp').value);
        
        $_('riflessi-mod').innerHTML = $_('dexterity-mod').innerHTML;
        $_('volonta-mod').innerHTML = $_('wisdom-mod').innerHTML;
        $_('lotta-for').innerHTML = $_('strength-mod').innerHTML;
        $_('lotta-attaco-base').innerHTML = $_('attaco-base').value;
    }
    recompute();
    
    window.addEventListener('scroll',function() {
        if ((window.pageYOffset || document.documentElement.scrollTop) > 400)
            $_('post-unit').style.top = (window.pageYOffset || document.documentElement.scrollTop) - 200 + 'px';
        else
            $_('post-unit').style.top = '200px';
    },false);

}, false);