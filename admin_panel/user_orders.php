<?php
require_once('../config/connect.php');
$email = $_GET['email'];


$result = mysqli_query($connect, "SELECT * FROM orders where email = '$email' order by order_date");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Orders</title>
    <?php require_once ('../view/table_style.php')?>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
</head>
<body>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">
<h3><a href="users.php">Back to Users</a></h3>
<h3>Orders History</h3>
<table>
    <tr>
        <th>Id</th>
        <th>Full Name</th>
        <th>Number</th>
        <th>City</th>
        <th>Address</th>
        <th>Order Date</th>
        <th>Order Status</th>
        <th>Email</th>
        <th>Total Price</th>
    </tr>
    <?php while($row = $result -> fetch_assoc()):
        if ($row['order_status'] == 0) {
            $status = 'New';
        } elseif ($row['order_status'] == 1) {
            $status = 'Pending';
        } else {
            $status = 'Done';
        }
        $total = mysqli_query($connect, "select sum(total_price) from order_products where order_id = {$row['id']}");
        $total = mysqli_fetch_array($total);
        ?>
        <tr>
            <td><?=$row['id']?></td>
            <td><?=$row['full_name']?></td>
            <td><?=$row['number']?></td>
            <td><?=$row['city']?></td>
            <td><?=$row['address']?></td>
            <td><?=$row['order_date']?></td>
            <td><?=$status?></td>
            <td><?=$row['email']?></td>
            <td><?=$total[0]?></td>
            <td><a href="order_details.php?id=<?=$row['id']?>">Details</a></td>
        </tr>
        <?php
    endwhile;
    ?>
</table><br><br>
</body>
</html>
<?php
?>
