<?php

//Un uso de ejemplo de una petición al servicio sería: GET .../ejemploRestSencillo/service/ejemploSencilloRESTful.php/personas

//Otro uso de ejemplo de una petición al servicio sería: GET .../ejemploRestSencillo/service/ejemploSencilloRESTful.php/personas/Poomfleir89

require_once "../class/ProductoDAO.php";
require_once "../class/Producto.php";



$method = $_SERVER['REQUEST_METHOD'];//Obtenemos el metodo de la peticion
$acceptFormat = $_SERVER['HTTP_ACCEPT'];//Vemos que formatos acepta como respuesta
$path_info = getpathInfo();//Obtenemos el camino de la petición
$url_elements = explode('/', $path_info);//Vemos los elemetos de la url, para ver el servicio que se está solicitando
/*

//Si la petición es con DELETE, acepta como respuesta JSON, y el servicio solictado es 'producto'
if (isMethodDelete($method) && acceptFormatJson($acceptFormat) && isRequestForProducto($url_elements)) {
    header('Content-Type: application/json');//La respuesta es un json
    $result =null;//Inicializamos lo que vamos a mostrar
    $dao=new ProductoDAO();
    if(isRequestForProductoConId($url_elements)){//Si la petición contiene un id en su path
        $id=$url_elements[2];
        $result=json_encode($dao->eliminarProducto($id));
        echo "Eliminado correctamente el producto con id " . $id ;
    }
    else{//Si no contiene un id en el path
        //$result=json_encode($dao->eliminarTodosLosProductos()); //la funcion no ha sido implementada
        echo "Se han elimiando todos los productos correctamente";
    }
    http_response_code(200);//Codigo para indicar Success
   
} else { //Petición no soportada
    http_response_code(400);//Codigo de error: Bad request
    header('Content-Type: text/html');//Mensaje en HTML
    //echo "Se ha producido un error (DELETE)";//Mensaje visual
}
*/
//Si la petición es con GET, acepta como respuesta JSON, y el servicio solictado es 'persona'
if (isMethodGet($method) /*&& acceptFormatJson($acceptFormat)*/ && isRequestForProducto($url_elements)) {
    header('Content-Type: application/json');//La respuesta es un json
    $result =null;//Inicializamos lo que vamos a mostrar
    $dao=new ProductoDAO();
    if(isRequestForProductoConId($url_elements)){//Si la petición contiene un id en su path
        $id=$url_elements[2];
        $result=json_encode($dao->obtenerProductoPorID($id));
        
    }
    else{//Si no contiene un id en el path
        $result=json_encode($dao->obtenerTodosLosProductos());
        
    }
    echo utf8_encode($result);
    //var_dump($result);
    http_response_code(200);//Codigo para indicar Success
    
   
} else { //Petición no soportada
    http_response_code(400);//Codigo de error: Bad request
    header('Content-Type: text/html');//Mensaje en HTML
    echo "Se ha producido un error (GET)";//Mensaje visual
}


function isRequestForProducto($url_elements)
{
    return $url_elements[1] === "producto";
}

function isRequestForProductoConId($url_elements)
{
    return isset($url_elements[2]);
}



function isMethodDelete($method)
{
    return $method === "DELETE";
}

function isMethodGet($method)
{
    return $method === "GET";
}

function acceptFormatJson($acceptFormat)
{
    return (strpos($acceptFormat, "application/json") || (strpos($acceptFormat, "*/*")));
}

function getPathInfo()
{
    return !empty($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : (!empty($_SERVER['ORIG_PATH_INFO']) ? $_SERVER['ORIG_PATH_INFO'] : '');
}