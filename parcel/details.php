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
    <title>Details</title>

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
            width: 200px;
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
            width: 150px;
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
    </style>
</head>

<body>
    <img src="../image/favicon.png" alt="" class="logo">

    <form action="" method="POST" class="form" id="form">
        <div class="container">
            <center>
                <?php
                $id = $_GET['id'];
                $query = "SELECT * FROM customer WHERE id = $id";
                $result = mysqli_query($connection, $query);
                $data = mysqli_fetch_assoc($result);
                $phoneNumberOrginal = $data['phoneNumber'];
                ?>

                <p class="p">Name:</p>
                <input name="name" type="text" class="input" value="<?php echo $data['name'] ?>">

                <p class="p">Phone Number:</p>
                <input name="phoneNumber" type="text" class="input" value="<?php echo $data['phoneNumber'] ?>">

                <p class="p">Total Amount:</p>
                <input name="totalAmount" type="text" class="input" value="<?php echo $data['totalAmount'] ?>">

                <p class="p">Advance Amount:</p>
                <input name="advanceAmount" type="text" class="input" value="<?php echo $data['advanceAmount'] ?>">

                <p class="p">Due Amount:</p>
                <input name="dueAmount" type="text" class="input" value="<?php echo $data['dueAmount'] ?>">
            </center>
        </div>

        <center>
            <?php
            $query = "SELECT * FROM product WHERE phoneNumber = '$phoneNumberOrginal'";
            $result = mysqli_query($connection, $query);
            $totalRow = mysqli_num_rows($result);
            if ($totalRow != 0) {
            ?>
                <table class="table" width="">
                    <thead>
                        <tr>
                            <th width="" style="display: none;">ID</th>
                            <th width="">Product Name</th>
                            <th width="">Quantity</th>
                            <th width="">Shade</th>
                        </tr>
                    </thead>
                    <?php

                    while ($data = mysqli_fetch_assoc($result)) {
                    ?>
                        <tbody>
                            <tr>
                                <td style="display: none;"><input name="id[]" type="text" class="input" style="width: 200px;" value="<?php echo $data['id'] ?>"></td>
                                <td><input name="productName[]" type="text" class="input" style="width: 200px;" value="<?php echo $data['productName'] ?>"></td>
                                <td><input name="quantity[]" type="text" class="input" style="width: 50px;" value="<?php echo $data['quantity'] ?>"></td>
                                <td><input name="shade[]" type="text" class="input" style="width: 100px;" value="<?php echo $data['shade'] ?>"></td>
                            </tr>
                        </tbody>
                <?php
                    }
                }
                ?>

                </table>
        </center>

        <center>
            <input name="update" type="submit" class="button" id="update" value="Update">
        </center>
    </form>
</body>

</html>



<?php
if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $totalAmount = $_POST['totalAmount'];
    $advanceAmount = $_POST['advanceAmount'];
    $dueAmount = $_POST['dueAmount'];

    $query = "UPDATE customer SET name='$name', phoneNumber='$phoneNumber', totalAmount='$totalAmount', advanceAmount='$advanceAmount', dueAmount='$dueAmount' WHERE id = $id";
    $result = mysqli_query($connection, $query);

    $query = "UPDATE product SET phoneNumber='$phoneNumber' WHERE phoneNumber='$phoneNumberOrginal'";
    $result = mysqli_query($connection, $query);

    $id = $_POST['id'];
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $shade = $_POST['shade'];

    foreach ($productName as $key => $value) {
        $query = "UPDATE product SET productName='" . $value . "', quantity=" . $quantity[$key] . ", shade='" . $shade[$key] . "' WHERE id='" . $id[$key] . "'";
        $result = mysqli_query($connection, $query);
    }
?>
    <meta http-equiv="refresh" content="0;">
<?php
}
?>