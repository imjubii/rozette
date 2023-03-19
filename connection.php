<?php
$serverName = "localhost";
$userName = "root";
$password = "";
$dbName = "main";

$connection = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$connection)
    echo "Connection Failed!" . mysqli_connect_error();
