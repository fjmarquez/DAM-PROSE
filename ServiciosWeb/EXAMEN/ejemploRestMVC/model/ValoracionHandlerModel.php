<?php

require_once "ConsValoracionesModel.php";

class ValoracionHandlerModel
{
    public static function getRating($IDProduct)
    {
        $listaRatings = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "SELECT " . \ConstantesDB\ConsValoracionesModel::USER . ", "
            . \ConstantesDB\ConsValoracionesModel::PRODUCT . ", "
            . \ConstantesDB\ConsValoracionesModel::RATING . ", "
            . \ConstantesDB\ConsValoracionesModel::REVIEW . " FROM " . \ConstantesDB\ConsValoracionesModel::TABLE_NAME
            . " WHERE " . \ConstantesDB\ConsValoracionesModel::PRODUCT . " = " . $IDProduct;

        $prep_query = $db_connection->prepare($query);

        $prep_query->execute();
        $listaRatings = array();

        $prep_query->bind_result($user, $product, $rating, $review);
        while ($prep_query->fetch()) {
            $review = utf8_encode($review);
            $rating = new ValoracionModel($user, $product, $rating, $review);
            $listaRatings[] = $rating;
        }
        
        $db_connection->close();
        //$db->closeConnection();

        return $listaRatings;
    }
}