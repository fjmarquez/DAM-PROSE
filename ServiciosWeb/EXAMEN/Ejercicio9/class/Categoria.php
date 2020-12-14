<?php

    /*
     * Nombre de la clase: Categoria
     *
     * Propiedades Básicas:
     *
     *      - ID -> int, Consultable
     *      - category -> String, Consultable y Modificable
     *
     * Propiedades Derivadas: No hay
     *
     * Propiedades Compartidas: No hay
     *
     * Métodos Añadidos: No hay
     */

    class Categoria implements JsonSerializable
    {
        //Declaración de los atributos de la clase
        private $ID;
        private $category;

        //Constructor
        public function __construct($ID, $category)
        {
            $this->ID = $ID;
            $this->category = $category;
        }

        

        public function jsonSerialize(){
            return[
                "ID" => $this -> ID,
                "Categoria" => $this ->category
            ];
        }

        //Declaración de las propiedades de la clase

        //ID
        public function getID()
        {
            return $this->ID;
        }

        public function getCategory()
        {
            return $this->category;
        }

        public function setCategory($category)
        {
            $this->category = $category;
        }
    }