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
    <title>Statistics</title>

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
        <center>
            <h2>Top 10 Customer</h2>
        </center>

        <?php

        $topCustomer = 10;

        $query = "SELECT * FROM customer ORDER BY name";
        $result = mysqli_query($connection, $query);
        $row = mysqli_num_rows($result);

        $nameArray = [];
        $phoneNumberArray = [];
        $totalAmountArray = [];
        $x = 0;

        if ($row != 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $name = $data['name'];
                $phoneNumber = $data['phoneNumber'];

                $q = "SELECT * FROM customer WHERE name='$name'";
                $r = mysqli_query($connection, $q);
                $d = mysqli_fetch_assoc($r);
                $n = $d['name'];

                if ($flag != $n || $x == 0) {
                    $flag = $name;

                    $r = mysqli_query($connection, $q);
                    while ($d = mysqli_fetch_assoc($r))
                        $totalAmountArray[$x] += $d['totalAmount'];

                    $phoneNumberArray[$x] = $phoneNumber;
                    $nameArray[$x] = $name;
                    $x++;
                }
            }
        }

        ?>
        <table class="table" width="">
            <thead>
                <tr>
                    <th width="150px">Customer Name</th>
                    <th width="1px">Phone Number</th>
                    <th width="1px">Total Amount</th>
                </tr>
            </thead>
            <?php
            for ($i = 0; $i < count($totalAmountArray); $i++, $topCustomer--) {
                if ($topCustomer == 0)
                    break;

                $max = 0;
                $index = 0;

                for ($j = 0; $j < count($totalAmountArray); $j++)
                    if ($max < $totalAmountArray[$j]) {
                        $max = $totalAmountArray[$j];
                        $index = $j;
                    }

                $totalAmountArray[$index] = 0;
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $nameArray[$index] ?></td>
                        <td><?php echo $phoneNumberArray[$index] ?></td>
                        <td><?php echo $max ?></td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
        </table>

        <center>
            <h2>Top 10 Product</h2>
        </center>

        <?php

        $topProduct = 10;

        $query = "SELECT * FROM product ORDER BY productName";
        $result = mysqli_query($connection, $query);
        $row = mysqli_num_rows($result);

        $productNameArray = [];
        $shadeArray = [];
        $totaluantityArray = [];
        $x = 0;

        if ($row != 0) {
            while ($data = mysqli_fetch_assoc($result)) {
                $productName = $data['productName'];
                $shade = $data['shade'];

                $q = "SELECT * FROM product WHERE productName='$productName'";
                $r = mysqli_query($connection, $q);
                $d = mysqli_fetch_assoc($r);
                $n = $d['productName'];

                if ($flag != $n || $x == 0) {
                    $flag = $productName;

                    $r = mysqli_query($connection, $q);
                    while ($d = mysqli_fetch_assoc($r))
                        $totaluantityArray[$x] += $d['quantity'];

                    $shadeArray[$x] = $shade;
                    $productNameArray[$x] = $productName;
                    $x++;
                }
            }
        }

        ?>
        <table class="table" width="">
            <thead>
                <tr>
                    <th width="150px">Product Name</th>
                    <th width="1px">Shade</th>
                    <th width="1px">Quantity</th>
                </tr>
            </thead>
            <?php
            for ($i = 0; $i < count($totaluantityArray); $i++, $topProduct--) {
                if ($topProduct == 0)
                    break;

                $max = 0;
                $index = 0;

                for ($j = 0; $j < count($totaluantityArray); $j++)
                    if ($max < $totaluantityArray[$j]) {
                        $max = $totaluantityArray[$j];
                        $index = $j;
                    }

                $totaluantityArray[$index] = 0;
            ?>
                <tbody>
                    <tr>
                        <td><?php echo $productNameArray[$index] ?></td>
                        <td><?php echo $shadeArray[$index] ?></td>
                        <td><?php echo $max ?></td>
                    </tr>
                </tbody>
            <?php
            }
            ?>
        </table>

        <center>
            <h2>Delete 1 Month Data</h2>
        </center>

        <form action="" method="POST" class="form" id="actionForm"></form>
        <center>
            <div>
                <input name="month" type="text" class="input" placeholder="MM" form="actionForm" style="width: 27px;">
                <input name="year" type="text" class="input" placeholder="" form="actionForm" style="width: 36px;" value="2023">
            </div>
            <input name="delete" type="submit" class="button" id="delete" value="Delete" form="actionForm" onclick="return checkDelete()">
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
if (isset($_POST['delete'])) {
    $year = $_POST['year'];
    $month = $_POST['month'];

    if ($month == 2)
        if ((0 == $year % 4) & (0 != $year % 100) | (0 == $year % 400))
            $x = 29;
        else
            $x = 28;
    else if ($month == 1 || $month == 3 || $month == 5 || $month == 7 || $month == 8 || $month == 10 || $month == 12)
        $x = 31;
    else
        $x = 30;

    if (strlen($month) == 1)
        $month = "0" . $month;

    for ($i = 1; $i <= $x; $i++) {
        $day = $i;
        if (strlen($day) == 1)
            $day = "0" . $day;

        $data = $year . "-" . $month . "-" . $day;

        $query = "DELETE FROM customer WHERE date='$data'";
        $result = mysqli_query($connection, $query);

        $query = "DELETE FROM product WHERE date='$data'";
        $result = mysqli_query($connection, $query);
    }
}
