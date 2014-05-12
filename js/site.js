var curTab = "";

function $_(e) {
    return document.getElementById(e);
}

window.addEventListener('load', function()
{
    $_('tabs').addEventListener('click', function(e) {
        var tab = e.target.id.split('-');
        $_(tab[0] + '-content').style.display = 'block';
        if(curTab!="")
        {
            $_(curTab+"-content").style.display='none';
        }
        curTab=tab[0];
    }, false);
}, false);



