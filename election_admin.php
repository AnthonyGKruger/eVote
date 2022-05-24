<?php

require "header.php";
if (sizeof($_SESSION) > 0){
    if ($_SESSION['user_type'] == 'admin'){

        ?>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <div class="election-admin-form-container">
            <form name="election-form" class="election-form" action="handlers/election_form_handler.php" method="post">

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="election-type">Election type:</label>
                    </div>
                    <div class="column-70">
                        <select name="election-type" id="election-type" class="form-field" >
                            <option>
                                Local
                            </option>
                            <option>
                                National
                            </option>
                            <option>
                                Provincial
                            </option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="start-date">Start date:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="start-date" name="start-date" type="date" required>
                    </div>
                </div>

                <div class="row">
                    <div class="column-30">
                        <label class="form-label" for="password">End date:</label>
                    </div>
                    <div class="column-70">
                        <input class="form-field" id="end-date" name="end-date" type="date" required >
                    </div>
                </div>

                <input type="hidden" value="<?php echo $_SESSION['user-name']?>" name="username-hidden-field"
                       id="username-hidden-field">

                <div class="row">
                    <div>
                        <div class="election-admin-button-container">
                            <input class="election-admin-button" id="election-admin-button" name="election-admin-button" type="submit" value="Approve" >
                        </div>
                    </div>
                </div>
                <div id="message" class="form-label" style="padding: 20px;">

                </div>

            </form>
        </div>

        <?php
        $connection->close();

        require "footer.php";
    }

} else {
    header('Location: index.php');
}



