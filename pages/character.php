<?php

$ch= new Character($_SESSION['email']);
$ch->process($_POST);
print_r ($ch->debug());
//print_r($_GET);
