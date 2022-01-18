<?php
session_start();
if(!isset($_SESSION['username'])){
    die("Zuerst einloggen: <a href='login.php'>Login</a>");
}
echo "<a href='logout.php'>Logout</a><Style>a{float: right;}</Style>";
echo "Hello ".$_SESSION['username'];