<?php

$outer_template = "site.php";
$inner_template = "users_t.php";
$css .= "<link rel='stylesheet' href='/css/site.css'>";

if (isset($_SESSION['email'])) {
    if (isset($_GET['a']) && $_GET['a'] == 'logout') {
        session_destroy();
        header("Location: users.php");
        exit();
    }
    if (isset($_GET['a']) && $_GET['a'] == 'remove') {
        $tid = $_GET['table'];
        rmdir("tables/$tid");
        $db->exec("DELETE FROM `tables` WHERE tid='$tid'");
        header("Location: users.php");
        exit();
    }


    if ($_SESSION['type'] == 'dm') {
        if (isset($_GET['a']) && $_GET['a'] == 'create_table') {
            $tid = uniqid();
            $dm = $_SESSION['email'];
            mkdir("tables/$tid");
            fopen("tables/$tid/players.txt",'wb');
            fopen("tables/$tid/battle_grid.txt",'wb');
            $r = $db->exec("INSERT INTO `tables` SET dm='$dm', tid='$tid';");
            header("Location: users.php");
            exit();
        }
        if (isset($_GET['a']) && $_GET['a'] == 'accept_player') {
            $email = $_GET['player'];
            $tid = $_GET['tid'];
            $players = file($_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt", FILE_IGNORE_NEW_LINES);
            $s = "";
            foreach ($players as $player)
            {
                $p = preg_split("/;/",$player);
                $status = 0;
                if ($p[1] == '0' && $p[0] == $email)
                {
                    $status = 1;
                }
                $s .= $p[0]. ";$status\n";
            }
            $fh = fopen($_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt",'wb');
            fwrite ($fh, $s);
            $fh = fopen($_SERVER['DOCUMENT_ROOT']."/tables/$tid/$email.txt",'wb');
            $s = "25;25";
            fwrite ($fh, $s);
            header("Location: users.php");
            exit();
                    
        }
        $inner_template = "home_dm_t.php";
        //$tables = $db->query()
        $tables = "";
        $email = $_SESSION['email'];
        $query = "SELECT * FROM `tables` WHERE dm='$email';";
 
        
        foreach ($db->query($query) as $r)
        {
            $tid = $r['tid'];
            $players = file($_SERVER['DOCUMENT_ROOT']."/tables/$tid/players.txt", FILE_IGNORE_NEW_LINES);
            $s = "";
            $candidates = "";
            $participants = "";
            foreach ($players as $player)
            {
                $p = preg_split("/;/",$player);
                $email = $p[0];
                $status = 0;
                if ($p[1] == '0')
                {
                    $candidates .= $p[0];
                    $candidates .= " <a href='?a=accept_player&player=$email&tid=$tid'>Accept</a> ";
                    $candidates .= "<a href='?a=decline_player&player=$email''>No</a>";
                    $candidates .= "<br/>";
                }
                else if ($p[1] == '1')
                {
                    $participants .= $p[0];
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
                                "<td>$candidates</td>".
                        "<td><a href='?a=remove&table={$r['tid']}'>Remove</a></td>";
                       $content .= "</tr>";
        }
        $content .= "";
    }
    else if ($_SESSION['type'] == 'player')
    {
        if (isset($_GET['a']) && $_GET['a'] == 'ask_for_enter') {
            $fh = fopen($_SERVER['DOCUMENT_ROOT']."/tables/".$_GET['table']."/players.txt",'ab');
            fwrite($fh,$_SESSION['email'].";0\n");
            header("Location: users.php");
            exit();
        }
        $inner_template = "home_player_t.php";
        //$email = $_SESSION['email'];
        $query = "SELECT * FROM `tables`;";
        foreach ($db->query($query) as $r)
        {
            $tid = $r['tid'];
            
            $dm = $r['dm'];
            $content .= "$tid $dm ";
            $tables = file($_SERVER['DOCUMENT_ROOT']."/tables/".$tid . "/players.txt");
            $is_part = false;
            
            foreach ($tables as $t)
            {
                $user = preg_split("/;/",$t);
                
                if ($user[0] == $_SESSION['email'])
                {
                    $is_part = true;
                }
                    
            }
            if ($is_part == true)
            {
                if ($user[1] == 1)
                {
                $content .= "<a href='battle.php?table=$tid'>Entra</a><br/>";
                }
                else
                {
                    $content .= "DM is not added you to this table yet";
                }
            }
            else
            {
                $content .= "<a href='?a=ask_for_enter&table=$tid'>Ask for enter</a>";
            }
            $content .= "<br/>";
        }
    }
} else if (isset($_POST['a'])) {
    $a = $_POST['a'];
    if ($a == 'register') {

        $email = $_POST['email'];
        $pswd = $_POST['pswd'];
        $type = $_POST['type'];
        $debug .= $_POST['a'] . "<br/>" . $email . "<br/>" . $pswd . "<br/>" . $type;
        $r = $db->exec("INSERT INTO users SET email='$email', pswd='" . md5($pswd) . "', type='$type';");
        $debug .= "<hr/>$r";
    } else if ($a == 'login') {
        $email = $_POST['email'];
        $pswd = md5($_POST['pswd']);
        $st = $db->query("SELECT * FROM users WHERE email='$email' && pswd='$pswd';");
        $debug .= $_POST['a'] . "<br/>" . $pswd . "<br/>";
        $st = $st->fetch();
        $debug .= $st['type'];
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $st['type'];
    }
    header("Location: users.php");
            exit();
} else {
    $inner_template = "users_t.php";
}
?>