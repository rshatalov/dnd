<?php
$outer_template = "site.php";
$inner_template = "users.php";
$css .= "<link rel='stylesheet' href='/css/site.css'>";

if (isset($_SESSION['email']))
{

}
else if (isset($_POST['a']))
{
    $a = $_POST['a'];
    if ($a == 'register')
    {
   
    $email = $_POST['email'];
    $pswd = $_POST['pswd'];
    $type = $_POST['type'];
    $debug .= $_POST['a'] . "<br/>" . $email . "<br/>".$pswd."<br/>".$type;
    $r = $db->exec("INSERT INTO users SET email='$email', pswd='".md5($pswd)."', type='$type';");
    $debug .= "<hr/>$r";
    }
    else if ($a == 'login')
    {
        $email = $_POST['email'];
        $pswd = md5($_POST['pswd']);
        $st = $db->query("SELECT * FROM users WHERE email='$email' && pswd='$pswd';");
        $debug .= $_POST['a'] . "<br/>" . $pswd . "<br/>";
        $st = $st->fetch();
        $debug .= $st['type'];
        $_SESSION['email'] = $email;
        $_SESSION['type'] = $st['type'];
    }
}
if (isset($_GET['a']))
{
    $a = $_GET['a'];
    if ($a== 'logout')
    {
        session_destroy();
        header("Location: users.php");
        
    }
    
}

?>