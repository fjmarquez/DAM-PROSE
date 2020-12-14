<?php

    require_once "DAO.php";
    require_once "Valoracion.php";
    require_once "ProductoDAO.php";
    require_once "UsuarioDAO.php";

    class ValoracionDAO extends DAO{

        const SCHEMA="ProyectoFranciscoManuel";
        const NAME_TABLE="Ratings";

        /*
        *   Devuelve las valoraciones correspondientes a un producto
        */

        public function obtenerValoracionesPorIDProducto($IDProduct){
            //Abrimos la conexion con la BD
            $this->openConection();
            //Definimos la consulta SQL
            $stmt = $this->conexion->prepare(
                "SELECT IDProduct, IDUser, Rating, Review FROM ".self::SCHEMA.".".self::NAME_TABLE.
                " WHERE IDProduct = ".$IDProduct
            );

            //Ejecutamos la consulta SQL
            $stmt->execute();
            //Recibimos los datos de la consulta
            $result = $stmt->get_result();
            //Parseamos los datos recibidos ccomo un array de Valoraciones
            $valoraciones = $this->obtenerArrayValoraciones($result);
            //Cerramos la conexion
            $this->closeConection();
            //Devolvemos el array con las valoraciones
            return $valoraciones;
        }

        /*
        *   Devuelve la valoración media correspondientes a un producto
        */
        public function obtenerValoracionMediaPorProducto($IDProduct){
            //Abrimos la conexion con la BD
            $this->openConection();
            //Definimos la consulta SQL
            $stmt = $this->conexion->query(
                "SELECT ".self::SCHEMA.".ValoracionMediaProducto(".$IDProduct.") AS Media"
            );

            //Recibimos los datos de la consulta
            $row = $stmt->fetch_assoc();

            $media = ($row["Media"]);

            //Cerramos la conexion
            $this->closeConection();
            //Devolvemos la media
            return $media;
        }

        public function obtenerArrayValoraciones($result){
            //Definimos el array de productos
            $valoraciones = array();

            //Instanciamos un objeto UsuarioDAO y ProductoDAO
            $usuarioDAO = new UserDAO();
            $productoDAO = new ProductoDAO();

            //Iteramos los resultados obtenidos en una consulta a la BD
            for ($i=0;$i<$result->num_rows;$i++){
                //Obtenemos el registro
                $row = $result->fetch_assoc();

                //Creamos el objeto producto y seteamos los valores
                $usuario = $usuarioDAO->recuperarUser($row["IDUser"]);
                //$newuser = new Usuario()
                $producto = $productoDAO->obtenerProductoPorID($row["IDProduct"]);
                

                $valoracion = new Valoracion(
                                             $row["Rating"],
                                             $row["Review"],
                                             $usuario,
                                             $producto);
                
                //Guardamos el objeto persona en la array
                $valoraciones[$i] = $valoracion;
            }
            return $valoraciones;
        }

        /*
        *   Inserta una nueva valoracion en la base de datos
        */

        public function insertarNuevaValoracion($valoracion){
            //Abrimos la conexion
            $this->openConection();
            //Definimos la sentencia SQL
            $sql = "INSERT INTO ".self::SCHEMA.".".self::NAME_TABLE.
                "(IDUser, IDProduct, Rating, Review) 
                VALUES (".$valoracion->getUser()->getID().", ".
                $valoracion->getProduct()->getID().", ".$valoracion->getRating().", '".
                $valoracion->getReview()."')";

            echo($sql);
            //Preparamos la conexion y la consulta
            $stmt = $this->conexion->prepare($sql);
            //Realizamos el INSERT
            $stmt->execute();
            //Cerramos la conexion
            $this->closeConection();

        }
    }

?>