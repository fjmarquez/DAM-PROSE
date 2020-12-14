<?php

require_once "ConsProductsModel.php";
require_once "RatingHandlerModel.php";
require_once "ProductoModel.php";


class ProductHandlerModel
{

    public static function getProduct($id)
    {
        $listaProductos = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like producto/2jfdsyfsd

        $valid = self::isValid($id);

        //If the $id is valid or the client asks for the collection ($id is null)
        if ($valid === true || $id == null) {

            $query = "SELECT " . \ConstantesDB\ConsProductsModel::ID . ","
                . \ConstantesDB\ConsProductsModel::NAME . ","
                . \ConstantesDB\ConsProductsModel::STOCK . ","
                . \ConstantesDB\ConsProductsModel::DISCOUNT . ","
                . \ConstantesDB\ConsProductsModel::PRIME . ","
                . \ConstantesDB\ConsProductsModel::PRICE . ","
                . \ConstantesDB\ConsProductsModel::SDESCRIPTION . ","
                . \ConstantesDB\ConsProductsModel::LDESCRIPTION . ","
                . \ConstantesDB\ConsProductsModel::IMAGE . ","
                . \ConstantesDB\ConsProductsModel::IDCATEGORY . " FROM " . \ConstantesDB\ConsProductsModel::TABLE_NAME;

            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsProductsModel::ID . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            //IMPORTANT: If we do not want to expose our primary keys in the URIS,
            //we can use a function to transform them.
            //For example, we can use hash_hmac:
            //http://php.net/manual/es/function.hash-hmac.php
            //In this example we expose primary keys considering pedagogical reasons

            if ($id != null) {
                $prep_query->bind_param('s', $id);
            }

            $prep_query->execute();
            $listaProductos = array();

            //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
            // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
            // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
            // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

            $prep_query->bind_result($ID, $name, $stock, $discount, $prime, $price, $sDescription, $lDescription, $image, $idCategory);
            while ($prep_query->fetch()) {
                $sDescription = utf8_encode($sDescription);
                $lDescription = utf8_encode($lDescription);
                $producto = new ProductoModel($ID, $name, $stock, $discount, $prime, $price, $sDescription, $lDescription, $image, $idCategory);
                $listaProductos[] = $producto;
            }

//            $result = $prep_query->get_result();
//            for ($i = 0; $row = $result->fetch_object(ProductoModel::class); $i++) {
//
//                $listaProductos[$i] = $row;
//            }
        }
        $db_connection->close();
        $db->closeConnection();

        $listaProductos = self::cargarRatings($listaProductos);

        return $listaProductos;
    }

    public static function insertarProducto($producto)
    {
        $productoInsertado = false;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "INSERT INTO " . \ConstantesDB\ConsProductsModel::TABLE_NAME . "("
            . \ConstantesDB\ConsProductsModel::NAME . ","
            . \ConstantesDB\ConsProductsModel::STOCK . ","
            . \ConstantesDB\ConsProductsModel::DISCOUNT . ","
            . \ConstantesDB\ConsProductsModel::PRIME . ","
            . \ConstantesDB\ConsProductsModel::PRICE . ","
            . \ConstantesDB\ConsProductsModel::SDESCRIPTION . ","
            . \ConstantesDB\ConsProductsModel::LDESCRIPTION . ","
            . \ConstantesDB\ConsProductsModel::IMAGE . ","
            . \ConstantesDB\ConsProductsModel::IDCATEGORY . ") "
            . "VALUES ('" . $producto -> getName() . "',"
            . $producto -> getStock() . ","
            . $producto -> getDiscount() . ","
            . $producto -> getPrime() . ","
            . $producto -> getPrice() . ",'"
            . $producto -> getShortDescription() . "','"
            . $producto -> getLongDescription() . "','"
            . $producto -> getImage() . "',"
            . $producto -> getCategory() . ")";


        $prep_query = $db_connection->prepare($query);

        $productoInsertado = $prep_query->execute();

        return $productoInsertado;
    }

    public static function cargarRatings($listaProductos){

        for($i = 0; $i < count($listaProductos) ; $i++)
        {
            $listaRatings = RatingHandlerModel::getRating($listaProductos[$i]->getID());

            if(count($listaRatings) > 0)
            {
                $listaProductos[$i]->setRatings($listaRatings);
            }

        }

        return $listaProductos;
    }

    public static function getProductByStock($stock)
    {
        $listaProductos = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "SELECT " . \ConstantesDB\ConsProductsModel::ID . ","
            . \ConstantesDB\ConsProductsModel::NAME . ","
            . \ConstantesDB\ConsProductsModel::STOCK . ","
            . \ConstantesDB\ConsProductsModel::DISCOUNT . ","
            . \ConstantesDB\ConsProductsModel::PRIME . ","
            . \ConstantesDB\ConsProductsModel::PRICE . ","
            . \ConstantesDB\ConsProductsModel::SDESCRIPTION . ","
            . \ConstantesDB\ConsProductsModel::LDESCRIPTION . ","
            . \ConstantesDB\ConsProductsModel::IMAGE . ","
            . \ConstantesDB\ConsProductsModel::IDCATEGORY . " FROM " . \ConstantesDB\ConsProductsModel::TABLE_NAME
            . " WHERE " . \ConstantesDB\ConsProductsModel::STOCK . " = ?";


        $prep_query = $db_connection->prepare($query);

        //IMPORTANT: If we do not want to expose our primary keys in the URIS,
        //we can use a function to transform them.
        //For example, we can use hash_hmac:
        //http://php.net/manual/es/function.hash-hmac.php
        //In this example we expose primary keys considering pedagogical reasons

        $prep_query->bind_param('s', $stock);

        $prep_query->execute();

        $listaProductos = array();

        //IMPORTANT: IN OUR SERVER, I COULD NOT USE EITHER GET_RESULT OR FETCH_OBJECT,
        // PHP VERSION WAS OK (5.4), AND MYSQLI INSTALLED.
        // PROBABLY THE PROBLEM IS THAT MYSQLND DRIVER IS NEEDED AND WAS NOT AVAILABLE IN THE SERVER:
        // http://stackoverflow.com/questions/10466530/mysqli-prepared-statement-unable-to-get-result

        $prep_query->bind_result($ID, $name, $stock, $discount, $prime, $price, $sDescription, $lDescription, $image, $idCategory);
        while ($prep_query->fetch()) {
            $sDescription = utf8_encode($sDescription);
            $lDescription = utf8_encode($lDescription);
            $producto = new ProductoModel($ID, $name, $stock, $discount, $prime, $price, $sDescription, $lDescription, $image, $idCategory);
            $listaProductos[] = $producto;
        }

        $db_connection->close();
        $db->closeConnection();

        return $listaProductos;
    }


    public static function deleteProduct($id)
    {
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //IMPORTANT: we have to be very careful about automatic data type conversions in MySQL.
        //For example, if we have a column named "cod", whose type is int, and execute this query:
        //SELECT * FROM table WHERE cod = "3yrtdf"
        //it will be converted into:
        //SELECT * FROM table WHERE cod = 3
        //That's the reason why I decided to create isValid method,
        //I had problems when the URI was like producto/2jfdsyfsd

        $valid = self::isValid($id);

        //If the $id is valid or the client asks for the collection ($id is null)
        if ($valid === true || $id == null) {

            $query = "DELETE FROM " . \ConstantesDB\ConsProductsModel::TABLE_NAME;

            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsProductsModel::ID . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            //IMPORTANT: If we do not want to expose our primary keys in the URIS,
            //we can use a function to transform them.
            //For example, we can use hash_hmac:
            //http://php.net/manual/es/function.hash-hmac.php
            //In this example we expose primary keys considering pedagogical reasons

            if ($id != null) {
                $prep_query->bind_param('s', $id);
            }

            $eliminado = $prep_query->execute();
        }
        $db_connection->close();
        $db->closeConnection();

        return $eliminado;
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