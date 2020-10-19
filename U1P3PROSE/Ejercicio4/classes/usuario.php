<?php

class usuario{

    private $nombre;
    private $apellidos;
    private $edad;
    private $direccion;
    private $imagen;
    
    function subirDatos($nombre, $apellidos, $edad, $direccion, $imagen){
        $this -> nombre = $_POST['nombre'];
        $this ->apellidos = $_POST['apellidos'];
        $this ->edad = $_POST['edad'];
        $this ->direccion = $_POST['direccion'];
        $this ->imagen = $_FILES['imagen'];
    
        //subida img
        $ruta_indexphp = dirname(realpath(__FILE__));
        $ruta_fichero_origen = $_FILES['imagen']['tmp_name'];
        $ruta_nuevo_destino = $ruta_indexphp . '/../img/' . $_FILES['imagen']['name'];
        move_uploaded_file ( $ruta_fichero_origen, $ruta_nuevo_destino );

        return true;
    }

}



?>