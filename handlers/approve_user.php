<?php
session_start();
include "../functions.php";

if(isset($_POST['user-list'])){

    update_audit_trial($_SESSION['user_id'], 'Updated user identity ' . $_POST['user-list'] . ' to 
        user type to approved');

    $connection = get_connection();

    $query = "UPDATE `users` SET `user_type`='approved' WHERE `user_identity`='" . $_POST['user-list'] . "';";

    $results = mysqli_query($connection, $query);

    if($connection ->query($query) == true){
//        echo $query . "<br>";
        //get_users_table();
        approve_user_main_content();
    } else {
        echo 'failure ' . $connection ->error;
    }

}


