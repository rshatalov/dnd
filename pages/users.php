<?php

$outer_template = "site.php";
$inner_template = "users_t.php";
$css .= "<link rel='stylesheet' href='/css/site.css'>";
$css .= "<link rel='stylesheet' href='/css/character.css'>";
$js .= "<script src='js/site.js'></script>";

if (isset($_GET['a']) && $_GET['a'] == 'logout') {
    session_destroy();
    header("Location: index.php?tab=login");
    exit();
}

if (isset($_SESSION['uid'])) {
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
        if (isset($_POST['a']) && $_POST['a'] == 'create_monster') {
            if (strlen($_POST['name']) > 0 && strlen($_POST['size']) > 0) {
                if ($_FILES["file"]["error"] > 0) {
                    echo "Error: " . $_FILES["file"]["error"] . "<br>";
                } else {
                    $mid = $_POST['mid'];
                    $to = "images/monsters/" . $mid . ".png";
                    $from = "images/monsters/" . $_FILES['file']['name'];
                    convert_to_png($from, $to);
                    $size = $_POST['size'];

                    $name = $_POST['name'];
                    $db->exec("insert into monsters set mid='$mid', name='$name', size='$size'");
                    header("Location: users.php?tab=monsters");
                }
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

        if (isset($_GET['a']) && $_GET['a'] == 'create_monster') {
            $mid = uniqid();
            // $db->exec("insert into monsters set mid='$mid'");
            $monsters = "mid: $mid<br/>";
            $monsters.=<<<M
               <form method="post" action="users.php" enctype="multipart/form-data">
        <input type="text" placeholder="name" name="name"></br>
        <input type="text" placeholder="size" name="size"></br>
       <input type="file" name="file"><br/>
                    <input type="hidden" name="a" value="create_monster">
                    <input type="hidden" name="mid" value="$mid">
         <input type="submit">
         <input type="hidden" name="a" value="create_monster">
    </form>
M;
        } else {
            $monsters = "";
            $monsters.="<a href='users.php?a=create_monster&tab=monsters'>Create monster</a>";
        }
    } else if ($_SESSION['type'] == 'player') {
        if (isset($_GET['a']) && $_GET['a'] == 'ask_for_enter') {

            $fh = fopen($_SERVER['DOCUMENT_ROOT'] . "/tables/" . $_GET['table'] . "/players.txt", 'ab');
            fwrite($fh, $_SESSION['type'] . ';' . $_SESSION['uid'] . ';' . $_SESSION['email'] . ";0;25;25\n");
            header("Location: users.php?tab=tables");
            exit();
        }
        if (isset($_POST['a']) && $_POST['a'] == 'file_upload') {
            if ($_FILES["file"]["error"] > 0) {
                echo "Error: " . $_FILES["file"]["error"] . "<br>";
            } else {
                 $to = "images/characters/" . $_SESSION['uid'] . ".png";
                    $from = "images/characters/" . $_FILES['file']['name'];
                    convert_to_png($from, $to);
               
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

                if ($user[1] == $_SESSION['uid']) {
                    $is_part = true;
                    if ($user[3] == '1')
                        $content .= "<a href='battle.php?table=$tid'>Entra</a><br/>";
                    else
                        $content .= "DM is not added you to this table yet";
                }
            }
            if ($is_part != true) {
                $content .= "<a href='?a=ask_for_enter&table=$tid'>Ask for enter</a>";
            }
            $content .= "<br/>";
        }
        //$ch_info = array();
        $character = new Character($_SESSION['uid'],$_SESSION['uid'],$db);
        $ch_info = $character->template();
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
    mkdir("tables/$tid/scroll");
    fopen("tables/$tid/scroll.txt", 'w');
    fopen("tables/$tid/players.txt", 'w');
    fopen("tables/$tid/battle_grid.txt", 'w');
    fopen("tables/$tid/chat.txt", 'w');
    $r = $db->exec("INSERT INTO `tables` SET dm='$dm', tid='$tid';");
    header("Location: users.php?tab=tables");
    exit();
}

?>