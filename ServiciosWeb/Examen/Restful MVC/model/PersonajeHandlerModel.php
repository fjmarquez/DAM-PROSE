<?php

require_once "ConsPersonajesModel.php";


class PersonajeHandlerModel
{

    public static function getPersonajesPorIDLibro($IDLibro)
    {
        /*
        //Devolvemos un array con los personajes del libro cuyo id hemos recibido por parametros.

        $listaPersonajes = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "SELECT ".\ConstantesDB\ConsPersonajesModel::ID . ", " . 
        \ConstantesDB\ConsPersonajesModel::LIBRO. ", " . 
        \ConstantesDB\ConsPersonajesModel::NOMBRE. ", " . 
        \ConstantesDB\ConsPersonajesModel::EDAD. " FROM " .
        \ConstantesDB\ConsPersonajesModel::TABLE_NAME. " WHERE " .
        \ConstantesDB\ConsPersonajesModel::LIBRO . " = " . $IDLibro;
        
        echo $query;

        $prep_query = $db_connection->prepare($query);

        $prep_query->execute();
        
        $listaPersonajes = array();

        $prep_query->bind_result($id, $libro, $nombre, $edad);
            while ($prep_query->fetch()) {
                //$tit = utf8_encode($tit);
                $personaje = new PersonajesModel($id, $libro, $nombre, $edad);
                $listaPersonajes[] = $personaje;
            }

        $db_connection->close();*/

        $p1 = new PersonajesModel();
        $p1->setID(2);
        $p1->setLibro(1);
        $p1->setNombre("Don Quijote de la Mancha");
        $p1->setEdad(50);

        $p2 = new PersonajesModel();
        $p2->setID(3);
        $p2->setLibro(1);
        $p2->setNombre("Sancho Panza");
        $p2->setEdad(null);

        $listaPersonajes = array($p1, $p2);

        //var_dump($listaPersonajes);

        return $listaPersonajes;

    }

    public static function getPersonajePorID($ID){
        //echo "getPersonajePorID";

        $listaPersonajes = null;

        $db = DatabaseModel::getInstance();
        $db_connection = $db->getConnection();

        $query = "SELECT ".\ConstantesDB\ConsPersonajesModel::ID . ", " . 
        \ConstantesDB\ConsPersonajesModel::LIBRO. ", " . 
        \ConstantesDB\ConsPersonajesModel::NOMBRE. ", " . 
        \ConstantesDB\ConsPersonajesModel::EDAD. " FROM " .
        \ConstantesDB\ConsPersonajesModel::TABLE_NAME. " WHERE " .
        \ConstantesDB\ConsPersonajesModel::ID . " = " . $ID;
        
        //echo $query;

        $prep_query = $db_connection->prepare($query);

        $prep_query->execute();
        
        $listaPersonajes = array();

        $prep_query->bind_result($id, $libro, $nombre, $edad);
            while ($prep_query->fetch()) {
                //$tit = utf8_encode($tit);
                $personaje = new PersonajesModel();
                $personaje->setID($id);
                $personaje->setLibro($libro);
                $personaje->setNombre($nombre);
                $personaje->setEdad($edad);
                $listaPersonajes[] = $personaje;
            }

        $db_connection->close();

        //var_dump($listaPersonajes);

        return $listaPersonajes;

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