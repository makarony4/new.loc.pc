<?php
require_once('../config/connect.php');



$product_id = mysqli_real_escape_string($connect, trim($_GET['id']));
$sql = "SELECT * FROM `products` WHERE `id` = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "i", $product_id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$product = mysqli_fetch_assoc($result);
mysqli_close($connect);

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update</title>
</head>
<body>
<INPUT TYPE="button" VALUE="Back" onClick="history.go(-1);">

<h3>UPDATE PRODUCT</h3>
<form action="vendor/update.php" method="post" enctype = "multipart/form-data">
    <p>Photo</p>
    <img src="<?=$product['photo']?>" width="100" height="100">
    <input type="file" name="photo" value="<?=$product['photo']?>" accept=".jpg, .jpeg, .png" >
    <input type="hidden", name="id", value="<?=$product_id?>">
    <p>Title</p>
    <input type="text" name="title" value="<?= $product['title'] ?>">
    <p>Price</p> <br>
    <input type="number" name="price" value="<?= $product['price'] ?>">
    <p>Description</p> <br>
    <textarea name="description"><?= $product['description'] ?></textarea><br><br>
    <button type="submit">Update product</button>
</form>
</body>
</html>