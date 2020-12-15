<?php

require_once "Controller.php";


class LibroController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaLibros = null;
        $id = null;
        $response = null;
        $code = null;

        $queryString = $request->getQueryString();

        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
            $listaLibros = LibroHandlerModel::getLibro($id);
        }else if(isset($queryString['nombre'])){
            //echo $queryString['nombre'];
            $listaLibros = LibroHandlerModel::getLibroPorNombre($queryString['nombre']);
        }else{
            //si no hay un id en la url ni tampoco una query string se listaran todos los libros
            $listaLibros = LibroHandlerModel::getLibro($id);
        }


        if ($listaLibros != null) {
            $code = '200';

        } else {

            if (LibroHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }

        $response = new Response($code, null, $listaLibros, $request->getAccept());
        $response->generate();

    }

}