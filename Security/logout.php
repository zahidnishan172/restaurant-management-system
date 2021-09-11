<?php

if(session_status()==PHP_SESSION_NONE){
    session_start();
}
unset($_SESSION['username']);
if(isset($_SESSION['type'])) unset($_SESSION['type']);
header('location: ../Public/login.php');