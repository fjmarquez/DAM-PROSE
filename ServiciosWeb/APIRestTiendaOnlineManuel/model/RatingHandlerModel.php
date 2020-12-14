<?php

require_once "ConsRatingsModel.php";

class RatingHandlerModel
{
    public static function getRating($product)
    {
        $listaRatings = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //var_dump($db);
        //var_dump($db_connection);
        //var_dump(isset($product));

        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like producto/2jfdsyfsd

        $product = strval($product);

        //var_dump($product);

        $valid = self::isValid($product);

        //If the $id is valid or the client asks for the collection ($id is null)
        if ($valid === true || $product == null) {

            $query = "SELECT " . \ConstantesDB\ConsRatingsModel::USER . ","
                . \ConstantesDB\ConsRatingsModel::PRODUCT . ","
                . \ConstantesDB\ConsRatingsModel::RATING . ","
                . \ConstantesDB\ConsRatingsModel::REVIEW . " FROM " . \ConstantesDB\ConsRatingsModel::TABLE_NAME
                . " WHERE " . \ConstantesDB\ConsRatingsModel::PRODUCT . " = ?";

            $prep_query = $db_connection->prepare($query);

            //var_dump($prep_query);

            //IMPORTANT: If we do not want to expose our primary keys in the URIS,
            //we can use a function to transform them.
            //For example, we can use hash_hmac:
            //http://php.net/manual/es/function.hash-hmac.php
            //In this example we expose primary keys considering pedagogical reasons

            if ($product != null) {
                $prep_query->bind_param('s', $product);
            }

            $prep_query->execute();
            $listaRatings = array();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($user, $product, $rating, $review);
            while ($prep_query->fetch()) {
                $review = utf8_encode($review);
                $rating = new RatingModel($user, $product, $rating, $review);
                $listaRatings[] = $rating;
            }
        }
        $db_connection->close();
        $db->closeConnection();

        return $listaRatings;
    }

    //returns true if $id is a valid id for a book
    //In this case, it will be valid if it only contains
    //numeric characters, even if this $id does not exist in
    // the table of books
    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }

        return $res;
    }
}