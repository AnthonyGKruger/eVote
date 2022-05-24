<?php
include '../functions.php';
if(isset($_POST['confirm-password-button']) && $_POST['key'] && $_POST['reset']) {
    $email = $_POST['email'];
    $pass = md5($_POST['new-password']);
    $connection = get_connection();

    $query = "UPDATE `users` SET `user_password`='$pass' WHERE MD5(`user_email`)='$email';";

    $results = mysqli_query($connection, $query);

    $row = mysqli_num_rows($results);
echo   "password successfully changed.<br>";
    //header("Location: ../index.php");
}