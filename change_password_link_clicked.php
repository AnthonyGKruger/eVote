<?php

include "header.php";

if($_GET['key'] && $_GET['reset'])
{
    $email=$_GET['key'];
    $pass=$_GET['reset'];
    $_POST=$_GET['key'];
    $_POST=$_GET['reset'];
    $connection = get_connection();

    $query = "SELECT `user_email`, `user_password` FROM `users` WHERE MD5(`user_email`)='$email' AND   `user_password`='$pass';";

    $results = mysqli_query($connection, $query);

    if(mysqli_num_rows($results)==1)
    {
        ?>

        <br>
        <br>
        <br>
        <div class="change-password-timer">
            <h2>
                Time LEFT
            </h2>
        </div>
        <br>
        <br>
        <br>
        <div>
            <center>
                <h2 class="login-register-button-text">
                    Please enter a new password for yourself below, and click confirm when done.
                </h2>
            </center>
        </div>
        <br>
        <br>
        <div class="link-clicked-form-container">
            <form class="link-clicked-form" action="handlers/change_password_link_clicked_handler.php" method="post">
                <input type="hidden" name="email" value="<?php echo $email;?>">

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="new-password">New Password:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="new-password" name="new-password" type="password" >
                    </div>
                </div>
                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="confirm-new-password">Confirm Password:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="confirm-new-password" name="confirm-new-password" type="password" >
                    </div>
                </div>

                <center>
                    <br>
                    <br>
                    <br>
                    <div class="confirm-password-button-container">
                        <input type="hidden" name="key" id="key" value="<?php echo $_GET['key']?>">
                        <input type="hidden" name="reset" id="reset" value="<?php echo $_GET['reset']?>">
                        <input type="submit" name="confirm-password-button" id="confirm-password-button" value="Confirm">
                    </div>
                </center>
            </form>
        </div>

        <?php
    }
}

require "footer.php";
