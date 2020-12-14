<?php

//Un uso de ejemplo de una petición al servicio sería: GET .../ejemploRestSencillo/service/ejemploSencilloRESTful.php/personas

//Otro uso de ejemplo de una petición al servicio sería: GET .../ejemploRestSencillo/service/ejemploSencilloRESTful.php/personas/Poomfleir89

//Importamos la clase PersonDAOMock.php, la cual implementa JsonSerializable
require_once "../class/OfertaDAOMock.php";

$method = $_SERVER['REQUEST_METHOD'];//Obtenemos el metodo de la peticion
$acceptFormat = $_SERVER['HTTP_ACCEPT'];//Vemos que formatos acepta como respuesta
$path_info = getpathInfo();//Obtenemos el camino de la petición
$url_elements = explode('/', $path_info);//Vemos los elemetos de la url, para ver el servicio que se está solicitando
//Si la petición es con GET, acepta como respuesta JSON, y el servicio solictado es 'persona'
if (isMethodGet($method) && acceptFormatJson($acceptFormat) && isRequestForOfertas($url_elements)) {
    header('Content-Type: application/json');//La respuesta es un json
    $result =null;//Inicializamos lo que vamos a mostrar
    $dao=new OfertaDAOMock();
    if(isRequestForOfertasWithId($url_elements)){//Si la petición contiene un id en su path
        $id=$url_elements[2];
        $result=json_encode($dao->getOfertasPorId($id));
    }
    else{//Si no contiene un id en el path
        $result=json_encode($dao->getOfertas());
    }
    http_response_code(200);//Codigo para indicar Success
    echo $result;//Mostramos una array de objetos personas en Json
} else { //Petición no soportada
    http_response_code(400);//Codigo de error: Bad request
    header('Content-Type: text/html');//Mensaje en HTML
    echo "Vaya, se ha producido un error";//Mensaje visual
}


function isRequestForOfertas($url_elements)
{
    return $url_elements[1] === "oferta";
}

function isRequestForOfertasWithId($url_elements)
{
    return isset($url_elements[2]);
}



function isMethodGet($method)
{
    return $method === "GET";
}

function acceptFormatJson($acceptFormat)
{
    return ((strpos($acceptFormat, "application/json")!==FALSE) || (strpos($acceptFormat, "*/*")!==FALSE));
}

function getPathInfo()
{
    return !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
}