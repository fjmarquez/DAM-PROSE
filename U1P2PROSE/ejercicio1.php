<?php
class HelloWorld
{
    // Declaración de una propiedad
    private $isSpanish = true;

    // Declaración de un método
    function hello() {
    	if($this -> isSpanish == true){
        echo ("HolaMundo");
        }else{
        echo ("HelloWorld");
        }
    }
}

$prueba = new HelloWorld(); 
$prueba->hello();
?>
