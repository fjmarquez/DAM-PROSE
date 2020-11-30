<?php
require_once "Oferta.php";
class OfertaDAOMock
{
//La presente clase, es una clase Mock, para la realización de pruebas

//Metodo Mock para obtener una array de personas en JSON
    function getOfertas()
    {
        //Creamos el primer objeto persona
        $o1 = new Oferta();
        $o1->setoferta("Pepe");
        $o1->setsector("Iglesias");
        $o1->setsalario(1000);
        //$o1->setidOferta($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'/ider25');
        $o1->setidOferta(1);

        //Creamos el segundo objeto persona
        $o2 = new Oferta();
        $o2->setoferta("Paco");
        $o2->setsector("Casado");
        $o2->setsalario(2000);
        //$o2->setidOferta($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'/ider26');
        $o2->setidOferta(2);

        //Creamos una array con ambos objetos
        $ofertas = array($o1, $o2);

        //Devolvemos el array
        return $ofertas;
    }

//Metodo Mock para obtener una array de personas en JSON
    function getOfertasPorId($id)
    {
        //Creamos un objeto persona con dicha información
        $o1 = new Oferta();
        $o1->setoferta("Lolo");
        $o1->setsector("Mantrana");
        $o1->setsalario(2500);
        //$o1->setidOferta($_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);//El id es la URI que lo representa
        $o1->setidOferta(0);

        return $o1;
    }
}