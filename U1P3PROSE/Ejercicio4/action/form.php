<?php

include ("../classes/usuario.php");


$nombre = $_POST['nombre'];
$apellidos = $_POST['apellidos'];
$edad = $_POST['edad'];
$direccion = $_POST['direccion'];
$imagen = $_FILES['imagen'];
$_FILES['imagen']['name'] = $nombre . $apellidos . ".jpg";

$usuario = new usuario();

if ($usuario -> subirDatos($nombre, $apellidos, $edad, $direccion, $imagen)){



?>

<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <title>Ejercicio 4</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">
                <?php echo $_FILES['imagen']['name'] ?>
                <img height="200" width="200" src="../img/<?php echo $_FILES['imagen']['name']?>" />
                <h1> <?php echo $nombre . " " . $apellidos ?> </h1>
                <h3> <?php echo $direccion ?> </h3>
                <h3> <?php echo "Tienes " . $edad . " años"?> </h3>
            </div>
        </div>
    </body>
</html>


<?php

}

?>