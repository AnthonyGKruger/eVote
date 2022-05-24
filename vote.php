<?php

include "header.php";
if (sizeof($_SESSION) > 0){
    if ($_SESSION['user_type'] == 'approved'){
        ?>
        <div class="vote-call-to-action">
            <h2>
                Congratulations!
            </h2>
            <p>
                You are about to make your voice heard! Please take a moment to select a party for the current election:
            </p>
        </div>

        <br>
        <br>
        <br>

        <div class="vote-main-content">
            <div class="vote-container-left">
                <form action="handlers/vote_handler.php"  method="post">

                    <div class="row">
                        <div class="column-30">
                            <span class="form-label">Party Choices:</span>
                        </div>
                        <div class="column-70">
                            <?php

                            $query = "SELECT `party_name` FROM `governing_parties` WHERE `party_status`='Active';";
                            $results = mysqli_query($connection, $query);

                            while($row = mysqli_fetch_array($results))
                            {
                                echo "<div class='vote-field'><label for='" . $row['party_name'] . "'><input 
                                    id='" . $row['party_name'] . "' name='parties' type='radio' value='".
                                    $row['party_name'] ."'> " . $row['party_name'] . "</label></div><br><br><br>";

//                                echo "<input class='form-field' id='" . $row['party_name'] . "' name='parties'
//                                    type='radio' value='". $row['party_name'] ."'>" . $row['party_name'];
                            }
                            echo "<input type='hidden' name='election-id' value='" . get_election_id() . "'>";

                            ?>
                        </div>
                    </div>


                    <div class="row">
                        <input id="vote-button" name="vote-button" type="submit" value="Approve">
                    </div>

                </form>
            </div>

            <div class="vote-container-right">
                <div class="vote-img-container">
                    <img src="assets/images/South-Africa.jpg">
                </div>
            </div>
        </div>
        <br>
        <br>
        <br>
        <br>
        <br>
        <?php

        require 'footer.php';
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}