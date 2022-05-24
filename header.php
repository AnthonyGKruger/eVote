<?php

define('APPROVED', TRUE);

session_start();

include "config.php";
include "functions.php";

date_default_timezone_set("Africa/Johannesburg");

?>
    <!DOCTYPE html>
    <html lang="">
 
        <meta charset="utf-8">
    <head>
        <title>eVote Online elections platform </title>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <!--script for loading jquery onto page-->
        <link rel="stylesheet" href="<?php echo SITE_ROOT;?>assets/css/style.css">
        <link href='https://fonts.googleapis.com/css?family=DM Sans' rel='stylesheet'>
        <script src="handlers/js/script.js"></script>
        <?php  $connection = get_connection();

$url = get_full_url();

if ($url == SITE_ROOT."stats.php"){


    $election_id = get_election_id();

    $query = "SELECT `governing_party_id` FROM `votes` WHERE election_id='$election_id';";
    $result_vote = mysqli_query($connection, $query);

    $num_rows_vote = mysqli_num_rows($result_vote);

    //$query = "SELECT `governing_party_id` FROM `governing_parties`;";
    //$result_vote = mysqli_query($connection, $query);

    $num_rows_parties = mysqli_num_rows($result_vote);

    $votes = [];

    while($row = mysqli_fetch_array($result_vote)){
        array_push($votes, $row['governing_party_id']);
    }

    $vote_frequency = array_count_values($votes);

    arsort($vote_frequency);

    $sorted_votes = array_keys($vote_frequency);

//    print_r($votes);
//    echo "<br>";
//    print_r($vote_frequency);
//    echo "<br>";
//    print_r($vote_frequency);
//    echo "<br>";
//    print_r($sorted_votes);

    $first_place = get_rank($sorted_votes[0]);
    $second_place = get_rank($sorted_votes[1]);
    $third_place = get_rank($sorted_votes[2]);

    $first_place_vote_count = $vote_frequency[$sorted_votes[0]];
    $second_place_vote_count = $vote_frequency[$sorted_votes[1]];
    $third_place_vote_count = $vote_frequency[$sorted_votes[2]];


    echo '<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
                            <script type="text/javascript">';
    echo "google.charts.load('current',{packages:['corechart']});";
    echo "google.charts.setOnLoadCallback(drawChart);
                                function drawChart() { 
                                var data = google.visualization.arrayToDataTable(
                                [['Governing Party','Votes'],";

    for ($i = 0; $i < count($sorted_votes); $i++){
        echo "['" . get_rank($sorted_votes[$i]) . "'," . $vote_frequency[$sorted_votes[$i]] . "]";
        if (!($i == (count($sorted_votes) - 1))){
            echo "," ;
        }
    }
    echo "]);
                                    var options = {
                                        title: 'Elections vote tally'
                                    };
                                    var chart = new google.visualization.PieChart(document.getElementById('piechart'));
                                    chart.draw(data, options);
                                }
                            </script>"; }?>
    </head>
    <body>


    <div class="navbar">
        <div class="flag">
            <img src="<?php echo SITE_ROOT;?>assets/images/flag.png">
        </div>
        <div class="logo">
            <a class="menu-font" href="<?php echo SITE_ROOT?>index.php">eVote</a>
        </div>

<?php

load_nav();












