<?php
session_start();
require_once('../config/connect.php'); //db connect
error_reporting(1);
$total = 0;
//сиворення умови додавання в корзину
if(isset($_POST['add_to_cart'])){
    if(isset($_SESSION['cart'])){

        $session_array_id = array_column($_SESSION['cart'], "id");

        if(!in_array($_GET['id'], $session_array_id)){
            $session_array = array(
                'id' => $_GET['id'],
                'title'=> $_POST['title'],
                'price' => $_POST['price'],
                'quantity' => $_POST['quantity']

            );
            $_SESSION['cart'][] = $session_array;
        }
    }else{
        $session_array = array(
            'id' => $_GET['id'],
            'title'=> $_POST['title'],
            'price' => $_POST['price'],
            'quantity' => $_POST['quantity']
        );
        $_SESSION['cart'][] = $session_array;
    }
}
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
   <style type="text/css">
    </style>
    <title>Delivery Info</title>
    <style type="text/css">
        .col-md-6{
            position:absolute;
            top:0;
            right:0;
        }
    </style>
</head>
<body>

<a href="../auth/index.php"><h1>Login Page</h1></a>
<a href="../index.php"><h1>Products page</h1></a>


<form action="vendor/createorder.php?action=add_to_cart" name="delivery" method="post" style="padding: 10px">
    <p>Full Name</p>
    <input type="text" name="full_name" placeholder="Press your Full Name">
    <p>City</p>
    <input type="text" name="city" placeholder="Press your city">
    <p>Address</p>
    <input type="text" name="address" placeholder="Press your Address">
    <p>Email</p>
    <input type="email" name="email" placeholder="Press your email">
    <p>Phone Number</p>
    <input type="text" name="number" placeholder="Press your Number" maxlength="10"><br><br>
    <input type="submit" value="Confirm">
</form>

</div>
<div class="col-md-6" style="text-align:right; margin:0px auto 0px auto;">>
    <h2 class="text-center">Item Selected</h2>
    <?php

    //вдображення товарів в корзині
    $output = " ";
    $output .= "
                <table class='table table-bordered table-stripped'>
                <tr>
                <th>ID</th>
                <th>Item Title</th>
                <th>item Price</th>
                <th>Item Quantity</th>
                <th>Total Price</th>
                <th>Action</th>
                </tr>
                ";
    if(!empty($_SESSION['cart'])){
        foreach ($_SESSION['cart'] as $key => $value) {
            $output .= "
                        <tr>
                        <td>".$value['id']."</td>
                        <td>".$value['title']."</td>
                        <td>".$value['price']."</td>
                        <td>".$value['quantity']."</td>
                        <td>".number_format($value['price'] * $value['quantity'])."</td>
                        <td>
                        <a href='main.php?action=remove&id=".$value['id']."'>
                        <button class='btn btn-danger btn-block'>Remove</button>
                        </a>
                        </td>
                        </tr>
                        ";
            //підрахунок загальної вартості
            $total = $total + $value ['quantity'] * $value['price'];

        }
        $output .="
                    <tr>
                    <td colspan='3'></td>
                    <td></b>Total price</td>
                    <td>". number_format($total,2)."</td>
                    <td>
                        <a href='main.php?action=clearall'>
                        <button class='btn btn-warning'>Clear All</button>
                        </a>
                        </td>
                    </tr>
                    ";
    }

    echo $output;

    ?>
</div>

<?php
if(isset($_GET['action'])){
    if($_GET['action'] == 'clearall'){
        unset($_SESSION['cart']);
        header('Location: index.php');
    }
}
if($_GET['action'] == 'remove'){
    foreach ($_SESSION['cart'] as $key=>$value){
        if($value['id'] == $_GET['id']){
            unset($_SESSION['cart'][$key]);

        }
    }
}
?>
</body>
</html>