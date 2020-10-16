<html>
    <head>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    </head>
    <body>
        <div class="container">
            <div class="row">

                <form action="./action/form.php" method="post">
                    <div class="form-group">
                        <label>Empecemos por el principio: ¿Sabes cuáles fueron los primeros "vegetales" que existieron en nuestro planeta?</label>
                        <div class="radio">
                            <label><input type="radio" name="q1" value="1" >Los helechos</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="q1" value="2">Las microalgas unicelulares marinas</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="q1" value="3">Los musgos</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Ya sabemos cómo surgieron los vegetales, pero ¿sabrías decir cuál de estos elementos son comunes a todas las plantas?</label>
                        <div class="radio">
                            <label><input type="radio" name="q2" value="1">Las paredes de sus celulas estan compuestas de celulosa</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="q2" value="2">Obtienen su energia del sol</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="q2" value="3">Todas las opciones son correctas</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Lo hemos dicho un par de veces y para la mayoría de las personas resultará más que evidente: las plantas obtienen su energía a partir del Sol, pero ¿sabrías cuál es el nombre que recibe este proceso?</label>
                        <div class="radio">
                            <label><input type="radio" name="q3" value="1">Quimiosintesis</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="q3" value="2">Fotosintesis</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="q3" value="3">Metabolismo de luz</label>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar</button>
                </form>
        </div>
            </div>
    </body>
</html>