<?php

function get_connection()
{
    $connection = new mysqli("localhost", "u313581005_Anthony", "RGITproject700",
        "u313581005_evote") or die($connection->error);
    return $connection;
}

function update_audit_trial($user_id, $description)
{
    $connection = get_connection();

    $query = "INSERT INTO `audi_table` VALUES (NULL,'" . $user_id . "', '$description');";

    if ($connection->query($query) == true) {
        echo "<script>console.log('audit trial update')</script>";
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }

}

function get_election_id()
{
    $connection = get_connection();
    $query = "SELECT `election_id` FROM `elections` ORDER BY `election_id` DESC LIMIT 1;";
    $result = mysqli_query($connection, $query);

    if ($connection->query($query) == true) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        return $row['election_id'];
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
    return;
}

function get_rank($index)
{
    $connection = get_connection();

    $query = "SELECT `party_name` FROM `governing_parties` WHERE `governing_party_id`='$index'";
    $result = mysqli_query($connection, $query);
    if ($connection->query($query) == true) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //echo 'party name retrieved';echo $row['party_name'];
        return $row['party_name'];
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
    return;
}

function get_election_opening_date()
{

    $connection = get_connection();
    $query = "SELECT `opening_date` FROM `elections` ORDER BY `election_id` DESC LIMIT 1;";

    if ($connection->query($query) == true) {
        $row = mysqli_fetch_array(mysqli_query($connection, $query), MYSQLI_ASSOC);
        //echo 'party name retrieved';echo $row['party_name'];
        return $row['opening_date'];
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }
    return;
}

function get_election_closing_date()
{

    $connection = get_connection();
    $query = "SELECT `closing_date` FROM `elections` ORDER BY `election_id` DESC LIMIT 1;";

    if ($connection->query($query) == true) {

        $result = mysqli_query($connection, $query);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        //echo 'party name retrieved';echo $row['party_name'];
        return $row['closing_date'];
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }

    return;
}

function timer()
{
    $today = strtotime(date("Y-m-d G:i:s"));

    if ($today > strtotime(get_election_closing_date())) {
        ?>
        <script>
            console.log('in timer script');
                $("#timer").html("An election date has not yet been confirmed. The previous elections closed on" +
                    " <?php echo get_election_closing_date();?>");
        </script>
        <?php
    } else if ($today > strtotime(get_election_opening_date())) {
        ?>
        <script>
            console.log('in timer script2');
            let countDownDate = <?php echo strtotime(get_election_closing_date()) ?> *
            1000;
            let now = <?php echo time() ?> *
            1000;

            let x = setInterval(function () {
                now = now + 1000;
                let distance = countDownDate - now;
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);

                let str_days =  (days > 1) ? 'days' : 'day';
                let str_hours =  (hours > 1) ? 'hours' : 'hour';
                let str_minutes =  (minutes > 1) ? 'minutes' : 'minute';
                let str_seconds =  (seconds > 1) ? 'seconds' : 'second';

                $("#timer").html("ELECTIONS ARE NOW OPEN!! " + days + " " + str_days + " "
                    + hours + " " + str_hours + " " + minutes + " " + str_minutes + " " + seconds +
                    " " + str_seconds + " until elections are over!") ;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "Something is wrong";
                }
            }, 1000);

        </script>
        <?php
    } else if ($today < get_election_opening_date()) {
        ?>
        <script>
            console.log('in timer script3');
            let countDownDate = <?php echo strtotime(get_election_opening_date()) ?> *
            1000;
            let now = <?php echo time() ?> *
            1000;

            let x = setInterval(function () {
                now = now + 1000;
                let distance = countDownDate - now;
                let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                $("#timer").html(days + " days " + hours + " hours " +
                    minutes + " minutes " + seconds + " seconds Until elections are open!") ;
                if (distance < 0) {
                    clearInterval(x);
                    document.getElementById("timer").innerHTML = "Something is wrong";
                }
            }, 1000);
        </script>
        <?php
    } else if ($today <= get_election_opening_date()) {
            ?>
            <script>
                console.log('in timer script4');
                let countDownDate = <?php echo strtotime(get_election_opening_date()) ?> *
                1000;
                let now = <?php echo time() ?> *
                1000;

                let x = setInterval(function () {
                    now = now + 1000;
                    let distance = countDownDate - now;
                    let days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    let hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    let minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    let seconds = Math.floor((distance % (1000 * 60)) / 1000);
                    $("#timer").html(days + " days " + hours + " hours " +
                        minutes + " minutes " + seconds + " seconds Until elections are open!") ;

                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("timer").innerHTML = "Something is wrong";
                    }
                }, 1000);
            </script>
            <?php
        } else echo "something is wrong..";
}

function approve_user_main_content(){
    ?>
     <script>$( ".user-verification-form" ).on( "submit", function(e) {
             console.log("verification form submitted.")
             //e.preventDefault();
             let data_string = $(this).serialize();
             // console.log($(this).serialize()); return false;
             $.ajax({
                 type: "POST",
                 url: "https://dev.ezdev.solutions/handlers/approve_user.php",
                 data: data_string })
                 .done(function(data){
                     alert(data);
                     console.log(data);
                     $('.approve-user-main-content').html(data);
                 })
                 .fail(function() {
                     alert( "Posting failed." );
                 });
             return false;
         });

     </script>
     <div class="approve-user-main-content">
     <div class="approve-user-container-left">
            <div  class="user-verification-form-container">

                <center>

                <p class="form-label">
                    Select a user in the dropdown to the left and compare the users ID. Approve if valid.
                </p>

                <form action="handlers/approve_user.php" method="post" name="user-verification-form" class="user-verification-form">
                    <div class="row">

                        <div class="container">

                            <label for="user-list" class="form-label">User:
                                <select name="user-list" class="user-list" required>

                                    <?php
                                    echo '<option value="0">Select a user</option>';
                                    $connection = get_connection();

                                    $query = "SELECT `user_first_name`, `user_last_name`, `user_identity`, 
                                                `id_upload_location` FROM `users` WHERE `user_type`='un-activated';";
                                    $results = mysqli_query($connection, $query);

                                    if ($connection->query($query) == true) {
                                        while($row = mysqli_fetch_array($results))
                                        {
                                            echo "<option value='" . $row['user_identity'] . "' id='" . $row['user_identity'] . "'>" . $row['user_first_name'] . " " . $row['user_last_name'] .
                                                " " . $row['user_identity'] . "</option>";

                                        }
                                    } else {
                                        echo "Error: " . $query . "<br>" . $connection->error;
                                    }
                                    ?>
                                </select>
                            </label>


                            <!--create dropdown to select an iD and then retrieve the photo using ajax
                            also check if user table has status field if not user user type field and adjust register if need be
                            -->


                        </div>
                    </div>
                    <div class="row">
                        <div class="un-activated-user-table-container">
                            <?php
                            $connection = get_connection();
                            echo "<br><br><center><table border='1'>
                                    <tr>
                                        <th>User ID Number</th>
                                        <th>User First Name</th>
                                        <th>User Second Name</th>
                                    </tr>";


                            $query = "SELECT `user_first_name`, `user_last_name`, `user_identity`, 
                                        `id_upload_location` FROM `users` WHERE `user_type`='un-activated';";
                            $results = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_array($results))
                            {
                                echo "<tr>";
                                echo "<td>" . $row['user_identity'] . "</td>";
                                echo "<td>" . $row['user_first_name'] . "</td>";
                                echo "<td>" . $row['user_last_name'] . "</td>";
                                echo "</tr>";
                            }

                            echo "</table></center>";
                            ?>
                        </div>
                    </div>

                    <div class="row">
                        <input id="approve-user-btn" name="btn-approve" type="submit" value="Approve">
                    </div>
                </form>
            </center>
            </div>

        </div>


        <div class="approve-user-container-right">
            <div class="approve-user-id-container">
                <div class="user-id-image-container">

                </div>
            </div>
        </div>

    </div> <?php
}

function get_full_url(): string
{
    $protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";

    return $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
}

function load_nav()
{
    if (sizeof($_SESSION) > 0) {

        if (isset($_SESSION['user_type'])){
            if ($_SESSION['user_type'] == 'admin') {
                if (get_full_url() == SITE_ROOT . "election_admin.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'user_verification.php">Verify Users</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'party_admin.php">Party Admin</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'audit.php">Audit Trial</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                } elseif (get_full_url() == SITE_ROOT . "user_verification.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'election_admin.php">Set Up Election</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'party_admin.php">Party Admin</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'audit.php">Audit Trial</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                } elseif (get_full_url() == SITE_ROOT . "party_admin.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'election_admin.php">Set Up Election</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'user_verification.php">Verify Users</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'audit.php">Audit Trial</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                } elseif (get_full_url() == SITE_ROOT . "stats.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'user_verification.php">Verify Users</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'election_admin.php">Setup Election</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'party_admin.php">Party Admin</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'audit.php">Audit Trial</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                } elseif (get_full_url() == SITE_ROOT . "audit.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'user_verification.php">Set Up Election</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'party_admin.php">Party Admin</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'election_admin.php">Setup Election</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                } else {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'user_verification.php">Verify Users</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'party_admin.php">Party Admin</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'election_admin.php">Setup Election</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'audit.php">Audit Trial</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                }



            }
            elseif ($_SESSION['user_type'] == 'approved') {

                if (get_full_url() == SITE_ROOT . "index.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'users_page.php">My Profile</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'vote.php">Vote</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">Logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                } elseif (get_full_url() == SITE_ROOT . "users_page.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'vote.php">Vote</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">Logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                } elseif (get_full_url() == SITE_ROOT . "vote.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'users_page.php">My Profile</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">Logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                }  elseif (get_full_url() == SITE_ROOT . "stats.php") {
                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'users_page.php">My Profile</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'vote.php">Vote</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">Logout</a>
                     </div>
                </div>
            <div class="wrapper">';
                }else {

                    echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                        <a class="menu-font" href="' . SITE_ROOT . 'login.php">Login</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'vote.php">Vote</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
                        <a class="menu-font" href="' . SITE_ROOT . 'logout.php">Logout</a>
                    </div>
                </div>   
        <div class="wrapper">';
                }
                /*
                 * User is not currently logged in so display the standard navigation bar with register and login button.
                 * */
            }
        } else {
            echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                <a class="menu-font" href="' . SITE_ROOT . 'login.php">Login</a>
                <a class="menu-font" href="' . SITE_ROOT . 'register.php">Vote</a>
                <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
            </div>
        </div>
    <div class="wrapper">';
        }
    }else {
        echo '<div class="nav"><!--navigation bar, used to navigate the site-->
                <a class="menu-font" href="' . SITE_ROOT . 'login.php">Login</a>
                <a class="menu-font" href="' . SITE_ROOT . 'register.php">Vote</a>
                <a class="menu-font" href="' . SITE_ROOT . 'stats.php">View Current Stats</a>
            </div>
        </div>
    <div class="wrapper">';
    }
}

function load_login_unverified(){
//        echo '<script>
//                alert("You have either not registered yet or your profile is still under review");
//            </script>';

    load_login();

}

function load_login(){
    ?>
    <center>
        <div id="timer">
            <h2>
                <?php timer(); ?>
            </h2>
        </div>
    </center>
    <div class="login-form-container">
        <form class="login-form" action="handlers/login_handler.php" method="post">

            <div class="row">
                <div class="column-30">
                    <label class="form-label" for="username">Email:</label>
                </div>
                <div class="column-70">
                    <input class="form-field" id="username" name="username" type="email" >
                </div>
            </div>

            <div class="row">
                <div class="column-30">
                    <label class="form-label" for="user-password">Password:</label>
                </div>
                <div class="column-70">
                    <input class="form-field" id="user-password" name="user-password" type="password" >
                </div>
            </div>

            <div class="row">
                <div class="column-50">
                    <div class="login-login-button-container">
                        <input class="login-button" id="login-button" name="login-button" type="submit" value="Login" >
                    </div>
                </div>
                <div class="column-50-right">
                    <div class="login-change-password-button-container">
                        <a href="change_password.php">
                            Change Password
                        </a>
                    </div>
                </div>
            </div>
            <center>
                <br>
                <br>
                <br>
                <div class="login-timer">
                    <h2 class="login-register-button-text">
                        Do you need a profile? Register here:
                    </h2>
                </div>
                <div class="login-register-button-container">
                    <a href="register.php">
                        Register
                    </a>
                </div>
            </center>
        </form>
    </div>

    <?php
//    $connection->close();

    require "footer.php";
}

function load_party_admin(){

        ?>
        <br>
        <br>
        <br>

        <form name="party-admin-form" class="party-admin-form" action="handlers/governing_party_handler.php" method="post">

            <div class="row">
                <div class="column-30">
                    <label class="form-label" for="party-name">Party Name:</label>
                </div>
                <div class="column-70">
                    <input required class="form-field" id="party-name" name="party-name" type="text" >
                </div>
            </div>

            <div class="row">
                <div class="column-30">
                    <label class="form-label" for="party-type">Party Type:</label>
                </div>
                <div class="column-70">
                    <select required class="form-field" id="party-type" name="party-type" >
                        <option>
                            Provincial
                        </option>
                        <option>
                            National
                        </option>
                        <option>
                            Local
                        </option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="column-30">
                    <label class="form-label" for="party-status">Party Status:</label>
                </div>
                <div class="column-70">
                    <select required class="form-field" id="party-status" name="party-status">
                        <option>Active</option>
                        <option>Not-Active</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <input id="governing-party-admin-button" name="governing-party-admin-button" type="submit" value="Submit">
            </div>

            <br>
            <br>

            <div class="row">
                <div class="column-30">
                    <label class="form-label" for="party-status">Select Party:</label>
                </div>
                <div class="column-70">
                    <?php
                    echo '<select class="form-field" name="party-list" id="party-list">';

                    $connection = get_connection();

                    $query = "SELECT * FROM `governing_parties`;";
                    $results = mysqli_query($connection, $query);

                    while($row = mysqli_fetch_array($results))
                    {
                        echo "<option id='". $row['party_name'] ."'>" . $row['party_name'] . "</option>";
                    }
                    echo "</select >"
                    ?>
                </div>
            </div>

            <?php
            echo "<br><br><center><table border='1'>
                        <tr>
                            <th>Party ID</th>
                            <th>Party Name</th>
                            <th>Party Type</th>
                            <th>Party Status</th>
                        </tr>";


            $query = "SELECT * FROM `governing_parties`;";
            $results = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($results))
            {
                echo "<tr>";
                echo "<td>" . $row['governing_party_id'] . "</td>";
                echo "<td>" . $row['party_name'] . "</td>";
                echo "<td>" . $row['party_type'] . "</td>";
                echo "<td>" . $row['party_status'] . "</td>";
                echo "</tr>";
            }

            echo "</table></center>"
            ?>
        </form>
        <?php
}

function do_vote()
{

    $connection = get_connection();

    $party = $_POST['parties'];

    $query = "SELECT `governing_party_id` FROM `governing_parties` WHERE `party_name`='$party'";

    $result = mysqli_query($connection, $query);

    $row = mysqli_fetch_array($result);

    $party_id = $row['governing_party_id'];

    $election_id = get_election_id();

    $query = "INSERT INTO `votes` VALUES (NULL, '$party_id', '$election_id');";

    if ($connection->query($query) == true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }


    $query = "UPDATE `users` SET `last_vote`='" . date("Y-m-d G:i:s") . "' WHERE `user_id`='" . $_SESSION['user_id'] . "';";

    if ($connection->query($query) == true) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $query . "<br>" . $connection->error;
    }

//        $connection ->close();
//        header("Location: ../stats.php");

}
