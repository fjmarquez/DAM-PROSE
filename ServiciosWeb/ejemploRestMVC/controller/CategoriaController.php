<?php

require_once "Controller.php";

class CategoriaController extends Controller{

    public function manageGetVerb(Request $request){
        $listaCategorias = null;
        $id = null;
        $response = null;
        $code = null;

        $categoriaHandler = new CategoriaHandlerModel();

        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
            //echo "ID".$id;
            $listaCategorias = $categoriaHandler->recuperarCategoria($id);
            //var_dump($listaCategorias);
        }else{
            //Recuperar todas las categorias
            $listaCategorias = $categoriaHandler->recuperarCategorias();
            //var_dump($listaCategorias);
        }

        if ($listaCategorias != null) {

            $code = '200';

        } else {

            $code = '400';

        }

        $response = new Response($code, null, $listaCategorias, $request->getAccept());
        $response->generate();

    }

}