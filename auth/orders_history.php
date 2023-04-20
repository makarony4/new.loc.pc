<?php
require_once('../config/connect.php');

$order_id = mysqli_real_escape_string($connect, trim($_GET['id']));
$ordered_products = mysqli_query($connect, "SELECT * FROM order_products where order_id = '$order_id'");
$ordered_products = mysqli_fetch_all($ordered_products);
$total = mysqli_query($connect, "select sum(total_price) from order_products where order_id = '$order_id'");
$total = mysqli_fetch_array($total);


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order details</title>
    <style>
        th,td{
            padding: 10px;
        }
        th{
            background:#606060;
        }

        td{
            background: bisque;
        }
    </style>
</head>
<body>
<a href="profile.php"><h3>Back to profile</h3></a>
<table>
    <tr>
        <th>Product id</th>
        <th>Product</th>
        <th>Price of 1 pc</th>
        <th>Quantity</th>
        <th>Total price</th>
    </tr>
    <?php foreach ($ordered_products as $ordered_product){

        ?>
    <tr>
        <td><?=$ordered_product[1]?></td>
        <td><?=$ordered_product[3]?></td>
        <td><?=$ordered_product[4]?></td>
        <td><?=$ordered_product[2]?></td>
        <td><?=$ordered_product[5]?></td>
    </tr>

        <?php
    }
    ?>
    <tr>
        <td colspan='3'></td>
        <td></b>Total</td>
        <td><?=$total[0]?></td>
    </tr>
    </table>
    </body>
</html>