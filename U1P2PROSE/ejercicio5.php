<?php

    class superhero{
        private $name;
        private $superPower;

        //setter

        public function setName($name){
            $this -> name = $name;
        }

        public function setSuperPower($superPower){
            $this -> superPower = $superPower;
        }

        //getter

        public function getName(){
            return $this -> name;
        }

        public function getSuperPower(){
            return $this -> superPower;
        }


        function __construct( $name, $superPower) {
            $this -> name = $name;
            $this -> superPower = $superPower;
            print "Nuevo personaje: " . $name . "<br>";
        }

        function __destruct() {
            print "Adios " . $this->name . "\n";
        }

    }

    $prueba = new superhero( "superman", "can fly");

    

?>