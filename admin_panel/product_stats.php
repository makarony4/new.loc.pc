<?php
require_once('../config/connect.php');
$id = trim($_GET['id']);

$ordered_times = mysqli_query($connect, "SELECT sum(quantity) from order_products where id = '$id'");
$ordered_times  = mysqli_fetch_row($ordered_times);
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Product Stats</title>
<?php require_once ('../view/table_style.php')?>
</head>
<body>
<table>
    <tr>
        <th>Ordered time's</th>
    </tr>
    <tr>
        <td><?=$ordered_times[0]?></td>
    </tr>
</table>
</body>
</html>