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
    <title>Search Product</title>

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

        .container {
            margin: auto;
            padding-top: 100px;
            display: table;
            align-items: center;
        }

        .p {
            font-family: system-ui, sans-serif;
            font-size: 18px;
        }

        .th {
            font-weight: normal;
        }

        .input {
            padding: 8px;
            width: 180px;
            margin: 5px 10px 5px 10px;
            background: #e5d1fe;
            border: none;
            border-bottom: 1px solid #cfa3ff;
            border-radius: 10px;
            font-size: 16px;
            outline: none;
            transition: all 250ms ease-in;
        }

        .input:focus {
            background: #e2cafe;
            border-bottom: 1px solid #480a8a;
        }

        .button {
            border: 0.05em solid red;
            width: 200px;
            display: flex;
            justify-content: center;
            padding: 16px 42px;
            margin: 15px;
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

        .details {
            border: 0;
            outline: none;
            border-radius: 5px;
            height: 50px;
            width: 100px;
            font-weight: bold;
            cursor: pointer;
        }

        .page {
            text-decoration: none;
            color: black;
            font-size: 20px;
            padding: 10px 10px;
            box-shadow: 0px 0px 12px -2px rgba(0, 0, 0, 0.5);
            line-height: 3;
            margin: 0 5px 0 5px;
            background: #dabafd;
            border-radius: 12px;
            border-style: solid;
            border-color: #dabafd;
        }

        .page:hover {
            background: #d0a4ff;
            border-color: #d0a4ff;
        }

        .functionButton {
            display: flex;
            justify-content: center;
        }
    </style>

</head>

<body>
    <img src="../image/favicon.png" alt="" class="logo">

    <div class="container">
        <form action="" method="POST" class="form" id="actionForm"></form>

        <center>
            <input name="searchDataInput" type="text" class="input" placeholder="Search by Product Name" form="actionForm">
            <div>
                <input name="day" type="text" class="input" placeholder="DD" form="actionForm" style="width: 22px;">
                <input name="month" type="text" class="input" placeholder="MM" form="actionForm" style="width: 27px;">
                <input name="year" type="text" class="input" placeholder="" form="actionForm" style="width: 36px;" value="2023">
            </div>
            <input name="search" type="submit" class="button" id="search" value="search" form="actionForm">
        </center>

        <?php
        $searchData = $_POST['searchData'];

        $perPage = 10;
        $start = 0;
        $currentPage = 1;

        if (isset($_GET['start'])) {
            $searchData = $_GET['searchData'];
            $start = $_GET['start'];
            $currentPage = $start;
            $start--;
            $start *= $perPage;
        }

        $query = "SELECT * FROM product WHERE productName='$searchData'";
        $resultOfName = mysqli_query($connection, $query);
        $nameRow = mysqli_num_rows($resultOfName);

        $query = "SELECT * FROM product WHERE date='$searchData'";
        $resultOfdate = mysqli_query($connection, $query);
        $dateRow = mysqli_num_rows($resultOfdate);

        if ($nameRow != 0) {
            $totalRow = $nameRow;
            $query = "SELECT * FROM product WHERE productName='$searchData' LIMIT $start, $perPage";
            $result = mysqli_query($connection, $query);
        } else if ($dateRow != 0) {
            $totalRow = $dateRow;
            $query = "SELECT * FROM product WHERE date='$searchData' LIMIT $start, $perPage";
            $result = mysqli_query($connection, $query);
        }

        $page = ceil($totalRow / $perPage);

        ?>
        <table class="table" width="">
            <thead>
                <tr>
                    <th width="70px">Date</th>
                    <th width="1px">Product Name</th>
                    <th width="1px">Quantity</th>
                    <th width="1px">Shade</th>
                </tr>
            </thead>
            <?php

            if ($totalRow != 0) {
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                    <tbody>
                        <tr>
                            <td><?php echo $data['date'] ?></td>
                            <td><?php echo $data['productName'] ?></td>
                            <td><?php echo $data['quantity'] ?></td>
                            <td><?php echo $data['shade'] ?></td>
                        </tr>
                    </tbody>
            <?php
                }
            }
            ?>
        </table>

        <center>
            <center>
                <!-- previous -->
                <?php
                if ($currentPage > 1) {
                ?>
                    <a href="?start=<?php echo $currentPage - 1 ?>&searchData=<?php echo $searchData ?>" class="page">Previous</a>
                <?php
                }
                ?>

                <a href="#" class="page" style='background: #d0a4ff; border-color: #d0a4ff;'><?php echo $currentPage ?></a>

                <!-- next -->
                <?php
                if ($currentPage < $page) {
                ?>
                    <a href="?start=<?php echo $currentPage + 1 ?>&searchData=<?php echo $searchData ?>" class="page">Next</a>
                <?php
                }
                ?>
            </center>
        </center>

        <center>
            <form action="./parcelDashboard.php" method="post" class="form">
                <button class="button">Back</button>
            </form>
        </center>
    </div>
</body>

</html>

<?php


// search
if (isset($_POST['search'])) {
    $searchData = $_POST['searchDataInput'];

    if ($searchData == "") {
        $day = $_POST['day'];
        if (strlen($day) == 1)
            $day = "0" . $day;
        $month = $_POST['month'];
        if (strlen($month) == 1)
            $month = "0" . $month;
        $year = $_POST['year'];
        $searchData = $year . "-" . $month . "-" . $day;
    }
?>
    <meta http-equiv="refresh" content="0;  url = https://rozette.xyz/parcel/searchProduct.php?start=<?php echo $currentPage ?>&searchData=<?php echo $searchData ?>">
<?php
}
