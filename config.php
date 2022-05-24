<?php

if(!defined('APPROVED')) {
    die('Direct access not permitted' . $_SERVER['SCRIPT_NAME']);
}

$connection = new mysqli("localhost","u313581005_Anthony","RGITproject700",
    "u313581005_evote") or die($connection->error);


if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

if (mysqli_connect_errno()) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

const SITE_ROOT = "https://dev.ezdev.solutions/";
