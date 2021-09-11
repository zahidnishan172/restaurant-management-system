<?php

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['username'])||!isset($_SESSION['username'])||strcmp($_SESSION['type'],'admin')){
    header('location: ../Public/index.php');
}
