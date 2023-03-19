<?php
$serverName = "localhost:3306";
$userName = "rozettex_root";
$password = "cDt,-DwF)vNV";
$dbName = "rozettex_main";

$connection = mysqli_connect($serverName, $userName, $password, $dbName);

if (!$connection)
    echo "Connection Failed!" . mysqli_connect_error();
