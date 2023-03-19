<?php
session_start();
$s = $_SESSION['userName'];
if ($s == true) {
} else {
?>
    <meta http-equiv="refresh" content="0; url = http://localhost/Rozette/">
<?php
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="../image/favicon.png">
    <title>Manage Account</title>

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

        p {
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
            width: 300px;
            padding-top: 100px;
            align-items: center;
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
    <p>Admin</p>

    <div class="div">
        <form action="./editProfile.php" method="post" class="form">
            <button class="button">Edit Profile</button>
        </form>

        <form action="./manageModerator.php" method="post" class="form">
            <button class="button">Manage Moderator</button>
        </form>
    </div>

</body>

</html>