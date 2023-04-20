<?php
require_once('../config/connect.php');

session_start();

if($_COOKIE['role'] ==! 'manager' or $_COOKIE['role'] ==! 'admin'){
    $_SESSION['denyaccess'] = 'Немає прав доступу';
    header('Location: ../../index.php');
}
$order_id = mysqli_real_escape_string($connect, trim($_GET['id']));
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Order details</title>
    <?php require_once ('../view/table_style.php')?>

</head>
<body>
<header>
    <INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">
    <br>
    <a href="orders.php">Back to orders</a>
</header>

<table>
    <tr>
        <th>Order ID</th>
        <th>Customer name</th>
        <th>Customer phone number</th>
        <th>Customer city</th>
        <th>Customer address</th>
        <th>Order Date</th>
    </tr>

    <?php
    $orders = mysqli_query($connect, "SELECT * FROM orders where id = '$order_id' ");
    $orders = mysqli_fetch_assoc($orders);

    $total = mysqli_query($connect, "select sum(total_price) from order_products where order_id = '$order_id'");
    $total = mysqli_fetch_array($total);


    ?>
    <tr>
        <td><?=$orders['id']?></td>
        <td><?=$orders['full_name']?></td>
        <td>+380<?=$orders['number']?></td>
        <td><?=$orders['city']?></td>
        <td><?=$orders['address']?></td>
        <td><?=$orders['order_date']?></td>
    </tr>
    <?php
    //   }
    ?>
</table>
<br><br>

<?php
$ordered_products = mysqli_query($connect, "SELECT * FROM order_products where order_id = '$order_id'");

?>
<table>
    <tr>
        <th>Product id</th>
        <th>Product</th>
        <th>Price of 1 pc</th>
        <th>Quantity</th>
        <th>Total price</th>
    </tr>
    <?php while ($row = mysqli_fetch_assoc($ordered_products)){

        ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['title']?></td>
        <td><?=$row['price']?></td>
        <td><?=$row['quantity']?></td>
        <td><?=$row['total_price']?></td>
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
