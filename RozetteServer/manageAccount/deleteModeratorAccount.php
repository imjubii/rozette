<?php
session_start();
$s = $_SESSION['userName'];
if ($s == true) {
} else {
?>
    <meta http-equiv="refresh" content="0; url = https://rozette.xyz/">
<?php
}

include("../connection.php");

$userName = $_GET['userName'];

$query = "DELETE FROM moderator WHERE userName = '$userName' ";
$redult = mysqli_query($connection, $query);

if ($redult) {
?>
    <meta http-equiv="refresh" content="0; url = https://rozette.xyz/manageAccount/manageModerator.php">
<?php
}
