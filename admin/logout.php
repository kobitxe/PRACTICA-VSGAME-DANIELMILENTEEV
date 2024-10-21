<?php
session_start(); 

if (isset($_GET['logout']) && $_GET['logout'] == 'true') {

    session_unset();
    session_destroy();

    setcookie('usuario', '', time() - 3600, "/"); 

    header("Location: login.php");
    exit();
}