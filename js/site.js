var curTab = "";

function $_(e) {
    return document.getElementById(e);
}

window.addEventListener('load', function()
{
    curTab = window.location.search.split("=")[1];
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

