<?php

require_once "Controller.php";


class PersonajeController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaPersonajes = null;
        $id = null;
        $response = null;
        $code = null;

        if (isset($request->getUrlElements()[2])) {
            $id = $request->getUrlElements()[2];
        }

        $listaPersonajes = PersonajeHandlerModel::getPersonajePorID($id);

        if ($listaPersonajes != null) {
            $code = '200';

        } else {

            if (PersonajeHandlerModel::isValid($id)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }

        //var_dump($listaPersonajes);

        $response = new Response($code, null, $listaPersonajes, $request->getAccept());
        $response->generate();
    }

}