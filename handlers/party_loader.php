<?php

session_start();
include "../functions.php";

if (isset($_POST['party_name'])){

    $connection = get_connection();

    $query = "SELECT * FROM `governing_parties` WHERE `party_name`='" . $_POST['party_name'] . "';";

    $results = mysqli_query($connection,$query);

    $row = mysqli_fetch_array($results);

    if (mysqli_num_rows($results) > 0){
?>
<br>
<br>
<br>

<form action="handlers/governing_party_handler.php" method="post">

    <div class="row">
        <div class="column-30">
            <label class="form-label" for="party-name">Party Name:</label>
        </div>
        <div class="column-70">
            <input required placeholder="<?php echo $row['party_name'] ?>" class="form-field" id="party-name" name="party-name" type="text" >
        </div>
    </div>

    <div class="row">
        <div class="column-30">
            <label class="form-label" for="party-type">Party Type:</label>
        </div>
        <div class="column-70">
            <select required class="form-field" id="party-type" name="party-type" >

                <?php

                    switch ($row['party_type']){
                        case 'Provincial':
                            echo '<option selected>
                                    Provincial
                                 </option>
                                 <option>
                                    National
                                 </option>
                                 <option>
                                    Local
                                 </option>';
                            break;
                        case 'Local':
                            echo '<option>
                                    Provincial
                                 </option>
                                 <option>
                                    National
                                 </option>
                                 <option selected>
                                    Local
                                 </option>';
                            break;
                        case 'National':
                            echo '<option>
                                    Provincial
                                 </option>
                                 <option selected>
                                    National
                                 </option>
                                 <option>
                                    Local
                                 </option>';
                            break;
                        default:
                            echo '<option >
                                    Provincial
                                 </option>
                                 <option>
                                    National
                                 </option>
                                 <option>
                                    Local
                                 </option>';
                            break;
                    }

                ?>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="column-30">
            <label class="form-label" for="party-status">Party Status:</label>
        </div>
        <div class="column-70">
            <select required class="form-field" id="party-status" name="party-status">
                <option>Active</option>
                <option>Not-Active</option>
            </select>
        </div>
    </div>

    <div class="row">
        <input id="governing-party-admin-button" name="governing-party-admin-button" type="submit" value="Submit">
    </div>

    <br>
    <br>

    <div class="row">
        <div class="column-30">
            <label class="form-label" for="party-status">Select Party:</label>
        </div>
        <div class="column-70">
            <?php
            echo '<select class="form-field" name="party-list" id="party-list">';


            $query = "SELECT * FROM `governing_parties`;";
            $results = mysqli_query($connection, $query);

            while($row = mysqli_fetch_array($results))
            {
                if ($row['party_name'] == $_POST['party_name']){
                    echo "<option selected id='". $row['party_name'] ."'>" . $row['party_name'] . "</option>";
                }else{
                    echo "<option id='". $row['party_name'] ."'>" . $row['party_name'] . "</option>";
                }

            }

            echo "</select >"
            ?>
        </div>
    </div>

    <?php
    echo "<br><br><center><table border='1'>
                        <tr>
                            <th>Party ID</th>
                            <th>Party Name</th>
                            <th>Party Type</th>
                            <th>Party Status</th>
                        </tr>";


    $query = "SELECT * FROM `governing_parties`;";
    $results = mysqli_query($connection, $query);

    while($row = mysqli_fetch_array($results))
    {
        echo "<tr>";
        echo "<td>" . $row['governing_party_id'] . "</td>";
        echo "<td>" . $row['party_name'] . "</td>";
        echo "<td>" . $row['party_type'] . "</td>";
        echo "<td>" . $row['party_status'] . "</td>";
        echo "</tr>";
    }

    echo "</table></center>"
    ?>
</form>
    <?php
    }
}

