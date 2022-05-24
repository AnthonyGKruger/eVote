<?php

include "header.php";

?>
    <br>
    <br>
    <br>
    <div id="timer">
        <center>
            <h2>
                <?php echo timer();?>
            </h2>
        </center>

    </div>
    <br>
    <br>
    <br>
    <div>
        <center>
            <h2 class="login-register-button-text">
                Do you need to change your password? Send yourself a link below:
            </h2>
        </center>
    </div>
    <br>
    <br>
    <div class="send-link-form-container">
        <form class="send-link-form" action="handlers/change_password_handler.php" method="post">
            <div class="row">
                <div class="column-30">
                    <label class="form-label" for="email">Email:</label>
                </div>
                <div class="column-70">
                    <input class="form-field" id="email" name="email" type="email" >
                </div>
            </div>

            <center>
                <br>
                <br>
                <br>
                <div class="change-password-send-link-button-container">
                    <input type="submit" name="send-link" id="send-link" value="Send">
                </div>
            </center>
        </form>
    </div>

<?php
require "footer.php";