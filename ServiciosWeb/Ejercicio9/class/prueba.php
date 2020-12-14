<?php
require_once ("ValoracionDAO.php");
require_once ("Valoracion.php");

$vDAO = new ValoracionDAO();

$valoracion = $vDAO->obtenerValoracionesPorIDProducto(1)[0];

$valoracion->getProduct()->setID(4);

$vDAO->insertarNuevaValoracion($valoracion);

