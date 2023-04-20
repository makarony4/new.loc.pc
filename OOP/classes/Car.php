<?php
class Car{
 public $color;
 public $wheels = 4;
 public $speed = 180;
 var $brand;

 const TEST_CAR = 'Prototype';
 const TEST_CAR_SPEED = 300;

 public static $countCar = 0;





 public function getCarInfo(){
     return "<h3>About my car</h3>
Brand: {$this -> brand}<br>
Color: {$this ->color} <br>
Q-ty wheels: {$this->wheels}<br>
Speed: {$this ->speed}<br>
";
     }
    public function __construct($color, $wheels, $speed, $brand)
    {
        $this -> color = $color;
        $this -> brand = $brand;
        $this -> wheels = $wheels;
        $this -> speed = $speed;

        self::$countCar++;
    }

    public static function getCount(){
        return self::$countCar;
    }
    public function getProtoInfo(){
     return "<h3>About Test Car</h3>
Brand: " . self::TEST_CAR . "<br>
Speed: " . self::TEST_CAR_SPEED . "<br>
";
    }

    }