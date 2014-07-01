<?php

$inner_template = "users/home_dm_t.php";

if (isset($_GET['a']))
    $a = $_GET['a'];
if (isset($_POST['a']))
    $a = $_POST['a'];
if (isset($a))
switch ($a) {
    case "create_table":
        dm_create_table($db);
        break;
    case "remove_table":
        dm_remove_table($db);
        break;
    case "accept_player":
        dm_accept_player($db);
        break;

    default:
        break;
}


$tables = "";
$user_name = $_SESSION['user_name'];
$query = "SELECT * FROM `tables` WHERE dm_user_name='$user_name';";

$tables_list = "";
foreach ($db->query($query) as $r) {
    $tid = $r['tid'];
    $table_name = $r['table_name'];
    $table_desc = $r['table_desc'];
   
    $tables_list.= "<option>$tid</option>";
    $players = file($_SERVER['DOCUMENT_ROOT'] . "/tables/$tid/players.txt", FILE_IGNORE_NEW_LINES);
    $s = "";
    $candidates = "";
    $participants = "";
    foreach ($players as $player) {
        $p = preg_split("/;/", $player);
        $email = $p[2];
        $status = 0;
        if ($p[3] == '0') {
            $candidates .= $p[2];
            $candidates .= " <a href='?a=accept_player&player=$email&tid=$tid'>Accept</a> ";
            $candidates .= "<a href='?a=decline_player&player=$email'>No</a>";
            $candidates .= "<br/>";
        } else if ($p[3] == '1') {
            $participants .= $p[2];
            $participants .= "<br/>";
        }
    }
    $content .= "<tr><td>";
    $content .= $r['table_name'] .
            "<a href='battle.php?table={$r['tid']}'>Entra</a></td>" .
            "<td>$table_desc</td>" . "<td>$participants</td>" .
            "<td>$candidates</td>" .
            "<td><a href='?a=remove_table&tid={$r['tid']}'>Remove</a></td>";
    $content .= "</tr>";
}
$content .= "";

    $mt = "<a href='users.php?tab=createMonster&a=monster_form_create'>Create monster</a>";
    $query = "SELECT * FROM units WHERE user_id='{$_SESSION['uid']}'";
    foreach ($db->query($query) as $unit)
    {
        if ($unit['name'] != NULL)
            $name = $unit['name'];
        else
            $name = "n/a";
        $mt .= "<div>$name <span><a href='users.php?tab=editMonster&a=monster_form_edit&uid={$unit['uid']}'>edit</a></span></div>";
    }
$nt = ""; // new tab

if (isset($_GET['a']) && $_GET['a'] == 'monster_form_create') {
    $rows = $db->query("SELECT COUNT(*) FROM units WHERE user_id='{$_SESSION['uid']}' && name IS NULL;")->fetchColumn();
    //$rows = $rows->fetch();
    //$rows = $rows[0];
    print_r($rows);
    if ($rows == 0)
    {
    $ch = new Unit($db);
    $ch->create_monster($_SESSION['uid'],$_SESSION['email']);
    $nt = "create_monster";
    }
    else
        header("Location: users.php?tab=monsters");
    //$ch->generate_template;
} else if (isset($_GET['a']) && $_GET['a'] == 'monster_form_edit') {
    $nt = "edit_monster";
    $ch = new Unit($db);
    $uid = $_GET['uid'];
    $ch->load_unit($uid);
}



function dm_create_table($db) {
    $tid = uniqid();
    $dm_user_name = $_SESSION['user_name'];
    $dm_uid = $_SESSION['uid'];
    $type = $_SESSION['type'];
    $table_name = $_POST['table_name'];
    $table_desc = $_POST['table_desc'];
    if ($type != "dm") {
        header("Location: users.php?tab=tables");
        exit();
    }
    mkdir("tables/$tid");
    mkdir("tables/$tid/scroll");
    fopen("tables/$tid/scroll.txt", 'w');
    fopen("tables/$tid/players.txt", 'w');
    fopen("tables/$tid/battle_grid.txt", 'w');
    fopen("tables/$tid/chat.txt", 'w');
    $r = $db->exec("INSERT INTO `tables` SET dm_uid='$dm_uid', dm_user_name='$dm_user_name', tid='$tid', table_name='$table_name', table_desc='$table_desc';");
    header("Location: users.php?tab=tables");
    exit();
}

function dm_remove_table($db) {
    $tid = $_GET['tid'];
    deleteDirectory("tables/$tid");
    $db->exec("DELETE FROM `tables` WHERE tid='$tid'");
    header("Location: users.php?tab=tables");
    exit();
}

function dm_accept_player($db) {
    $colors = array("#00ff00", "#0000ff", "#ffff00", "#00ffff", "ff00ff", "#aa3478", "#33b945");

    $email = $_GET['player'];
    $tid = $_GET['tid'];
    $players = file_get_contents($_SERVER['DOCUMENT_ROOT'] . "/tables/$tid/players.txt");
    $players = preg_split("/\n/", $players);
    $c = 0;
    $s = "";
    for ($i = 0; $i < count($players); $i++) {
        if ($players[$i] == "")
            continue;
        $t = preg_split("/;/", $players[$i]);
        if ($t[3] == '0' && $t[2] == $email) {
            $p = $t;
            $p[3] = 1;
        }
        if (isset($t[6]) && $t[0] == 'player')
            $c++;
        if ($t[2] != $email)
            $s.= $players[$i] . "\n";
    }
    $p[6] = $colors[$c];
    $p[7] = time() - 100;
    $s.=$p[0] . ";" . $p[1] . ";" . $p[2] . ";" . $p[3] . ";" . $p[4] . ";" . $p[5] . ";" . $p[6] . ";" . $p[7] . "\n";

    $fh = fopen($_SERVER['DOCUMENT_ROOT'] . "/tables/$tid/players.txt", 'w');
    fwrite($fh, $s);
    fclose($fh);

    header("Location: users.php?tab=tables");
    exit();
}