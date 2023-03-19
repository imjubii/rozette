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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/favicon.png">
    <title>Edit Profile</title>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
        }

        body {
            margin: auto;
            width: auto;
            background: linear-gradient(90deg, #e6d1fe, #cfa2ff);
        }

        .logo {
            padding-top: 10px;
            width: 70px;
            height: 70px;
            position: absolute;
            left: 0;
        }

        .adminP {
            padding-left: 40px;
            padding-bottom: 13px;
            font-size: 20px;
            position: absolute;
            bottom: 0;
        }

        .profileicon {
            padding-left: 10px;
            padding-bottom: 10px;
            width: 30px;
            height: 30px;
            position: absolute;
            bottom: 0;
        }

        .div {
            margin: auto;
            width: 373px;
            padding-top: 100px;
            align-items: center;
        }

        .userNameDiv {
            display: flex;
            align-items: center;
        }

        .passwordDiv {
            display: flex;
            align-items: center;
        }

        .p {
            margin: 10px 0 0 10px;
            font-family: system-ui, sans-serif;
            font-size: 18px;
            cursor: pointer;
        }

        .input {
            padding: 8px;
            height: 30;
            width: 150px;
            margin: 5px 10px 10px 10px;
            border: none;
            border-bottom: 1px solid #cfa3ff;
            border-radius: 10px;
            font-size: 15px;
            outline: none;
            transition: all 250ms ease-in;
        }

        .input:focus {
            border-bottom: 1px solid #480a8a;
        }

        .form {
            padding: 10px;
        }

        .button {
            padding: 10px;
            border: 0.05em solid red;
            width: 100%;
            display: flex;
            justify-content: center;

            padding: 16px 42px;
            box-shadow: 0px 0px 12px -2px rgba(0, 0, 0, 0.5);
            line-height: 1.25;
            background: #dabafd;
            text-decoration: none;
            color: black;
            font-size: 16px;
            border-radius: 12px;
            border-style: solid;
            border-color: #d0a4ff;
            text-transform: uppercase;
        }

        .button:hover {
            background: #d0a4ff;
        }
    </style>
</head>

<body>
    <img class="profileicon" src="../image/profileicon.png" alt="">
    <img src="../image/favicon.png" alt="" class="logo">
    <p class="adminP">Admin</p>

    <div class="div">
        <form action="" method="post" class="form">
            <div class="userNameDiv">
                <div class="oldUserNameDiv">
                    <p class="p">Current Username:</p>
                    <input name="oldUserName" type="text" class="input" placeholder="Username" required>
                </div>
                <div class="newUserNameDiv">
                    <p class="p">New Username:</p>
                    <input name="newUserName" type="text" class="input" placeholder="Username" required>
                </div>
            </div>

            <div class="passwordDiv">
                <div class="oldPasswordDiv">
                    <p class="p">Current Password:</p>
                    <input name="oldPassword" type="password" class="input" placeholder="Password" required>
                </div>
                <div class="newPasswordDiv">
                    <p class="p">New Password:</p>
                    <input name="newPassword" type="password" class="input" placeholder="Password" required>
                </div>
            </div>

            <die class="save">
                <button class="button">Save</button>
            </die>
        </form>
    </div>
</body>

</html>


<?php

$oldUserName = $_POST['oldUserName'];
$oldPassword = $_POST['oldPassword'];

$newUserName = $_POST['newUserName'];
$newPassword = $_POST['newPassword'];

if ($oldUserName != "" && $oldPassword != "" && $newUserName != "" && $newPassword != "") {
    $query = "SELECT * FROM admin";
    $result = mysqli_query($connection, $query);
    $data = mysqli_fetch_assoc($result);

    if ($data['userName'] == $oldUserName && $data['password'] == $oldPassword) {
        $query = "UPDATE admin SET userName = '$newUserName', password = '$newPassword' WHERE 1";
        $result = mysqli_query($connection, $query);

?>
        <meta http-equiv="refresh" content="0; url = https://rozette.xyz/manageAccount/manageAccount.php">
<?php
    } else {
        echo "<script>alert('Wrong Username or Password')</script>";
    }
}
