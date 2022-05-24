<?php
include 'header.php';
//print_r($_SESSION);
//exit();
if (sizeof($_SESSION) > 0){
    if (($_SESSION['user_type'] == 'approved') || ($_SESSION['user_type'] == 'admin')){
        session_destroy();
        header('Location: login.php');
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}