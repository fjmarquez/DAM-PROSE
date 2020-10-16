
<?php 

class fecha {
    private $edad;

    //Resta el año actual a la edad, para calcular la fecha de nacimiento
    function calcularFechaNacimiento($edad){
        
        echo ("<p>Naciste en " . (date("Y") - $edad) . "</p>") ; 

        }

}
?>