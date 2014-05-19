<?php
session_start();
echo $_SESSION['email'].';'.$_SESSION['type'].";".$_SESSION['uid'];

