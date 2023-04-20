<?php
require_once ('classes/Car.php');
require_once ('classes/WriteFile.php');
require_once ('classes/Product.php');
require_once ('classes/NoteBookProduct.php');
require_once ('classes/BookProduct.php');

error_reporting(-1);

function debug($data){
    echo '<pre>' . print_r($data, 1) . '</pre>';
}

$car1 = new Car('black', '4', '180', 'volvo');

$car2 = new Car('white', '4', '200', 'bmw');


echo $car2->getCarInfo();
echo $car1 ->getCarInfo();


$file = new WriteFile(__DIR__ . '/text.txt');


$file->write('Стрічка 1');
$file ->write('Стрічка 2');
$file ->write('Стрічка 3');


echo Car::getCount();

echo $car1->getProtoInfo();

echo Car::class;


//Products classes

$book = new BookProduct('STALKER', 150, 1500);
$notebook = new NoteBookProduct('Dell', 1000, 'Intel');


echo $book->getProduct();
echo $notebook->getProduct();