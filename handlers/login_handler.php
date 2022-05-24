<?php

include '../header.php';

if (isset($_POST['username'])){


    $username = stripslashes($_POST['username']);
    $username = mysqli_real_escape_string($connection, $username);
    $password = stripslashes($_POST['user-password']);
    $password = mysqli_real_escape_string($connection, $password);
    $query = "SELECT * FROM `users` WHERE `user_email`='$username' AND `user_password`='" . md5($password) . "' AND NOT `user_type`='un-activated';";
    $results = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($results);

    print_r($_SESSION);
    if ($rows >= 1){

        $_SESSION['username'] = $username;
        $user_id = $rows['user_id'];
        $query = "SELECT `user_id`, `user_type` FROM `users` WHERE `user_email`='" . $username . "';";
        $results = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC);
        $user_id = $row['user_id'];
        if($row['user_type'] == 'admin'){
            $_SESSION['user_type'] = 'admin';
        } else {
            $_SESSION['user_type'] = 'approved';
        }
        $_SESSION['user_id'] = $user_id;

        $query = "UPDATE `users` SET `date_last_used`='". date("Y-m-d") ."' WHERE `user_id`='" . $user_id . "';";
        $results = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($results, MYSQLI_ASSOC);

        $connection->close();

        header("Location: ../users_page.php");
    } else {
        $_SESSION['verified'] = 'false';

        header('Location: ../login.php');
    }
}
