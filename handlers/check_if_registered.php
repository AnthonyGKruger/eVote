<?php
include "../functions.php";

if(isset($_POST['id'])){

    $id = $_POST['id'];

    $connection = get_connection();

    $query = "SELECT `user_identity` FROM `users` WHERE `user_identity`='$id';";
    $result = mysqli_query($connection,$query);

    if(mysqli_num_rows($result) == 1){
        echo 'this user already exists.';
    }
}