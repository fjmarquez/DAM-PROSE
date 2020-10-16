<?php

include ("../classes/edad.php");

$fechaNacimiento = $_GET["fechaNacimiento"];

$e1 =  new edad();
$e1 -> calcularEdad($fechaNacimiento);

?>