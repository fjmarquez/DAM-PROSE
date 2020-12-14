<?php

require_once "Controller.php";

class ProductoController extends Controller{

    public function manageGetVerb(Request $request){

        $listaProductos = null;
        $id = null;
        $response = null;
        $code = null;

        $queryString = $request->getQueryString();

        //var_dump($queryString);

        $productosHandler = new ProductoHandlerModel();


        
        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
            //echo "ID".$id;
            $listaProductos = $productosHandler->obtenerProductoPorID($id);
        }else if (isset($queryString['stock'])){

            $Stock = $queryString['stock'];
            //echo $Stock;
            $listaProductos = $productosHandler->obtenerProductoPorStock($Stock);

        }else{
            //Recuperar todas las categorias
            //echo "Todo";
            $listaProductos = $productosHandler->obtenerTodosLosProductos();
        }
        
        
        
        
        


        

        if ($listaProductos != null) {
            $code = '200';

        } else {

            $code = '400';

        }

        $response = new Response($code, null, $listaProductos, $request->getAccept());
        $response->generate();

    }


    /*
    [{
        "name": "Nuevo Producto PUT 1.1",
        "stock": 2,
        "discount": 0.5,
        "prime": 1,
        "price": "79.00",
        "shortDescription": "descripcion corta",
        "longDescription": "descripcion larga",
        "image": "../img/Monitores/MSI_Optix_34.jpg",
        "category": "3"
    }] 
    */
    public function managePostVerb(Request $request)
    {
        //echo "POST Producto\n";
        $response = null;
        $code = null;

        $body = $request->getBodyParameters();

        $productosHandler = new ProductoHandlerModel();

        if(count($body) > 0){
            for($i=0; $i < count($body); $i++){
                $productoPOST = new ProductoModel(0,$body[$i]->name, $body[$i]->stock, $body[$i]->discount,
                                              $body[$i]->prime, $body[$i]->price,
                                              $body[$i]->shortDescription, $body[$i]->longDescription, 
                                              $body[$i]->image, $body[$i]->category);
                
                $productosHandler->insertarProducto($productoPOST);
            }
        }else if (count($body) == 0){
            $code = '200';
        }else{
            $code = '400';
        }

        $response = new Response($code, null, $body, $request->getAccept());
        $response->generate();

    }

    /*
    [{
        "id" : 1,
        "name": "Nuevo Producto PUT 1.1",
        "stock": 2,
        "discount": 0.5,
        "prime": 1,
        "price": "79.00",
        "shortDescription": "descripcion corta",
        "longDescription": "descripcion larga",
        "image": "../img/Monitores/MSI_Optix_34.jpg",
        "category": "3"
    }] 
    */
    public function managePutVerb(Request $request){
        //echo "PUT Productos";
        $response = null;
        $code = null;

        $body = $request->getBodyParameters();

        $productosHandler = new ProductoHandlerModel();

        if(count($body) > 0){
            for($i=0; $i < count($body); $i++){
                $productoPUT = new ProductoModel($body[$i]->id,$body[$i]->name, $body[$i]->stock, $body[$i]->discount,
                                              $body[$i]->prime, $body[$i]->price,
                                              $body[$i]->shortDescription, $body[$i]->longDescription, 
                                              $body[$i]->image, $body[$i]->category);
                
                $productosHandler->actualizarProducto($productoPUT);
            }
        }else if (count($body) == 0){
            $code = '200';
        }else{
            $code = '400';
        }

        $response = new Response($code, null, $body, $request->getAccept());
        $response->generate();

    }

}