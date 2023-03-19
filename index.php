<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./image/favicon.png">
    <title>Login</title>

    <style>
        @import url('https://fonts.googleapis.com/css?family=Raleway:400,700');

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Raleway, sans-serif;
        }

        body {
            background: linear-gradient(90deg, #e6d1fe, #cfa2ff);
        }

        img {
            width: 150px;
            height: 150px;
            padding-top: 20px;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
        }

        .screen {
            background: linear-gradient(90deg, #e6d1fe, #cfa2ff);
            position: relative;
            height: 600px;
            width: 360px;
            box-shadow: 0px 0px 24px #5C5696;
        }

        .screen__content {
            z-index: 1;
            position: relative;
            height: 100%;
        }

        .screen__background {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 0;
            -webkit-clip-path: inset(0 0 0 0);
            clip-path: inset(0 0 0 0);
        }

        .screen__background__shape {
            transform: rotate(45deg);
            position: absolute;
        }

        .screen__background__shape1 {
            height: 520px;
            width: 520px;
            background: #FFF;
            top: -50px;
            right: 120px;
            border-radius: 0 72px 0 0;
        }

        .screen__background__shape2 {
            height: 220px;
            width: 220px;
            background: #e6d1fe;
            top: -172px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape3 {
            height: 540px;
            width: 190px;
            background: linear-gradient(270deg, #cfa2ff, #bd83fc);
            top: -24px;
            right: 0;
            border-radius: 32px;
        }

        .screen__background__shape4 {
            height: 400px;
            width: 200px;
            background: #e6d1fe;
            top: 420px;
            right: 50px;
            border-radius: 60px;
        }

        .login {
            width: 320px;
            padding: 30px;
            padding-top: 40px;
        }

        .login__field {
            padding: 20px 0px;
            position: relative;
        }

        .login__input {
            border: none;
            border-bottom: 2px solid #D1D1D4;
            background: none;
            padding: 10px;
            padding-left: 24px;
            font-weight: 700;
            width: 75%;
            transition: .2s;
        }

        .login__input:active,
        .login__input:focus,
        .login__input:hover {
            outline: none;
            border-bottom-color: #cfa2ff;
        }

        .login__submit {
            background: #fff;
            font-size: 14px;
            margin-top: 30px;
            padding: 16px 20px;
            border-radius: 26px;
            border: 1px solid #D4D3E8;
            text-transform: uppercase;
            font-weight: 700;
            display: flex;
            align-items: center;
            width: 100%;
            color: #d8b5fd;
            box-shadow: 0px 2px 2px #cfa2ff;
            cursor: pointer;
            transition: .2s;
        }

        .login__submit:active,
        .login__submit:focus,
        .login__submit:hover {
            border-color: #e6d1fe;
            outline: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="screen">
            <div class="screen__content">
                <img src="./image/favicon.png" alt="">
                <form action="" method="post" class="login">
                    <div class="login__field">
                        <input name="userName" type="text" class="login__input" placeholder="User name / Email">
                    </div>
                    <div class="login__field">
                        <input name="password" type="password" class="login__input" placeholder="Password">
                    </div>
                    <button class="button login__submit" name="login">
                        <span class="button__text">Log In</span>
                    </button>
                </form>
            </div>

            <div class="screen__background">
                <span class="screen__background__shape screen__background__shape4"></span>
                <span class="screen__background__shape screen__background__shape3"></span>
                <span class="screen__background__shape screen__background__shape2"></span>
                <span class="screen__background__shape screen__background__shape1"></span>
            </div>
        </div>
    </div>
</body>

</html>


<?php
include("./connection.php");

if (isset($_POST['login'])) {
    $userName = $_POST['userName'];
    $password = $_POST['password'];

    // for admin
    $query = "SELECT * FROM admin WHERE userName='$userName' && password='$password'";
    $result = mysqli_query($connection, $query);
    $rowForAdmin = mysqli_num_rows($result);

    // for moderator
    $query = "SELECT * FROM moderator WHERE userName='$userName' && password='$password'";
    $result = mysqli_query($connection, $query);
    $rowForModerator = mysqli_num_rows($result);

    if ($rowForAdmin == 1) {
        $_SESSION['userName'] = $userName;
?>
        <meta http-equiv="refresh" content="0; url = http://localhost/Rozette/adminDashboard.php">
    <?php
    } else if ($rowForModerator == 1) {
        $_SESSION['userName'] = $userName;
    ?>
        <meta http-equiv="refresh" content="0; url = http://localhost/Rozette/moderatorDashboard.php">
<?php
    } else {
        echo "<script>alert('Wrong Username or Password')</script>";
    }
}
?>