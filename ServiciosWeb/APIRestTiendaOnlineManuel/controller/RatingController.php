<?php

require_once "Controller.php";

class RatingController extends Controller
{
    public function manageGetVerb(Request $request)
    {

        $listaRatings = null;
        $product = null;

        $product = $request->getUrlElements()[2];

        $listaRatings = RatingHandlerModel::getRating($product);

        if ($listaRatings != null) {
            $code = '200';

        } else {

            //We could send 404 in any case, but if we want more precission,
            //we can send 400 if the syntax of the entity was incorrect...
            if (RatingHandlerModel::isValid($product)) {
                $code = '404';
            } else {
                $code = '400';
            }

        }

        $response = new Response($code, null, $listaRatings, $request->getAccept());
        $response->generate();

    }
}