<?php
session_start();
require_once('config/connect.php');
error_reporting(1);
$total = 0;
if(isset($_COOKIE['role']) && $_COOKIE['role'] =='admin'){?>
<a href="admin_panel/index.php"><h3>Admin Panel</h3></a>
<?php
}
?>
<?php
//витягування ключів
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
    <title>Main Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <div class="col-md-12">
        <div class="row">
            <div class="col-md-6">
                <h2 class="text-center">SHopping cart data</h2>
                <div class="col-md-12>">
                <div class="row">
                <?php
                //відображення каталогу товарів
                $query = "SELECT * FROM products";
                $result = mysqli_query($connect, $query);
                while($row = mysqli_fetch_array($result)){?>
                <div class="col-md-4">
                    <form method="post" action="index.php?id=<?=$row['id']?>">
                        <img src="admin_panel/<?=$row['photo']?>" style="height: 150px;">
                        <h5 class="text-center"><?=$row['title']?></h5>
                        <h5 class="text-center"><?=$row['price']?>UAH</h5>
                        <input type="hidden" name="title" value="<?=$row['title']?>">
                        <input type="hidden" name="price" value="<?=$row['price']?>">
                        <input type="number" name="quantity" value="1" class="form-control">
                        <input type="submit" name="add_to_cart" class="btn btn-warning btn-block my-5" value="Add To Cart">

                    </form>
                </div>
                <?php
                }
                ?>
                </div>
                </div>
            </div>
            <div class="col-md-6">
                <h2 class="text-center">Item Selected</h2>
                <?php
                //відображення товарів в корзині
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
                        <a href='index.php?action=remove&id=".$value['id']."'>
                        <button class='btn btn-danger btn-block'>Remove</button>
                        </a>
                        </td>
                        </tr>
                        ";
                        $total = $total + $value ['quantity'] * $value['price'];

                    }
                    $output .="
                    <tr>
                    <td colspan='3'></td>
                    <td></b>Total price</td>
                    <td>". number_format($total,2)."</td>
                    <td>
                        <a href='index.php?action=clearall'>
                        <button class='btn btn-warning'>Clear All</button>
                        </a>
                        </td>
                                            <td>
                        <a href='/Checkout/main.php?action=confirm'>
                        <button class='btn btn-primary'>Move to cart</button>
                        </a>
                        </td>
                    </tr>
                    ";
                }

                echo $output;

                ?>
            </div>
        </div>
    </div>
</div>
<a href="auth/index.php">Login Page</a>

<?php

//Створення функцій видалення та очищення корзини
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