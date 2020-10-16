<?php

    include ("../classes/test.php");

    $q1 = $_POST["q1"];
    $q2 = $_POST["q2"];
    $q3 = $_POST["q3"];

    $corregirTest = new test();

    $corregirTest -> corregirTest($q1, $q2, $q3);
    $corregirTest -> mostrarImg();



?>