<?php
require_once('../../config/connect.php');

$title = $_POST['title'];
$price = $_POST['price'];
$description = $_POST['description'];
$path = 'uploads/' . time() . $_FILES['photo']['name'];

if(!mysqli_connect_errno()) {
    if (empty($title) && empty($price) && empty($description)) {
       header('Location: ../index.php');
    }

    $sql = "INSERT INTO products (title, `description`, `price`, `photo`) VALUES (?, ?, ?, ?)";
    $stmt = mysqli_prepare($connect, $sql);
    mysqli_stmt_bind_param($stmt, 'ssis', $title, $description, $price, $path);
    move_uploaded_file($_FILES['photo']['tmp_name'], '../' . $path);
    mysqli_stmt_execute($stmt);
}
mysqli_close($connect);

header('Location: ../index.php');



