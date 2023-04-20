<?php
require_once('../config/connect.php');
$sql = "SELECT * FROM orders";
$today = date("Y-m-d");
if (!empty($_POST['search_by'])) {
    $search = $_POST['search_by'];
    $column = $_POST['column'];
}
if (!empty($_POST['start']) or !empty($_POST['to'])){
    $from_date = $_POST['start'];
    $to_date = $_POST['to'];
}

$ttl = "SELECT sum(total_price) from order_products";
$ttl = mysqli_query($connect, $ttl);
$ttl = mysqli_fetch_assoc($ttl);

$avg = mysqli_query($connect,"SELECT avg(total_price) FROM order_products");
$avg = mysqli_fetch_assoc($avg);

$count_orders = mysqli_query($connect, "SELECT count(id) from orders");
$count_orders = mysqli_fetch_row($count_orders);

$today_orders = mysqli_query($connect, "SELECT count(id) from orders where order_date like '%$today%'");
$today_orders = mysqli_fetch_row($today_orders);

$today_sum = mysqli_query($connect, "select sum(total_price) from order_products inner join orders on order_products.order_id = orders.id where order_date like '%$today%'");
$today_sum = mysqli_fetch_row($today_sum);

$products = mysqli_query($connect, "SELECT title, id from products");


?>