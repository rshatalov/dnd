<?php
$outer_template = "site.php";
$css .= "<link rel='stylesheet' href='/css/site.css'>";
if ($_SESSION['type'] == 'dm')
{
    if (isset($_GET['a']) && $_GET['a']=='create_table')
    {
        $tid = uniqid();
        mkdir("tables/$tid");
        header("Location: index.php");
        exit();
    }
    $inner_template = "home_dm.php";
    //$tables = $db->query()
    $tables = "";
    $a = scandir('tables');
    for ($i = 2; $i < count($a); $i++)
    {
        $content .= "table: {$a[$i]} - "
        . "<a href='battle.php?table={$a[$i]}'>DM</a><br/>";
    }
    $content .= "";
}
else
{
    
}
?>