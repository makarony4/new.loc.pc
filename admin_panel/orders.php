<?php
session_start();
require_once('../config/connect.php');
if($_COOKIE['role'] ==! 'manager' or $_COOKIE['role'] ==! 'admin'){
    $_SESSION['denyaccess'] = 'Немає прав доступу';
    header('Location: ../../index.php');
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Orders</title>
    <?php require_once ('../view/table_style.php')?>
</head>
<header>
    <?php

    if(isset($_SESSION['alert'])){?>

    <h3><?=$_SESSION['alert']?></h3>

    <?php
    unset($_SESSION['alert']);
    }
    ?>
<?php
    if(isset($_COOKIE['login'])) {?>
        <a href = "vendor/logout.php" class="logout" > Log Out </a >
        <?php
    }
    ?>
    <p>Signed in by:</p><h3><?=$_COOKIE['name']?></h3>

</header>
<body>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

<?php if($_COOKIE['role'] == 'admin'){?>
<h1><a href="index.php">Admin Panel</a></h1>
<?php
}
?>
<h1><a href="../../index.php">Products Page</a></h1>


<h1>Orders</h1>
<table>
    <tr>
        <th>OrderID</th>
        <th>FUll name</th>
        <th>Number</th>
        <th>City</th>
        <th>Address</th>
        <th>Order Date</th>
        <th>Order Status</th>
    </tr>

    <?php
    $orders = mysqli_query($connect, "SELECT * FROM orders");
while($row = mysqli_fetch_assoc($orders)){
if ($row['order_status'] == 0){
   $status = 'New';
}
elseif ($row['order_status'] == 1){
    $status = 'Pending';
}
else{
    $status = 'Done';
}
    ?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['full_name']?></td>
            <td>+380<?=$row['number']?></td>
            <td><?=$row['city']?></td>
            <td><?=$row['address']?></td>
            <td><?=$row['order_date']?></td>
            <td><?=$status?></td>
            <td><a href="order_details.php?id=<?=$row['id']?>">Details</a></td>
            <td><a href="vendor/delete_order.php?id=<?=$row['id']?>">Delete</a></td>
            <td><a href="changestatus.php?id=<?=$row['id']?>&action=on_work">Take to work </a></td>
            <td><a href="changestatus.php?id=<?=$row['id']?>&action=finish">Finish</a></td>
        </tr>
        <?php
}
    ?>
</table><br><br>

</body>
</html>

