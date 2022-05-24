<?php

require 'header.php';
if (sizeof($_SESSION) > 0){
    if ($_SESSION['user_type'] == 'approved' || isset($_SESSION['just-registered'])){
        header('Location: index.php');
    }
}else {

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

    <div class="register-main-content">
        <div class="register-container-left">
            <form name="register-form" class="register-form" enctype="multipart/form-data" action="handlers/register_handler.php" method="post">
                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="first-name">First Name:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="first-name" name="first-name" type="text" required  >
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="last-name">Last Name:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="last-name" name="last-name" type="text" required  >
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="email">Email:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="email" name="email" type="text" required  >
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="password">Password:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="password" name="password" type="text" required  >
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="contact-number">Contact Number:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="contact-number" name="contact-number" type="text" required  >
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="address">Address:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="address" name="address" type="text" required  >
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="id-number">ID Number:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="id-number" name="id-number" type="text" required >
                    </div>

                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="upload-id">Upload ID:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="upload-id" name="upload-id" type="file" required  >
                    </div>
                </div>

                <div class="row">
                    <input id="register-button" name="register-button" type="submit" value="Register">
                </div>

            </form>
        </div>


        <div class="register-container-right">
            <div class="register-text-container">
                <div class="main-heading">
                    <h1 class="main-heading">
                        Congratulations!
                    </h1>
                </div>
                <div class="second-heading">
                    <h2 class="second-heading">
                        You have taken the first step toward making your voice heard!
                    </h2>
                </div>
                <div class="third-heading">
                    <h3 class="third-heading">
                        Take a moment to fill in your details and once uploaded then an official will verify your information.
                    </h3>
                </div>
            </div>
        </div>

    </div>

    <?php

    require 'footer.php';
}


