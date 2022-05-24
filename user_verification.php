<?php

include 'header.php';
if (sizeof($_SESSION) > 0){
    if ($_SESSION['user_type'] == 'admin')
        ?>
        <div class="approve-user-call-to-action">
            <h2>
                Please select a user below and review their ID document and approve if valid:
            </h2>
        </div>
        <?php
        approve_user_main_content();
        require 'footer.php';
    } else {
        header("Location: index.php");
    }


