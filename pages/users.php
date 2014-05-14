<?php

$outer_template = "site.php";
$inner_template = "users_t.php";
$css .= "<link rel='stylesheet' href='/css/site.css'>";
$css .= "<link rel='stylesheet' href='/css/character.css'>";
$js .= "<script src='js/site.js'></script>";

if (isset($_SESSION['uid'])) {
    if (isset($_GET['a']) && $_GET['a'] == 'logout') {
        session_destroy();
        header("Location: index.php");
        exit();
    }


    if ($_SESSION['type'] == 'dm') {
        if (isset($_GET['a']) && $_GET['a'] == 'create_table') {
            dm_create_table($db);
        }
        if (isset($_GET['a']) && $_GET['a'] == 'remove_table') {
            $tid = $_GET['tid'];
            deleteDirectory("tables/$tid");
            $db->exec("DELETE FROM `tables` WHERE tid='$tid'");
            header("Location: users.php?tab=tables");
            exit();
        }

        if (isset($_GET['a']) && $_GET['a'] == 'accept_player') {
            $email = $_GET['player'];
            $tid = $_GET['tid'];
            $players = file($_SERVER['DOCUMENT_ROOT'] . "/tables/$tid/players.txt", FILE_IGNORE_NEW_LINES);
            $s = "";
            foreach ($players as $player) {
                $p = preg_split("/;/", $player);
                $status = 0;
                if ($p[3] == '0' && $p[2] == $email) {
                    $status = 1;
                } else {
                    $status = $p[3];
                }
                $s .= $p[0].';'.$p[1].';'.$p[2] . ";$status;" . $p[4] . ";" . $p[5] . "\n";
            }
            $fh = fopen($_SERVER['DOCUMENT_ROOT'] . "/tables/$tid/players.txt", 'wb');
            fwrite($fh, $s);
            $fh = fopen($_SERVER['DOCUMENT_ROOT'] . "/tables/$tid/$email.txt", 'wb');
            $s = "25;25";
            fwrite($fh, $s);
            header("Location: users.php?tab=tables");
            exit();
        }
        if (isset($_POST['a']) && $_POST['a'] == 'create_monster') {
            if (strlen($_POST['name']) > 0 && strlen($_POST['size']) > 0) {
                $s = $_POST['name'] . ';' . $_POST['size'] . ";25;25\n";
                $tid = $_POST['table'];
                $fh = fopen("tables/$tid/monsters.txt", "ab");
                fwrite($fh, $s);
            } else {
                echo 'fields are not set';
            }
            exit();
        }
        $inner_template = "home_dm_t.php";
        //$tables = $db->query()
        $tables = "";
        $email = $_SESSION['email'];
        $query = "SELECT * FROM `tables` WHERE dm='$email';";

        $tables_list = "";
        foreach ($db->query($query) as $r) {
            $tid = $r['tid'];
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
                //$s .= $p[0]. ";$status\n";
            }
            //$fh = fopen($_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt",'w');
            //fwrite ($fh, $s);
            $content .= "<tr><td>";
            $content .= $r['tid'] .
                    "<a href='battle.php?table={$r['tid']}'>Entra</a></td>" .
                    "<td>Description</td>" . "<td>$participants</td>" .
                    "<td>$candidates</td>" .
                    "<td><a href='?a=remove_table&tid={$r['tid']}'>Remove</a></td>";
            $content .= "</tr>";
        }
        $content .= "";
    } else if ($_SESSION['type'] == 'player') {
        if (isset($_GET['a']) && $_GET['a'] == 'ask_for_enter') {

            $fh = fopen($_SERVER['DOCUMENT_ROOT'] . "/tables/" . $_GET['table'] . "/players.txt", 'ab');
            fwrite($fh, $_SESSION['type'].';'.$_SESSION['uid'].';'.$_SESSION['email'] . ";0;25;25\n");
            header("Location: users.php?tab=tables");
            exit();
        }
        if (isset($_POST['a']) && $_POST['a'] == 'file_upload') {
            if ($_FILES["file"]["error"] > 0) {
                echo "Error: " . $_FILES["file"]["error"] . "<br>";
            } else {
                $ext = pathinfo($_FILES["file"]['name'], PATHINFO_EXTENSION);
                 move_uploaded_file($_FILES["file"]["tmp_name"],
       "images/characters/" . $_SESSION['uid'] .".".$ext );
            }
        }

        $inner_template = "home_player_t.php";
        $query = "SELECT * FROM `tables`;";
        foreach ($db->query($query) as $r) {
            $tid = $r['tid'];

            $dm = $r['dm'];
            $content .= "$tid $dm ";
            $tables = file($_SERVER['DOCUMENT_ROOT'] . "/tables/" . $tid . "/players.txt");
            $is_part = false;

            foreach ($tables as $t) {
                $user = preg_split("/;/", $t);

                if ($user[2] == $_SESSION['email']) {
                    $is_part = true;
                }
            }
            if ($is_part == true) {
                if ($user[3] == 1) {
                    $content .= "<a href='battle.php?table=$tid'>Entra</a><br/>";
                } else {
                    $content .= "DM is not added you to this table yet";
                }
            } else {
                $content .= "<a href='?a=ask_for_enter&table=$tid'>Ask for enter</a>";
            }
            $content .= "<br/>";
        }
        $ch_info['avatar']="";
        $image='images/characters/'.$_SESSION['uid'].'.jpg';
        if(file_exists($image))
                $ch_info['avatar']=$image;
    }
} else if (isset($_POST['a'])) {
    $a = $_POST['a'];
    if ($a == 'register') {
        $uid = uniqid();
        $email = $_POST['email'];
        $pswd = $_POST['pswd'];
        $type = $_POST['type'];
        $r = $db->exec("INSERT INTO users SET uid='$uid', email='$email', pswd='" . md5($pswd) . "', type='$type';");
        header("Location: users.php?tab=login");
    } else if ($a == 'login') {
        $email = $_POST['email'];
        $pswd = md5($_POST['pswd']);
        $st = $db->query("SELECT * FROM users WHERE email='$email' && pswd='$pswd';");
        $st = $st->fetch();
        $debug .= $st['type'];
        $_SESSION['uid'] = $st['uid'];
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $st['type'];
        header("Location: users.php?tab=tables");
    }
    exit();
} else {
    $inner_template = "users_t.php";
}

function dm_create_table($db) {
    $tid = uniqid();
    $dm = $_SESSION['email'];
    $type = $_SESSION['type'];
    if ($type != "dm") {
        header("Location: users.php?tab=tables");
        exit();
    }
    mkdir("tables/$tid");
    fopen("tables/$tid/players.txt", 'w');
    fopen("tables/$tid/monsters.txt", 'w');
    fopen("tables/$tid/battle_grid.txt", 'w');
    fopen("tables/$tid/chat.txt", 'w');
    $r = $db->exec("INSERT INTO `tables` SET dm='$dm', tid='$tid';");
    header("Location: users.php?tab=tables");
    exit();
}

?>