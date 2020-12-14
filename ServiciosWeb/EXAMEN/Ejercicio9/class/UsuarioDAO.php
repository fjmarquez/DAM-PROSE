<?php

    require_once "DAO.php";
    require_once  "Usuario.php";

    /*Clase Data Access Object para manipular la clase User en una base de datos MySQL*/
    class UserDAO extends DAO
    {
        const SCHEMA="ProyectoFranciscoManuel";
        const NAME_TABLE="Users";

        /*
         * Comprobar si existe un registro de user con el name y la contraseña pasada por parámetros.
         * Si existe el registro, se devolverá el ID del user, en caso contrario devolverá false.
         */

        public function esUserRegistrado($mail, $password){

            //Abrimos la conexión   
            $this->openConection();

            $sql = "SELECT ID FROM ".self::SCHEMA.".".self::NAME_TABLE.
            " WHERE Mail = ? AND Password = ?";

            //Preparamos la consulta
            $stmt=$this->conexion->prepare($sql);
            
            //Añadimos los datos
            $stmt->bind_param('ss', $mail, $password);
            
            //Ejecutamos la consulta y recogemos el resultado
            $stmt->execute();
            
            $result = $stmt->get_result();
            
            if($result->num_rows > 0)
            {
                $user = $this->recuperarUser($result->fetch_assoc()["ID"]);
                
            }
            else
            {
                $user = false;
            }

            //Cerramos la conexión
            $this->closeConection();

            //Devolvemos el resultado
            return $user;
        }

        /*
         * Recuperar un registro de user por ID y devolver un objeto User.
         */

        public function recuperarUser($IDUser){

            //Abrimos la conexión
            $this->openConection();

            $sql = "SELECT Name, Mail, Password, Admin FROM ".self::SCHEMA.".".self::NAME_TABLE.
            " WHERE ID = ?";

            //Preparamos la consulta
            $stmt=$this->conexion->prepare($sql);

            //Añadimos los datos
            $stmt->bind_param('i', $IDUser);

            //Ejecutamos la consulta y recogemos el resultado
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows > 0)
            {
                //Obtenemos el registro
                $row = $result->fetch_assoc();

                $user = new Usuario($IDUser,
                                       $row["Name"],
                                       $row["Mail"],
                                       $row["Password"],
                                       $row["Admin"]);
            }
            else
            {
                $user = false;
            }

            //Cerramos la conexión
            $this->closeConection();

            //Devolvemos el resultado
            return $user;
        }

        //Inserta un objeto de la clase persona en la BD
        public function insertarUser($user){

            $sql="INSERT INTO ".self::SCHEMA.".".self::NAME_TABLE.
                " (Mail, Password, Name, Admin) VALUES ('".$user->getMail()."', '".$user->getPassword()."', '".$user->getName()."','".$user->getAdmin()."')";

            parent::query($sql);
        }

    }