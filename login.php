<?php

include "header.php";

if (sizeof($_SESSION) > 0) {

    if (isset($_SESSION['user_type'])) {
        if (($_SESSION['user_type'] == 'approved') || ($_SESSION['user_type'] == 'admin')) {
            header('Location: index.php');
        }
    } elseif (isset($_SESSION['just-registered'])){
        if ($_SESSION['just-registered']='true'){
            session_destroy();
            load_login_unverified();
        }
    }
} else {
    load_login();
}







