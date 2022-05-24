<?php
session_start();

include "../functions.php";

if (isset($_POST['vote-button'])) {

    $connection = get_connection();

    $query = "SELECT `last_vote` FROM `users` WHERE `user_id`='" . $_SESSION['user_id'] . "'";

    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($result);

    $user_last_vote = $row['last_vote'];
    $user_last_vote_time = strtotime($row['last_vote']);
    $opening_date = strtotime(get_election_opening_date());
    $closing_date = strtotime(get_election_closing_date());
    $today = strtotime(date("Y-m-d G:i:s"));

    if ($user_last_vote == " ") {
        do_vote();
        update_audit_trial($_SESSION['user_id'], "Voted - " . date("Y-m-d G:i:s"));
        header('Location: ../stats.php');

    } elseif ($user_last_vote_time < $opening_date){
        do_vote();
        update_audit_trial($_SESSION['user_id'], "Voted - " . date("Y-m-d G:i:s"));
        header('Location: ../stats.php');

    }elseif (($user_last_vote_time >= $opening_date) && ($user_last_vote_time <= $closing_date)){
        update_audit_trial($_SESSION['user_id'], "Attempted to cast vote twice for party: " .
            $_POST['parties'] . " ---- on the " . date("Y-m-d G:i:s"));
        header('Location: ../index.php');
    } else {
        echo "something went wrong";
    }

}