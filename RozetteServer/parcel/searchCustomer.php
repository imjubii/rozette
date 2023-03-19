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
    <title>Search Customer</title>

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
            <input name="searchDataInput" type="text" class="input" placeholder="Search by Name/Phone" form="actionForm">
            <div>
                <input name="day" type="text" class="input" placeholder="DD" form="actionForm" style="width: 22px;">
                <input name="month" type="text" class="input" placeholder="MM" form="actionForm" style="width: 27px;">
                <input name="year" type="text" class="input" placeholder="" form="actionForm" style="width: 36px;" value="2023">
            </div>
            <input name="search" type="submit" class="button" id="search" value="search" form="actionForm">
        </center>

        <?php
        $searchData = $_POST['searchData'];

        $perPage = 2;
        $start = 0;
        $currentPage = 1;

        if (isset($_GET['start'])) {
            $searchData = $_GET['searchData'];
            $start = $_GET['start'];
            $currentPage = $start;
            $start--;
            $start *= $perPage;
        }

        $query = "SELECT * FROM customer WHERE name='$searchData'";
        $resultOfName = mysqli_query($connection, $query);
        $nameRow = mysqli_num_rows($resultOfName);

        $query = "SELECT * FROM customer WHERE phoneNumber='$searchData'";
        $resultOfPhoneNumber = mysqli_query($connection, $query);
        $phoneNumberRow = mysqli_num_rows($resultOfPhoneNumber);

        $query = "SELECT * FROM customer WHERE date='$searchData'";
        $resultOfdate = mysqli_query($connection, $query);
        $dateRow = mysqli_num_rows($resultOfdate);

        if ($nameRow != 0) {
            $totalRow = $nameRow;
            $query = "SELECT * FROM customer WHERE name='$searchData' LIMIT $start, $perPage";
            $result = mysqli_query($connection, $query);
        } else if ($phoneNumberRow != 0) {
            $totalRow = $phoneNumberRow;
            $query = "SELECT * FROM customer WHERE phoneNumber='$searchData' LIMIT $start, $perPage";
            $result = mysqli_query($connection, $query);
        } else if ($dateRow != 0) {
            $totalRow = $dateRow;
            $query = "SELECT * FROM customer WHERE date='$searchData' LIMIT $start, $perPage";
            $result = mysqli_query($connection, $query);
        }

        $page = ceil($totalRow / $perPage);

        ?>
        <table class="table" width="">
            <thead>
                <tr>
                    <th while="1px">CheckBox</th>
                    <th width="70px">Date</th>
                    <th width="1px">Name</th>
                    <th width="1px">Phone Number</th>
                    <th width="1px">Total Amount</th>
                    <th width="1px">Advance Amount</th>
                    <th width="1px">Due Amount</th>
                    <th width="1px">Status</th>
                </tr>
            </thead>
            <?php

            if ($totalRow != 0) {
                while ($data = mysqli_fetch_assoc($result)) {
            ?>
                    <tbody>
                        <tr>
                            <td><input name="checkbox[]" type="checkbox" class="checkbox" id="checkbox" value="<?php echo $data['id'] ?>" form="actionForm"></td>
                            <td><?php echo $data['date'] ?></td>
                            <td><?php echo $data['name'] ?></td>
                            <td><?php echo $data['phoneNumber'] ?></td>
                            <td><?php echo $data['totalAmount'] ?></td>
                            <td><?php echo $data['advanceAmount'] ?></td>
                            <td><?php echo $data['dueAmount'] ?></td>

                            <td>
                                <?php
                                if ($data['status'] == "n") {
                                    echo "<a href='./details.php?id=$data[id]'>
                                    <input style='background-color: white; color: black;' type='submit' value='Details' class='details'>
                                </a>";
                                } else if ($data['status'] == "d") {
                                    echo "<a href='./details.php?id=$data[id]'>
                                    <input style='background-color: green; color: black;' type='submit' value='Details' class='details'>
                                </a>";
                                } else if ($data['status'] == "h") {
                                    echo "<a href='./details.php?id=$data[id]'>
                                    <input style='background-color: yellow; color: black;' type='submit' value='Details' class='details'>
                                </a>";
                                } else if ($data['status'] == "u") {
                                    echo "<a href='./details.php?id=$data[id]'>
                                    <input style='background-color: grey; color: black;' type='submit' value='Details' class='details'>
                                </a>";
                                }
                                ?>
                            </td>
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

            <div class="functionButton">
                <div>
                    <center>
                        <input name="delivered" type="submit" class="button" id="delivered" value="Delivered" form="actionForm">
                    </center>
                    <center>
                        <input name="hold" type="submit" class="button" id="hold" value="Hold" form="actionForm">
                    </center>
                </div>

                <div>
                    <center>
                        <input name="unassigned" type="submit" class="button" id="unassigned" value="Unassigned" form="actionForm">
                    </center>
                    <center>
                        <input name="delete" type="submit" class="button" id="delete" value="Delete" form="actionForm" onclick="return checkDelete()">
                    </center>
                </div>
            </div>
        </center>

        <center>
            <form action="./parcelDashboard.php" method="post" class="form">
                <button class="button">Back</button>
            </form>
        </center>
    </div>

    <script>
        function checkDelete() {
            return confirm('Are you sure you want to DELETE The Record?');
        }
    </script>
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
    <meta http-equiv="refresh" content="0;  url = https://rozette.xyz/parcel/searchCustomer.php?start=<?php echo $currentPage ?>&searchData=<?php echo $searchData ?>">
<?php
}

// Delivered
if (isset($_POST['delivered'])) {
    $checkbox = $_POST['checkbox'];

    foreach ($checkbox as $key => $value) {
        $query = "UPDATE customer SET status='d' WHERE id = $value";
        $result = mysqli_query($connection, $query);
    }

?>
    <meta http-equiv="refresh" content="0;  url = https://rozette.xyz/parcel/searchCustomer.php?start=<?php echo $currentPage ?>&searchData=<?php echo $searchData ?>">
<?php
}

// Hold
if (isset($_POST['hold'])) {
    $checkbox = $_POST['checkbox'];

    foreach ($checkbox as $key => $value) {
        $query = "UPDATE customer SET status='h' WHERE id = $value";
        $result = mysqli_query($connection, $query);
    }

?>
    <meta http-equiv="refresh" content="0;  url = https://rozette.xyz/parcel/searchCustomer.php?start=<?php echo $currentPage ?>&searchData=<?php echo $searchData ?>">
<?php
}

// Unassigned
if (isset($_POST['unassigned'])) {
    $checkbox = $_POST['checkbox'];

    foreach ($checkbox as $key => $value) {
        $query = "UPDATE customer SET status='u' WHERE id = $value";
        $result = mysqli_query($connection, $query);
    }

?>
    <meta http-equiv="refresh" content="0;  url = https://rozette.xyz/parcel/searchCustomer.php?start=<?php echo $currentPage ?>&searchData=<?php echo $searchData ?>">
<?php
}

// Delete
if (isset($_POST['delete'])) {
    $checkbox = $_POST['checkbox'];

    foreach ($checkbox as $key => $value) {
        $query = "SELECT * FROM customer WHERE id = $value";
        $result = mysqli_query($connection, $query);
        $data = mysqli_fetch_assoc($result);
        $phoneNumber = $data['phoneNumber'];

        $query = "DELETE FROM customer WHERE id = $value";
        $result = mysqli_query($connection, $query);

        $query = "DELETE FROM product WHERE phoneNumber = '$phoneNumber'";
        $result = mysqli_query($connection, $query);
    }

?>
    <meta http-equiv="refresh" content="0;  url = https://rozette.xyz/parcel/searchCustomer.php?start=<?php echo $currentPage ?>&searchData=<?php echo $searchData ?>">
<?php
}
?>