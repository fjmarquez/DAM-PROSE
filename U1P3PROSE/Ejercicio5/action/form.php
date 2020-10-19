<?php


//Array con valores
$numeros = $_REQUEST['n'];

$resultado = 0;

    
$resultado = eval('return '.$numeros.';');
echo $resultado;
$resultado = "";


?>