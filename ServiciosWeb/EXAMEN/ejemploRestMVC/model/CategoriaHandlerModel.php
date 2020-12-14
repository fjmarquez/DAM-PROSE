<?php

require_once "ConsCategoriasModel.php";

class CategoriaHandlerModel{

    public function recuperarCategoria($IDCategory){

        //Abrimos la conexion con la BD
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //Preparamos la consulta

        $query = "SELECT " .
        \ConstantesDB\ConsCategoriasModel::ID.", ".
        \ConstantesDB\ConsCategoriasModel::CATEGORY.
        " FROM ".
        \ConstantesDB\ConsCategoriasModel::TABLE_NAME." ".
        " WHERE ID = ?";

        //echo $query;

        //Ejecutamos la consulta y recogemos el resultado
        $prep_query = $db_connection->prepare($query);

        //bindeamos los parametros
        $prep_query->bind_param("s",$IDCategory);

        //var_dump($prep_query);

        //Ejecutamos la consulta SQL
        $prep_query->execute();

        $prep_query->bind_result($ID, $Category);
            while ($prep_query->fetch()) {
            $category = new CategoriaModel($ID, $Category);
            }

        //Cerramos la conexión
        $db_connection->close();

        //Devolvemos el resultado
        return $category;
    }


    public function recuperarCategorias(){

        //Abrimos la conexion con la BD
        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        //Preparamos la consulta

        $query = "SELECT " .
        \ConstantesDB\ConsCategoriasModel::ID.", ".
        \ConstantesDB\ConsCategoriasModel::CATEGORY.
        " FROM ".
        \ConstantesDB\ConsCategoriasModel::TABLE_NAME;

        //echo $query;

        //Ejecutamos la consulta y recogemos el resultado
        $prep_query = $db_connection->prepare($query);

        //var_dump($prep_query);

        //Ejecutamos la consulta SQL
        $prep_query->execute();

        $categories = array();

        $prep_query->bind_result($ID, $Category);
            while ($prep_query->fetch()) {
            $category = new CategoriaModel($ID, $Category);
            $categories[] = $category; 
            }

        //Cerramos la conexión
        $db_connection->close();

        //Devolvemos el resultado
        return $categories;
    }

}