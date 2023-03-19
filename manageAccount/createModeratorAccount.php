<?php
session_start();
$s = $_SESSION['userName'];
if ($s == true) {
} else {
?>
    <meta http-equiv="refresh" content="0; url = http://localhost/Rozette/">
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
    <title>Create Moderator Account</title>

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
            width: 250px;
            padding-top: 100px;
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
            width: 212px;
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

        .button {
            border: 0.05em solid red;
            width: 100%;
            display: flex;
            justify-content: center;
            margin-top: 10px;
            margin-bottom: 20px;
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
            <div class="name">
                <p class="p">Name:</p>
                <input name="name" type="text" class="input" placeholder="Name" required>
            </div>

            <div class="phoneNumber">
                <p class="p">Phone Number:</p>
                <input name="phoneNumber" type="text" class="input" placeholder="Phone Number" required>
            </div>

            <div class="userName">
                <p class="p">Username:</p>
                <input name="userName" type="text" class="input" placeholder="Username" required>
            </div>

            <div class="password">
                <p class="p">Password:</p>
                <input name="password" type="text" class="input" placeholder="Password" required>
            </div>

            <die class="create">
                <button class="button">Create</button>
            </die>
        </form>
    </div>
</body>

</html>


<?php
$name = $_POST['name'];
$phoneNumber = $_POST['phoneNumber'];
$userName = $_POST['userName'];
$password = $_POST['password'];

if ($name != "" && $phoneNumber != "" && $userName != "" && $password != "") {
    $query = "INSERT INTO moderator VALUES('$name', '$phoneNumber', '$userName', '$password')";
    $result = mysqli_query($connection, $query);

?>
    <meta http-equiv="refresh" content="0; url = http://localhost/Rozette/manageAccount/manageModerator.php">
<?php
}
