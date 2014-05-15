var curTab = "";

function $_(e) {
    return document.getElementById(e);
}

window.addEventListener('load', function()
{
    var tab=window.location.search.split("&");
    for (var i=0; i<tab.length; i++)
    {
        var t=tab[i].split('=');
        if(t[0]=='tab')
            curTab=t[1];
    }
    
    checkTab(curTab);
    $_('tabs').addEventListener('click', function(e) {
        var tab = e.target.id.split('-');

        checkTab(tab[0]);
    }, false);
}, false);

function checkTab(newTab)
{
    console.log(curTab);
    if (curTab != null && curTab != "")
    {
        $_(curTab + "-content").style.display = 'none';
    }
    if (newTab != null && newTab != "") {
        curTab = newTab;
        $_(curTab + '-content').style.display = 'block';
    }
}

