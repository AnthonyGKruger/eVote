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
        <div class="audit-container">
            <div class="audit-call-to-action">
                <h2>
                    Audit trail as of
                    <?php
                    date_default_timezone_set("Africa/Johannesburg");
                    echo date("d/m/Y") . " " . date("h:i:sa");?>
                </h2>
            </div>
            <div class="audit-table-container">


                <?php
                echo "<center><table border='1'>
                        <tr>
                            <th>Audit ID</th>
                            <th>User ID</th>
                            <th>Description</th>
                        </tr>";


                $query = "SELECT * FROM `audi_table`;";
                $results = mysqli_query($connection, $query);

                while($row = mysqli_fetch_array($results))
                {
                    echo "<tr>";
                    echo "<td>" . $row['audit_id'] . "</td>";
                    echo "<td>" . $row['user_id'] . "</td>";
                    echo "<td>" . $row['description'] . "</td>";
                    echo "</tr>";
                }

                echo "</table></center>"
                ?>
            </div>
        </div>
<?php
        require "footer.php";
    }

}else {
    echo 4 ."<br>";
    header('Location: index.php');
}