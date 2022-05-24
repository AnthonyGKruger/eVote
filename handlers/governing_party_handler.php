<?php
session_start();
include "../functions.php";

if (isset($_POST['party-name'])) {
    $connection = get_connection();
    $user_id = $_SESSION['user_id'];
    $party_name = stripslashes($_POST['party-name']);
    $party_name = mysqli_real_escape_string($connection, $party_name);
    $party_type = stripslashes($_POST['party-type']);
    $party_type = mysqli_real_escape_string($connection, $party_type);
    $party_status = stripslashes($_POST['party-status']);
    $party_status = mysqli_real_escape_string($connection, $party_status);
    $query = "SELECT * FROM `governing_parties` WHERE `party_name`='$party_name';";
    $results = mysqli_query($connection, $query);
    $rows = mysqli_num_rows($results);

    if ($rows >=1){
        $query = "UPDATE `governing_parties` SET `user_id`='$user_id', `party_name`='$party_name',
            `party_type`='$party_type', `party_status`='$party_status' WHERE `party_name`='$party_name';";

        $results = mysqli_query($connection, $query);

        update_audit_trial($user_id, "Updated party $party_name, SET party_name=$party_name, 
            party_type=$party_type, party_status=$party_status");

        } else {

        $query = "INSERT INTO `governing_parties` VALUES( null,'" . $_SESSION['user_id'] . "', '$party_name',
            '$party_type', '$party_status');";

        $results = mysqli_query($connection, $query);

        update_audit_trial($user_id, "Created party $party_name, party_type=$party_type, 
            party_status=$party_status");
    }
        $connection ->close();
    }

    load_party_admin();
//    header("Location: ../index.php");
//    exit();
