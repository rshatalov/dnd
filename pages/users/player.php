<?php

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
