<?php

$outer_template = "site.php";
$inner_template = "users/users_t.php";
$css .= "<link rel='stylesheet' href='/css/site.css'>";
$css .= "<link rel='stylesheet' href='/css/character.css'>";
$js .= "<script src='js/site.js'></script>";
$js .= "<script src='//ajax.googleapis.com/ajax/libs/jquery/2.1.0/jquery.min.js'></script>";
$js .= "<script src='js/unit.js'></script>";

if (isset($_GET['a']) && $_GET['a'] == 'logout') {
    session_destroy();
    header("Location: index.php?tab=login");
    exit();
}

if (isset($_SESSION['uid'])) {
    if ($_SESSION['type'] == 'dm') {
        require_once "pages/users/dm.php";
    } else if ($_SESSION['type'] == 'player') {
        require_once "pages/users/player.php";
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
}

?>