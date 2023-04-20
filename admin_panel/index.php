<?php
error_reporting(-1);
require_once('../config/connect.php');
session_start();



$products = mysqli_query($connect,"SELECT * FROM `products`");

if(!isset($_COOKIE['login'])){
    $_SESSION['message'] = 'Немає прав доступу';
    header("location:javascript:history.go(-1)");
}

if(isset($_COOKIE['login'])){
    if($_COOKIE['role'] !== 'admin'){
        $_SESSION['denyaccess'] = 'Недостатньо прав доступу';
        header("location:javascript:history.go(-1)");
    }
}
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<?php require_once ('../view/table_style.php')?>
<header>
    <?php
    if(isset($_COOKIE['login'])) {?>
        <a href = "vendor/logout.php" class="logout" > Log Out </a >
    <?php
    }
    ?>
    <h3><?=$_COOKIE['name']?></h3>
</header>
<body>
<h1><a href="orders.php" class="link-primary">Orders</a></h1>
<h2><a href="users.php">Users</a></h2>

<a href = "../index.php">Products page</a>

<table>
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Price</th>
        <th>Description</th>
        <th>Photo</th>
        <th><h2><a href="create_product.php">Create Product</a></h2>
        </th>
    </tr>
    <?php

    while ($row = mysqli_fetch_assoc($products)) {
        ?>
    <tr>
        <td><?=$row['id']?></td>
        <td><?=$row['title']?></td>
        <td><?=$row['price']?></td>
        <td><?=$row['description']?></td>
        <td><img src="<?=$row['photo']?>" width="100" height="100"></td>
        <td><a href="update.php?id=<?=mysqli_real_escape_string($connect,$row['id'])?>">Update</a></td>
        <td><a href="vendor/delete.php?id=<?=mysqli_real_escape_string($connect, $row['id'])?>">Delete</a> </td>
        <td><a href="product_stats.php?id=<?=$row['id']?>">Stats by product</a></td>
    </tr>
    <?php
}
    ?>
</table><br><br>
</body>
</html>