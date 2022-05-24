<?php
include 'header.php';
?>

    <div class="stats-call-to-action">
        <div class="register-timer">
            <center>
                <h2 id="timer">
                    <?php
                    echo timer();
                    ?>
                </h2>
            </center>
        </div>
        <h2>
            Thank you for participating in the current election. These are the current stats we have related to the current selection:
        </h2>
    </div>

    <div class="stats-main-content">
        <div class="stats-container-left">

            <div class="row">
                <div id="piechart" style="width: 900px; height: 500px;"></div>
            </div>

        </div>


        <div class="stats-container-right">
            <div class="stats-current-lead-container">
                <div class="ranks">
                    <div class="rank">
                        <label class="position">First Place: <?php echo $first_place . "  (" . $first_place_vote_count . " votes)";?></label>
                    </div>
                    <br>
                    <div class="rank">
                        <label class="position">Second Place: <?php echo $second_place . "  (" . $second_place_vote_count . " votes)";?></label>
                    </div>
                    <br>
                    <div class="rank">
                        <label class="position">Third Place: <?php echo $third_place . "  (" . $third_place_vote_count . " votes)"?></label>
                    </div>
                    <br>
                    <br>
                </div>
            </div>
        </div>

    </div>

<?php

require 'footer.php';