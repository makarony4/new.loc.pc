<?php

require_once ('../config/connect.php');

//витягуємо параметри
function getParams(array $arr)
{
    $params = [];
    $param = array_values($arr);
    array_push($params, ...$param);
    return $params;
}


//ловимо знаки питання для бінду
function getMarks($count){
    global $product_params;
    $question_mark = "(" . str_repeat('?,' , count($count));
    if ($count == $product_params){
        $question_mark = "(" . str_repeat('?,' , count($_SESSION['cart'][0]) + 2);
    }
    $question_mark = substr($question_mark, 0, -1);
    $question_mark .= ")";
    if ($count == $product_params){
$question_mark .= ',';
$question_mark = str_repeat($question_mark, count($_SESSION['cart']));
$question_mark = substr($question_mark, 0 ,-1);
    }
    return $question_mark;
}


//ловимо типи даних для бінду

function getTypes($params){
    $type = '';
    foreach ($params as $param){
        if(is_string($param)){
        $type .= 's';
        }
        elseif(is_int($param)){
            $type .= 'i';
        }
    }
return $type;
}

//вставляємо в мускл
function insertOrder($table_name, $columns, $arr){
    global $connect;
    $query = "INSERT INTO $table_name ($columns) VALUES " . getmarks($arr);
    $stmt_products = mysqli_prepare($connect, $query);
    mysqli_stmt_bind_param($stmt_products, getTypes(getParams($arr)) ,...getParams($arr));
    mysqli_stmt_execute($stmt_products);
}

function dbSelectAll($connect, $table_name ){
$result = mysqli_query($connect, "SELECT * FROM $table_name");
return $result;
}

function dbSelectWhere($connect, $table_name, $equal, $columns = '*'){
$result = mysqli_query($connect, "SELECT $columns FROM $table_name WHERE $equal");
return $result;
}


