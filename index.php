<?php

include 'header.php';
//print_r($_SESSION);
if (isset($_SESSION['just-registered'])){
    echo '<script>
            alert("Thank you for registering, please be patient as your identity is verified.");
        </script>';
    session_destroy();
}

?>

<div class="index-main-content">
    <center>
        <h2 id="timer">
            <?php
            echo timer();
            ?>
        </h2>
    </center>
    <div class="index-container-left">
        <div class="call-to-action-text-container">
            <h1 class="call-to-action-text">
                Welcome to the eVote digital elections platform!
            </h1>
        </div>
        <div class="index-register-button-container">
            <a class="index-register-button" href="register.php">
                Register today
            </a>
        </div>
    </div>
    <div class="index-container-right">
        <div class="index-image-container">
            <img alt="South African flag" src="assets/images/South-Africa.jpg">
        </div>
    </div>

</div>

<?php
$connection->close();

require 'footer.php';
