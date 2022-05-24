<?php
if(!defined('APPROVED')) {
    die('Direct access not permitted' . $_SERVER['SCRIPT_NAME']);
}

require "../header.php";

$email = stripslashes($_POST['email']);
$email = mysqli_real_escape_string($connection, $email);

$contact_number = stripslashes($_POST['contact-number']);
$contact_number = mysqli_real_escape_string($connection, $contact_number);

$address = stripslashes($_POST['address']);
$address = mysqli_real_escape_string($connection, $address);

$query = "UPDATE `users` SET `user_address` = '". $address ."', `user_email` = '". $email ."', 
        `user_contact_number` = '". $contact_number ."' WHERE `users`.`user_email` = '". $_SESSION['username'] ."';";

$results = mysqli_query($connection, $query);

$connection ->close();

$_SESSION['username'] = $email;

header("Location: ../index.php");
