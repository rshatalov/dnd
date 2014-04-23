<?php
$outer_template = "site.php";
$inner_template = "games.php";
$content = "";
if (!isset($_GET['a']))
{
    $a = scandir('tables');
    for ($i = 2; $i < count($a); $i++)
    {
        $content .= "table: {$a[$i]} - <a href='battle.php?mode=dm&table={$a[$i]}'>DM</a> | "
        . "<a href='battle.php?mode=player&table={$a[$i]}'>player</a><br/>";
    }
    $content .= "<a href='?a=new_table'>New Table</a>";
}
else if ($_GET['a'] == "new_table")
{
    $tid = uniqid();
    mkdir("tables/$tid");
    header("Location: /tables.php");
}
$css .= "<link rel='stylesheet' href='/css/site.css'>";

?>