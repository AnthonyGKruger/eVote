<?php

require 'header.php';
if (sizeof($_SESSION) > 0){
    if (($_SESSION['user_type'] == 'approved') || ($_SESSION['user_type'] == 'admin' || $_SESSION['just-registered'] = 'true')){


        $query = "SELECT * FROM `users` WHERE `user_email`='" .$_SESSION['username']. "';";
        $results = mysqli_query($connection, $query);
        $rows = mysqli_num_rows($results);

        if ($rows >= 1){

            $row = mysqli_fetch_array($results, MYSQLI_ASSOC);

            $user_email = $_SESSION['username'];
            $user_contact = $row['user_contact_number'];
            $user_address = $row['user_address'];
            $user_first_name = $row['user_first_name'];
            $connection->close();
        }
        ?>
        <div class="register-timer">
            <center>
                <h2 id="timer">
                    <?php
                    echo timer();
                    ?>
                </h2>
            </center>
        </div>
        <!--    <br>-->
        <!--    <br>-->
        <!--    <br>-->
        <div class="user-page-main-content">
            <div class="user-page-container-left">

                <div class="user-page-call-to-action">
                    <h1 class="second-heading">
                        Welcome to the eVote platform <?php echo $user_first_name ?>. These are the contact details we have for you, please feel free to change any relevant information.
                    </h1>
                </div>

                <br>
                <br>
                <br>

                <form action="handlers/user_page_handler.php" method="post">

                    <div class="row">
                        <div class="column-30">
                            <label class="form-label" for="email">Email:</label>
                        </div>
                        <div class="column-70">
                            <input class="form-field" id="email" name="email" type="text" placeholder="<?php echo $user_email;?>" >
                        </div>
                    </div>

                    <div class="row">
                        <div class="column-30">
                            <label class="form-label" for="contact-number">Contact Number:</label>
                        </div>
                        <div class="column-70">
                            <input class="form-field" id="contact-number" name="contact-number" type="text" placeholder="<?php echo $user_contact;?>">
                        </div>
                    </div>

                    <div class="row">
                        <div class="column-30">
                            <label class="form-label" for="address">Address:</label>
                        </div>
                        <div class="column-70">
                            <input class="form-field" id="address" name="address" type="text" placeholder="<?php echo $user_address;?>" >
                        </div>
                    </div>

                    <div class="row">
                        <input id="change-details-button" name="change-details-button" type="submit" value="Submit">
                    </div>

                </form>
            </div>

            <div class="user-page-container-right">
                <img src="assets/images/South-Africa.jpg">
            </div>


        </div>

        <?php

        require 'footer.php';
    } else {
        header('Location: index.php');
    }

}


