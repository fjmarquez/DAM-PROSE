<?php
    /*
     * Nombre de la clase: Usuario
     *
     * Propiedades Básicas:
     *
     *      - ID -> int, Consultable
     *      - name -> string, Consultable y modificable
     *      - mail -> String, Consultable y Modificable
     *      - password -> String, Consultable y Modificable
     *      - admin -> Boolean, Consultable y Modificable
     *
     * Propiedades Derivadas: No hay
     *
     * Propiedades Compartidas: No hay
     *
     * Métodos Añadidos: No hay
     */

    class Usuario
    {
        //Declaración de los atributos de la clase
        private $ID;
        private $name;
        private $mail;
        private $password;
        private $admin;

        //Constructor
        public function __construct($ID, $name, $mail, $password, $admin)
        {
            $this->ID = $ID;
            $this->name = $name;
            $this->mail = $mail;
            $this->password = $password;
            $this->admin = $admin;
        }

        //Declaración de las propiedades de la clase

        
        public function getID()
        {
            return $this->ID;
        }

        public function getName(){
            return $this->name;
        }

        public function setName($name){
            $this->name = $name;
        }

        public function getMail()
        {
            return $this->mail;
        }

        public function setMail($mail)
        {
            $this->mail = $mail;
        }

        public function getPassword()
        {
            return $this->password;
        }

        public function setPassword($password)
        {
            $this->password = $password;
        }

        public function getAdmin()
        {
            return $this->admin;
        }

        public function setAdmin($admin)
        {
            $this->admin = $admin;
        }
    }
