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
    $_("add-class").addEventListener("click",function(){
        $_("classes-and-levels").innerHTML += "<input type='text'class='w32 fl mr' name='class' placeholder='CLASS'>";
        $_("classes-and-levels").innerHTML += "<input type='text' class='w11' name='level' placeholder='LEVEl'>";
        console.log('add class');
        $('#class-container').perfectScrollbar('update');
  
    },false);

    $_("post-unit").addEventListener("click", function() {

        var fd = $('#unit-form').serialize();
        $.post("character.php", fd, function(data) {
            console.log(data);
        });
    }, false);
}, false);