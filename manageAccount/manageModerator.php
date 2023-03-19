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
    <title>Manage Moderator</title>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
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

        .table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-weight: bold;
            border-radius: 5px 5px 0 0;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            margin-left: auto;
            margin-right: auto;
            text-align: center;
        }

        .table thead tr {
            background-color: #cfa2ff;
            color: #ffffff;
        }

        .table th,
        .table td {
            padding: 12px 15px;
        }

        .table tbody tr {
            background: white;
            border-bottom: 1px solid black;
        }

        .table tbody tr:last-of-type {
            border-bottom: 2px solid #cfa2ff;
        }

        .delete {
            background-color: #fc2638;
            color: white;
            border: 0;
            outline: none;
            border-radius: 5px;
            height: 25px;
            width: 60px;
            font-weight: bold;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <img class="profileicon" src="../image/profileicon.png" alt="">
    <img src="../image/favicon.png" alt="" class="logo">
    <p>Admin</p>

    <div class="div">
        <form action="./createModeratorAccount.php" method="post" class="form">
            <button class="button">Create Moderator Account</button>
        </form>
    </div>

    <?php
    include("../connection.php");

    $query = "SELECT * FROM moderator";
    $result = mysqli_query($connection, $query);

    $totalRow = mysqli_num_rows($result);

    if ($totalRow != 0) {

    ?>

        <table class="table" width="45%">
            <thead>
                <tr>
                    <th width="10%">Name</th>
                    <th width="10%">Phone Number</th>
                    <th width="10%">Username</th>
                    <th width="10%">Password</th>
                    <th width="5%">Delete</th>
                </tr>
            </thead>
        <?php

        while ($data = mysqli_fetch_assoc($result)) {
            echo "
                <tbody>
                    <tr>
                        <td>" . $data['name'] . "</td>
                        <td>" . $data['phoneNumber'] . "</td>
                        <td>" . $data['userName'] . "</td>
                        <td>" . $data['password'] . "</td>
                        <td>
                            <a href='./deleteModeratorAccount.php?userName=$data[userName]'>
                                <input type='submit' value = 'Delete' class = 'delete' onclick = 'return checkDelete()'>
                            </a>
                        </td>
                    </tr>
                </tbody>
            ";
        }
    }

        ?>

        </table>


        <script>
            function checkDelete() {
                return confirm('Are you sure you want to DELETE a Moderator?');
            }
        </script>
</body>

</html>