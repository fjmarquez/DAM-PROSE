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

    class CategoriaModel implements JsonSerializable
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

        public function resourcesID($id, $typeOfResource){
            return "http://localhost/prose/ServiciosWeb/ejemploRestMVC/index/".$typeOfResource."/".$id;
        }

        public function jsonSerialize(){
            return[
                "ID" => $this->resourcesID($this->getID(), "categoria"),
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