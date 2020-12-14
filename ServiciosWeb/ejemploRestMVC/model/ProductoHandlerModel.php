<?php

require_once "ConsProductosModel.php";


class ProductoHandlerModel
{

    public static function cargarRatings($listaProductos){

        

        for($i = 0; $i < count($listaProductos) ; $i++)
        {
            $listaRatings = ValoracionHandlerModel::getRating($listaProductos[$i]->getID());

            $listaProductos[$i]->setRatings($listaRatings);

        }

    }


    public static function obtenerTodosLosProductos(){
        //Abrimos la conexion con la BD
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //Definimos la consulta SQL
        $query = "SELECT ". 
        \ConstantesDB\ConsProductosModel::ID.", ".
        \ConstantesDB\ConsProductosModel::NAME.", ".
        \ConstantesDB\ConsProductosModel::STOCK.", ". 
        \ConstantesDB\ConsProductosModel::DISCOUNT.", ".
        \ConstantesDB\ConsProductosModel::PRIME.", ".
        \ConstantesDB\ConsProductosModel::PRICE.", ". 
        \ConstantesDB\ConsProductosModel::SHORT.", ".
        \ConstantesDB\ConsProductosModel::LONG.", ".
        \ConstantesDB\ConsProductosModel::IMAGE.", ". 
        \ConstantesDB\ConsProductosModel::CATEGORY.
        " FROM " . \ConstantesDB\ConsProductosModel::TABLE_NAME;

        //echo $query;

        $prep_query = $db_connection->prepare($query);

        //Ejecutamos la consulta SQL
        $prep_query->execute();
        
        $products = array();

        $prep_query->bind_result($ID, $Name, $Stock, $Discount, $Prime, $Price, $ShortDescription, $LongDescription, $Image, $IDCategory);
            while ($prep_query->fetch()) {
                $product = new ProductoModel($ID, $Name, $Stock, $Discount, $Prime, $Price, $ShortDescription, $LongDescription, $Image, $IDCategory);
                $products[] = $product;
            }

        $db_connection->close();
        $db->closeConnection();
        //Devolvemos el array de Productos

        $products = self::cargarRatings($products);

        return $products;
    }

    public static function obtenerProductoPorID($IDProducto){
        //Abrimos la conexion con la BD
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //Definimos la consulta SQL
        $query = "SELECT ". 
        \ConstantesDB\ConsProductosModel::ID.", ".
        \ConstantesDB\ConsProductosModel::NAME.", ".
        \ConstantesDB\ConsProductosModel::STOCK.", ". 
        \ConstantesDB\ConsProductosModel::DISCOUNT.", ".
        \ConstantesDB\ConsProductosModel::PRIME.", ".
        \ConstantesDB\ConsProductosModel::PRICE.", ". 
        \ConstantesDB\ConsProductosModel::SHORT.", ".
        \ConstantesDB\ConsProductosModel::LONG.", ".
        \ConstantesDB\ConsProductosModel::IMAGE.", ". 
        \ConstantesDB\ConsProductosModel::CATEGORY.
        " FROM " . \ConstantesDB\ConsProductosModel::TABLE_NAME.
        " WHERE ID = ".$IDProducto;

        //echo $query;

        $prep_query = $db_connection->prepare($query);

        //Ejecutamos la consulta SQL
        $prep_query->execute();
        
        $products = array();

        $prep_query->bind_result($ID, $Name, $Stock, $Discount, $Prime, $Price, $ShortDescription, $LongDescription, $Image, $IDCategory);
            while ($prep_query->fetch()) {
                $product = new ProductoModel($ID, $Name, $Stock, $Discount, $Prime, $Price, $ShortDescription, $LongDescription, $Image, $IDCategory);
                $products[] = $product;
            }

        $db_connection->close();
        //Devolvemos el array de Productos
        return $products;
    }


    public static function obtenerProductoPorStock($Stock){
        //Abrimos la conexion con la BD
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //Definimos la consulta SQL
        $query = "SELECT ". 
        \ConstantesDB\ConsProductosModel::ID.", ".
        \ConstantesDB\ConsProductosModel::NAME.", ".
        \ConstantesDB\ConsProductosModel::STOCK.", ". 
        \ConstantesDB\ConsProductosModel::DISCOUNT.", ".
        \ConstantesDB\ConsProductosModel::PRIME.", ".
        \ConstantesDB\ConsProductosModel::PRICE.", ". 
        \ConstantesDB\ConsProductosModel::SHORT.", ".
        \ConstantesDB\ConsProductosModel::LONG.", ".
        \ConstantesDB\ConsProductosModel::IMAGE.", ". 
        \ConstantesDB\ConsProductosModel::CATEGORY.
        " FROM " . \ConstantesDB\ConsProductosModel::TABLE_NAME.
        " WHERE Stock = ".$Stock;

        //echo $query;

        $prep_query = $db_connection->prepare($query);

        //Ejecutamos la consulta SQL
        $prep_query->execute();
        
        $products = array();

        $prep_query->bind_result($ID, $Name, $Stock, $Discount, $Prime, $Price, $ShortDescription, $LongDescription, $Image, $IDCategory);
            while ($prep_query->fetch()) {
                $product = new ProductoModel($ID, $Name, $Stock, $Discount, $Prime, $Price, $ShortDescription, $LongDescription, $Image, $IDCategory);
                $products[] = $product;
            }

        $db_connection->close();
        //Devolvemos el array de Productos
        return $products;
    }


    public static function insertarProducto($producto){
        //Abrimos la conexion con la BD
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "INSERT INTO ". 
        \ConstantesDB\ConsProductosModel::TABLE_NAME." (".
        \ConstantesDB\ConsProductosModel::NAME.", ".
        \ConstantesDB\ConsProductosModel::STOCK.", ". 
        \ConstantesDB\ConsProductosModel::DISCOUNT.", ".
        \ConstantesDB\ConsProductosModel::PRIME.", ".
        \ConstantesDB\ConsProductosModel::PRICE.", ". 
        \ConstantesDB\ConsProductosModel::SHORT.", ".
        \ConstantesDB\ConsProductosModel::LONG.", ".
        \ConstantesDB\ConsProductosModel::IMAGE.", ". 
        \ConstantesDB\ConsProductosModel::CATEGORY.") VALUES ('". 
        $producto->getName()."', ".$producto->getStock().", ". 
        $producto->getDiscount().", ".$producto->getPrime().", ". 
        $producto->getPrice().", '".$producto->getShortDescription()."', '". 
        $producto->getLongDescription()."', '".$producto->getImage()."', ". 
        $producto->getCategory().")";

        //preparamos la consulta sql
        $prep_query = $db_connection->prepare($query);

        //Ejecutamos la consulta SQL
        $prep_query->execute();

        //cerramos la conexion con la bd
        $db_connection->close();
    }

    public static function actualizarProducto($producto){

        //Abrimos la conexion con la BD
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "UPDATE ". 
        \ConstantesDB\ConsProductosModel::TABLE_NAME." SET ". 
        \ConstantesDB\ConsProductosModel::NAME. " = '" . $producto->getName() . "', ".
        \ConstantesDB\ConsProductosModel::STOCK. " = " . $producto->getStock() . ", ".
        \ConstantesDB\ConsProductosModel::DISCOUNT. " = " . $producto->getDiscount() . ", ".
        \ConstantesDB\ConsProductosModel::PRIME. " = " . $producto->getPrime() . ", ".
        \ConstantesDB\ConsProductosModel::PRICE. " = " . $producto->getPrice() . ", ".
        \ConstantesDB\ConsProductosModel::SHORT. " = '" . $producto->getShortDescription() . "', ".
        \ConstantesDB\ConsProductosModel::LONG. " = '" . $producto->getLongDescription() . "', ".
        \ConstantesDB\ConsProductosModel::IMAGE. " = '" . $producto->getImage() . "', ".
        \ConstantesDB\ConsProductosModel::CATEGORY. " = " . $producto->getCategory() . " WHERE ID = ". $producto->getId();

        //echo $query;

        //preparamos la consulta sql
        $prep_query = $db_connection->prepare($query);

        //Ejecutamos la consulta SQL
        $prep_query->execute();

        //cerramos la conexion con la bd
        $db_connection->close();

    }


    /* $sql = "UPDATE ".self::SCHEMA.".".self::NAME_TABLE.
            " SET Name = '".$product->getName().
            "', Stock = ".$product->getStock().", Discount = ".$product->getDiscount().", Prime = ".
            $product->getPrime().", Price = ".$product->getPrice().", Short_Description = ''"
            .$product->getShortDescription().", Long_Description = '".$product->getLongDescription()."'
            , Image = '".$product->getImage()."', IDCategory = ".$product->getCategory()->getID().
            " WHERE ID = ".$product->getID(); */

    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }

}