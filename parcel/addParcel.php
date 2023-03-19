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
    <title>Add Parcel</title>

    <script>
        if (window.history.replaceState) {
            window.history.replaceState(null, null, window.location.href);
        }
    </script>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js'></script>
    <script type="text/javascript">
        $(document).ready(function() {

            var html = '<tr><td><input name="productName[]" type="text" class="input" placeholder="Product Name" required></td><td><input name="quantity[]" type="text" class="input" placeholder="Quantity" required style="width: 80px;"></td><td><input name="shade[]" type="text" class="input" placeholder="Shade" required style="width: 80px;"></td></tr>';

            $("#more").click(function() {
                $("#table").append(html);
            });

        });
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

        .more {
            padding: 10px 10px;
            width: 80px;
        }

        .button:hover {
            background: #d0a4ff;
        }
    </style>
</head>

<body>
    <img src="../image/favicon.png" alt="" class="logo">

    <div class="container">
        <form action="" method="POST" class="form" id="form">
            <center>
                <p class="p">Name:</p>
                <input name="name" type="text" class="input" placeholder="Name" required>

                <p class="p">Phone Number:</p>
                <input name="phoneNumber" type="text" class="input" placeholder="Phone Number" required>

                <table class="table" id="table">
                    <tr>
                        <th>
                            <p class="p th">Product Name:</p>
                        </th>
                        <th>
                            <p class="p th">Quantity:</p>
                        </th>
                        <th>
                            <p class="p th">Shade:</p>
                        </th>
                    </tr>

                    <tr>
                        <td><input name="productName[]" type="text" class="input" placeholder="Product Name" required></td>
                        <td><input name="quantity[]" type="text" class="input" placeholder="Quantity" required style="width: 80px;"></td>
                        <td><input name="shade[]" type="text" class="input" placeholder="Shade" required style="width: 80px;"></td>
                    </tr>
                </table>

                <input name="more" type="button" class="button more" id="more" value="More">

                <p class="p">Total Amount:</p>
                <input name="totalAmount" type="text" class="input" placeholder="Total Amount" required>

                <p class="p">Advance Amount:</p>
                <input name="advanceAmount" type="text" class="input" placeholder="Advance Amount" required>

                <p class="p">Due Amount:</p>
                <input name="dueAmount" type="text" class="input" placeholder="Due Amount" required>

                <center>
                    <input name="update" type="submit" class="button" id="update" value="Update">
                </center>
            </center>
        </form>
    </div>
</body>

</html>

<?php
include("../connection.php");

if (isset($_POST['update'])) {
    $name = $_POST['name'];
    $phoneNumber = $_POST['phoneNumber'];
    $productName = $_POST['productName'];
    $quantity = $_POST['quantity'];
    $shade = $_POST['shade'];
    $totalAmount = $_POST['totalAmount'];
    $advanceAmount = $_POST['advanceAmount'];
    $dueAmount = $_POST['dueAmount'];

    foreach ($productName as $key => $value) {
        $query = "INSERT INTO product(phoneNumber, productName, quantity, shade) VALUES ('" . $phoneNumber . "','" . $value . "'," . $quantity[$key] . ",'" . $shade[$key] . "')";
        $result = mysqli_query($connection, $query);
    }

    $query = "INSERT INTO customer(name, phoneNumber, address, totalAmount, advanceAmount, dueAmount, status) VALUES ('" . $name . "','" . $phoneNumber . "', 'X'," . $totalAmount . "," . $advanceAmount . "," . $dueAmount . ",'n')";
    $result = mysqli_query($connection, $query);

?>
    <meta http-equiv="refresh" content="0; url = http://localhost/Rozette/parcel/parcelDashboard.php">
<?php
}
?>