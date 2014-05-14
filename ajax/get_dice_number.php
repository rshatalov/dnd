<?php

$dice=$_GET['dice'];
$n=substr($dice,4);
$n=rand(1,(int)$n);
echo $n;