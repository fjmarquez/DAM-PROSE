<?php
require_once "Person.php";
class PersonDAOMock
{
//La presente clase, es una clase Mock, para la realización de pruebas

//Metodo Mock para obtener una array de personas en JSON
    function getPersons()
    {
        //Creamos el primer objeto persona
        $p1 = new Person();
        $p1->setName("Pepe");
        $p1->setSurname("Iglesias");
        $p1->setIdPerson($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'/ider25');

        //Creamos el segundo objeto persona
        $p2 = new Person();
        $p2->setName("Paco");
        $p2->setSurname("Casado");
        $p2->setIdPerson($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'/ider26');

        //Creamos una array con ambos objetos
        $persons = array($p1, $p2);

        //Devolvemos el array
        return $persons;
    }

//Metodo Mock para obtener una array de personas en JSON
    function getPersonWithId($id)
    {
        //Creamos un objeto persona con dicha información
        $p1 = new Person();
        $p1->setName("Lolo");
        $p1->setSurname("Mantrana");
        $p1->setAge(20);
        $p1->setIdPerson($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);//El id es la URI
        // que lo representa

        return $p1;
    }
}