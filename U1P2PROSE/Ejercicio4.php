<?php

class utilities{
    

    public function count($str , $sbStr){
        echo (substr_count($str,$sbStr) . " coincidencias" . "<br>");
    }

    public function position($str, $sbStr){
        echo (strrpos($str, $sbStr) . " ultima posicion");
    }
}


$prueba = new utilities();

$prueba -> count("Hola buenos dias Hola", "Hola");
$prueba -> position("Hola buenos dias Hola", "Hola");

?>