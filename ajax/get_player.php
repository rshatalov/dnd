<?php
session_start();
echo $_SESSION['user_name'].';'.$_SESSION['type'].";".$_SESSION['uid'];

