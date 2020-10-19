<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <title>Ejercicio 4</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">

                <form action="./action/form.php" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="inputNombre">Nombre</label>
                        <input type="text" class="form-control" id="inputNombre" name="nombre" placeholder="Introduce tu nombre">
                    </div>
                    <div class="form-group">
                        <label for="inputApellidos">Apellidos</label>
                        <input type="text" class="form-control" id="inputApellidos" name="apellidos" placeholder="Introduce tus apellidos">
                    </div>
                    <div class="form-group">
                        <label for="inputDireccion">Direccion</label>
                        <input type="text" class="form-control" id="inputDireccion" name="direccion" placeholder="Introduce tu direccion">
                    </div>
                    <div class="form-group">
                        <label for="inputEdad">Edad</label>
                        <input type="number" class="form-control" id="inputEdad" name="edad" placeholder="Introduce tu fecha de nacimiento">
                    </div>
                    <div class="form-group">
                        <label for="inputArchivo">Edad</label>
                        <input type="file" class="form-control" id="inputArchivo" name="imagen" >
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
        </div>
            </div>
    </body>
</html>