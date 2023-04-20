<?php
require_once('../config/connect.php');
$id = mysqli_escape_string($connect, $_GET['id']);
$action = mysqli_escape_string($connect, $_GET['action']);

if ($action == 'finish') {
    $status = 2;
}else $status = 1;


$sql  = "UPDATE orders SET order_status = ? WHERE id  = ?";
$stmt = mysqli_prepare($connect, $sql);
mysqli_stmt_bind_param($stmt, "is", $status, $id);
mysqli_stmt_execute($stmt);
mysqli_close($connect);
header('Location: orders.php');