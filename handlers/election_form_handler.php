<?php
session_start();
include "../functions.php";

if (isset($_POST['start-date'])){
    
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $username = $_POST['username-hidden-field'];
    
    $connection = get_connection();
    
    $query = "SELECT `opening_date`,`closing_date` FROM `elections` ORDER BY `election_id` DESC LIMIT 1;";
    
    $results = mysqli_query($connection, $query);
    
    $row = mysqli_fetch_array($results);
    
    $old_start_date = null;
    $old_end_date = null;
    
    if ($row > 0){
        
         $old_end_date = $row['closing_date'];
         $old_start_date = $row['opening_date'];
        
         $start_date = strtotime($start_date);
         $end_date = strtotime($end_date);
         $old_start_date = strtotime($old_start_date);
         $old_end_date = strtotime($old_end_date);
        
         if (($start_date > $old_end_date) || ($end_date < $start_date)){
             $query = "INSERT INTO `elections` VALUES (null,'" . $_SESSION['user_id'] . "', '". $_POST['start-date'] ."'
                ,'" . $_POST['end-date'] . "', '" . $_POST['election-type'] . "');";
             $results = mysqli_query($connection, $query);
             if($connection ->query($query)==TRUE){
                 echo "Successful upload of new election completed.";
                 update_audit_trial($_SESSION['user_id'], "CREATED ELECTION, start date: ". 
                     $_POST['start-date'] . ", end date: ". $_POST['end-date'] ."");
             } else {
                 echo $connection ->error;
             }
         } else {
             echo "Elections have been set for that time frame, or there is something wrong with your dates that you selected, please wait for the elections to finish.";
             update_audit_trial($_SESSION['user_id'], "Attempted to create an election whilst elections are in progress.");
         }
    } else {
        echo "something went wrong";
    }
}