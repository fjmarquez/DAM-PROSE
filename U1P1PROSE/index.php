<?php
setlocale(LC_ALL,"es_ES");

//dia de la semana actual en nº del 1-7
$DActual = date("N")-1;
//hora actual en formato hh:mm 24H
$HActual = date('h:i');

//asignaturas por dias
$DClases = [    [ "PDM", "PDM", "ADT", "EIE", "SGE", "SGE" ],
                [ "ADT", "PSP", "PDM", "PDM", "DIN", "DIN" ],
                [ "EIE", "ADT", "DIN", "DIN", "DIN", "PSP" ],
                [ "PDM", "PDM", "PDM", "SGE", "SGE", "EIE" ],
                [ "EIE", "PSP", "ADT", "ADT", "DIN", "DIN" ]
];


switch ($DClases[$DActual]){
    case ($HActual > '08:15' && $HActual < '09:15'):
        echo "<h1>".$DClases[$DActual][0]."</h1>";
    break;
    case ($HActual > '09:15' && $HActual < '10:15'):
        echo "<h1>".$DClases[$DActual][1]."</h1>";
    break;
    case ($HActual > '10:15' && $HActual < '11:15'):
        echo "<h1>".$DClases[$DActual][2]."</h1>";
    break;
    case ($HActual > '11:15' && $HActual < '11:45'):
        echo "<h1>RECREO</1>";
    break;
    case ($HActual > '11:45' && $HActual < '12:45'):
        echo "<h1>".$DClases[$DActual][3]."</h1>";
    break;
    case ($HActual > '12:45' && $HActual < '13:45'):
        echo "<h1>".$DClases[$DActual][4]."</h1>";
    break;
    case ($HActual > '13:45' && $HActual < '14:45'):
        echo "<h1>".$DClases[$DActual][5]."</h1>";
    break;
}

?>