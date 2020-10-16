<?php 

class edad{
    private $fechaNacimiento;

    function calcularEdad($fechaNacimiento){
        
        echo ("<p>Tienes " . (date("Y") - $fechaNacimiento) . " años</p>");
    }
}

?>

