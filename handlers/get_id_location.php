<?php

include "../functions.php";

if (isset($_POST['user_id'])){

    $connection = get_connection();

    $query = "SELECT `id_upload_location` FROM `users` WHERE `user_identity`= '". $_POST['user_id'] ."';";

    $result = mysqli_query($connection, $query);

    if ($connection->query($query) == true) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

        echo $row['id_upload_location'];
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
}
