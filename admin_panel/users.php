<?php
require_once('../config/connect.php');
if (!isset($_COOKIE['login'])){
    header('Location: ../index.php');
}
$query= mysqli_query($connect, "SELECT * from users");
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registered users</title>
    <?php require_once ('../view/table_style.php')?>
</head>
<body>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

<h3><a href="index.php">Admin Panel</a></h3>
<h3>Registered Users</h3>
<table>
    <tr>
        <th>ID</th>
        <th>FUll Name</th>
        <th>Email</th>
        <th>Login</th>
        <th>User Orders</th>
    </tr>
    <tr>
        <?php
        while ($row = mysqli_fetch_assoc($query)) {
        $avatar = "../auth/" . $row['avatar'];

        ?>
        <td><?=$row['id']?></td>
        <td><?=$row['full_name']?></td>
        <td><?=$row['email']?></td>
        <td><?=$row['login']?></td>
        <td><a href="user_orders.php?email=<?=$row['email']?>">User orders</a></td>
        <td><a href="vendor/delete_user.php?id=<?=mysqli_real_escape_string($connect, $row['id'])?>">Delete</a></td>
    </tr>
    <?php
    }
    ?>
</table>
</body>
</html>
