<?php
require_once ('query.php');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Stats</title>
    <?php
    require_once ('../view/table_style.php')
    ?>
</head>
<body>
<h3>
    <p>Filter by</p>
</h3>
<form action="stats.php" method="post" id="filter_by">
    <input type="search" name="search_by"><br><br>
    <label>Date from</label>
    <input type="date" name="start" min="2023-01-01" value="2023-01-01">
    <label>To:</label>
    <input type="date" name="to" max="<?=$today?>" value="<?=$today?>">
    <br>
    <input type="submit">
</form>
<br>
<label for="columns">Choose a value for search: </label>
<select name="column" id="column" form="filter_by">
    <option value="id">ID</option>
    <option value="full_name">Name</option>
    <option value="number">Number</option>
    <option value="order_status">Orders Status</option>
    <option value="email">Email</option>
</select>
<br><br>
<table>
    <tr>
        <th>ID</th>
        <th>Name</th>
        <th>Number</th>
        <th>City</th>
        <th>Address</th>
        <th>Orders Date</th>
        <th>Order Status</th>
        <th>Email</th>
        <th>Total Price</th>
    </tr>
    <?php
    $sql = "SELECT * FROM orders " . (empty($_POST['start']) ? "where order_date <= '$to_date'" : NULL) .
        (empty($_POST['to']) ? "where order_date >= '$from_date'" : NULL) .
        (!empty($_POST['start']) && !empty($_POST['to']) ? "where order_date >= '$from_date' and order_date <= '$to_date'" : NULL);


        if (!empty($_POST['start']) && !empty($_POST['to'])){
            $date_count = mysqli_query($connect, "SELECT count(id) from orders where order_date >= '$from_date' and order_date <= '$to_date'");
            $date_count = mysqli_fetch_array($date_count);
            $total_by_date = mysqli_query($connect, "select sum(total_price) from order_products inner join orders on order_products.order_id = orders.id where order_date >= '$from_date' and order_date <= '$to_date' ");
            $total_by_date = mysqli_fetch_array($total_by_date);


    if(isset($_POST['search_by']) &&!empty($_POST['search_by'])){
        $sql ="SELECT * FROM orders where $column like '%$search%'";
    }

        $sql = mysqli_query($connect, $sql);
    if (mysqli_num_rows($sql)== 0){
        $not_find = 'Елементів з Ввашим запитом не знайдено!';
        header('Location: stats.php');
    }
        while ($row = mysqli_fetch_assoc($sql)){
            $total = mysqli_query($connect, "select sum(total_price) from order_products where order_id = {$row['id']}");
            $total = mysqli_fetch_array($total);
            if($row['order_status'] == 0){
                $row['order_status'] = 'new';
            }elseif ($row['order_status'] == 1){
                $row['order_status'] = 'pending';
            }else{
                $row['order_status'] = 'done';
            }
            ?>
    <tr>
        <td><a href="order_details.php?id=<?=$row['id']?>"</a><?=$row['id']?></td>
        <td><a href="user_orders.php?email=<?=$row['email']?>"><?=$row['full_name']?></a></td>
        <td><?=$row['number']?></td>
        <td><?=$row['city']?></td>
        <td><?=$row['address']?></td>
        <td><?=$row['order_date']?></td>
        <td><?=$row['order_status']?></td>
        <td><?=$row['email']?></td>
        <td><?=$total[0]?></td>
    </tr>
    <?php
    }
    if (isset($not_find)){
        echo "<h3 style='color: red'>$not_find</h3>";
    }
    ?>
</table>
<table>
    <tr>
        <th>Total orders price</th>
        <th>AVG Receipt</th>
        <th>Orders Count</th>
        <th>Sum orders bt date</th>
        <th>Today orders count</th>
        <th>Today orders sum</th>
    </tr>
    <tr>
        <td><?=$ttl['sum(total_price)']?></td>
        <td><?=$avg['avg(total_price)']?></td>
        <td><?=$count_orders[0]?></td>
        <td><?php
            if(isset($total_by_date)){
                echo $total_by_date[0];
                }
            }
            ?></td>
        <td><?=$today_orders[0]?></td>
        <td><?=$today_sum[0]?></td>
    </tr>
</table>
<table>
    <tr><th>Total Ordered qty</th></tr>
    <tr><?php
        $quantity = [];

        while ($row = mysqli_fetch_assoc($products)) {
            $qty = "SELECT sum(quantity) from order_products inner join orders on  order_products.order_id = orders.id
                     where order_products.id = {$row['id']}" . (!empty($_POST['start']) && !empty($_POST['to']) ? " and 
                     orders.order_date >= '$from_date' and orders.order_date <= '$to_date'": NULL) .
                (empty($_POST['start']) ? " and orders.order_date <= '$to_date'" : NULL);
            $qty = mysqli_query($connect, $qty);
            $qty = mysqli_fetch_all($qty);
            $quantity[] = $qty[0];
            ?>
        <th><?=$row['title']?></th>
        <?php
        }
        ?>
    </tr>
    <tr>
        <?php foreach ($quantity as $item) {
            echo "<td>$item[0]</td>";
        }
    ?>
    </tr>
</table>
</body>
</html>
