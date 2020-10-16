<?php

include ("../classes/fecha.php");

$edad = $_POST["edad"];

$f1 = new fecha();
$f1 -> calcularFechaNacimiento($edad);

?>