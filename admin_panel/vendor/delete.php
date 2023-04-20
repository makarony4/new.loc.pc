<?php

require_once('../config/connect.php');

$id = mysqli_escape_string($connect, $_GET['id']);
$sql  = "DELETE FROM products WHERE `products`.`id` = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "s", $id);
mysqli_stmt_execute($stmt);
mysqli_close($connect);
header('Location: index.php');
