<?php

require_once "ConsLibrosModel.php";


class LibroHandlerModel
{

    public static function cargarPersonajes ($listaLibros){

        $listaPersonajes = array();

        

        for($i = 0; $i < count($listaLibros) ; $i++)
        {
            $listaPersonajes = PersonajeHandlerModel::getPersonajesPorIDLibro($listaLibros[$i]->getCodigo());

                $listaLibros[$i]->setPersonajes($listaPersonajes);

        }

        //var_dump($listaLibros[0]);

        return $listaLibros;

    }


    public static function getLibro($id)
    {
        $listaLibros = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $valid = self::isValid($id);

        if ($valid === true || $id == null) {
            $query = "SELECT " . \ConstantesDB\ConsLibrosModel::COD . ","
                . \ConstantesDB\ConsLibrosModel::TITULO . ","
                . \ConstantesDB\ConsLibrosModel::PAGS . " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME;

            if ($id != null) {
                $query = $query . " WHERE " . \ConstantesDB\ConsLibrosModel::COD . " = ?";
            }

            $prep_query = $db_connection->prepare($query);

            if ($id != null) {
                $prep_query->bind_param('s', $id);
            }

            $prep_query->execute();
            $listaLibros = array();

            $prep_query->bind_result($cod, $tit, $pag);
            while ($prep_query->fetch()) {
                $tit = utf8_encode($tit);
                $libro = new LibroModel($cod, $tit, $pag);
                $listaLibros[] = $libro;
            }
        }
        $db_connection->close();

        $listaLibros = self::cargarPersonajes($listaLibros);
        

        return $listaLibros;
    }

    public static function getLibroPorNombre($queryString){

        //echo $queryString;

        $listaLibros = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();


        $query = "SELECT " . \ConstantesDB\ConsLibrosModel::COD . ","
            . \ConstantesDB\ConsLibrosModel::TITULO . ","
            . \ConstantesDB\ConsLibrosModel::PAGS . " FROM " . \ConstantesDB\ConsLibrosModel::TABLE_NAME
            . " WHERE " . \ConstantesDB\ConsLibrosModel::TITULO . " LIKE '%" . $queryString . "%'" ;

        //echo $query;

        $prep_query = $db_connection->prepare($query);

        $prep_query->execute();
        $listaLibros = array();

        $prep_query->bind_result($cod, $tit, $pag);

        while ($prep_query->fetch()) {
            $tit = utf8_encode($tit);
            $libro = new LibroModel($cod, $tit, $pag);
            $listaLibros[] = $libro;
        }
        
        $db_connection->close();

        $listaLibros = self::cargarPersonajes($listaLibros);
        
        return $listaLibros;

    }


    public static function isValid($id)
    {
        $res = false;

        if (ctype_digit($id)) {
            $res = true;
        }
        return $res;
    }

}