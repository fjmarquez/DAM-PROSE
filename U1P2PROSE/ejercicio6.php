<?php

class square{
    private $height;
    private $weight;

    public function set_height( $height ){
        $this -> height = $height;
    }

    public function set_weight( $weight ){
        $this -> weight = $weight;
    }

    public function get_height (){
        return $this -> height;
    }

    public function get_weight (){
        return $this -> weight;
    }

    public function get_area(){
        echo $this -> height * $this -> weight;
        return $this -> height * $this -> weight;
    }

    public function print_square($color, $x, $y){

        echo "<div style='width:" . $x . " ;height:"  . $y  . ";background:"  . $color . "'></div>";

    }

    /*
    
      +set_height( height: int)
     +set_width( height: int)
     +get_height(): int
     +get_width() : int
     +get_area() : int
     +print_square(color : str, x : int , y : int)


    */
}

$prueba = new square();
$prueba -> set_height(10);
$prueba -> set_weight(10);
$prueba -> get_area();
$prueba -> print_square("red", 50, 100);
$prueba -> print_square("green", 100, 50);

?>