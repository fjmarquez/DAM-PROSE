<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <title>Ejercicio 5</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
        <link rel="stylesheet" href="styles/style.css">
        <script
            src="https://code.jquery.com/jquery-3.5.1.min.js"
            integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0="
            crossorigin="anonymous">
        </script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js" 
                integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV" 
                crossorigin="anonymous">
        </script>
        
        
    </head>
    <body>
        <div class="container-fluid">
            <div class="row ">
            <h2 class="respuesta">

            </h2>
                <form id="form">
                    <div class="form-group col-md-3 ">
                        <label >Numero 1</label>
                        <input type="number" class="form-control" id="inputN1" name="n1" placeholder="Introduce un numero">
                    </div>
                    <div class="form-group col-md-3 ">
                        <label >Numero 2</label>
                        <input type="number" class="form-control" id="inputN2" name="n2" placeholder="Introduce un numero">
                    </div>
                    <div id="n3" class="form-group col-md-3 invisible">
                        <label >Numero 3</label>
                        <input type="number" class="form-control" id="inputN3" name="n3" placeholder="Introduce un numero">
                    </div>
                    <div id="n4" class="form-group col-md-3 invisible">
                        <label >Numero 4</label>
                        <input type="number" class="form-control" id="inputN4" name="n4" placeholder="Introduce un numero">
                    </div>
                    <div id="n5" class="form-group col-md-3 invisible">
                        <label >Numero 5</label>
                        <input type="number" class="form-control" id="inputN5" name="n5" placeholder="Introduce un numero">
                    </div>
                    <div id="n6" class="form-group col-md-3 invisible">
                        <label >Numero 6</label>
                        <input type="number" class="form-control" id="inputN6" name="n6" placeholder="Introduce un numero">
                    </div>
                    <div id="n7" class="form-group col-md-3 invisible">
                        <label >Numero 7</label>
                        <input type="number" class="form-control" id="inputN7" name="n7" placeholder="Introduce un numero">
                    </div>
                    <div id="n8" class="form-group col-md-3 invisible">
                        <label >Numero 8</label>
                        <input type="number" class="form-control" id="inputN8" name="n8" placeholder="Introduce un numero">
                    </div>
                    <div class="ops col-md-12 col-sm-12 col-xs-12">
                        <div class="form-group radio col-md-12 col-sm-12 col-xs-12">
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <label><input type="radio" name="op" value="+" required>Suma</label>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <label><input type="radio" name="op" value="-">Restar</label>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <label><input type="radio" name="op" value="*">Multiplicar</label>
                            </div>
                            <div class="col-md-3 col-sm-3 col-xs-3">
                                <label><input type="radio" name="op" value="/">Dividir</label>
                            </div>
                        </div>
                        <div class="form-group col-md-12 col-sm-12 col-xs-12">
                            <button type="button" id="agregar" class="btn btn-success col-md-12 col-sm-12 col-xs-12">Añadir campo</button>
                            <button disabled type="button" id="eliminar" class="btn btn-danger col-md-12 col-sm-12 col-xs-12">Eliminar campo</button>
                            <button type="button" id="enviar" class="btn btn-primary col-md-12 col-sm-12 col-xs-12">Enviar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

<script src="js/scripts.js" language="javascript" type="text/javascript"></script>
<script src="js/action.js" language="javascript" type="text/javascript"></script>