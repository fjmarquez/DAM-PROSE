<?php
//header('Content-Type: application/json');//La respuesta es un JSON
$fecha = [
    "day" => getdate()["mday"],
    "month" => getdate()["month"],
    "year" => getdate()["year"]
];


echo json_encode($fecha);//Mostramos la array como un JSON
//NOTA: Este servicio no cumple REST.
