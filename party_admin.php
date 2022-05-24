<?php

require 'header.php';
if (sizeof($_SESSION) > 0){
    if ($_SESSION['user_type'] == 'admin'){

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

        <div class="governing-party-admin-main-content">
            <div class="governing-party-admin-call-to-action">
                <center>
                    <h1 class="second-heading">
                        Please upload a Governing party below or select one from the table below to update their information.
                    </h1>
                </center>
            </div>
            <div class="governing-party-admin-container-left">

            <?php load_party_admin();?>

            </div>

            <div class="governing-party-admin-container-right">
                <img src="assets/images/South-Africa.jpg">
            </div>

        </div>

        <?php
        require 'footer.php';

    }
} else {
    header('Location: index.php');
}
