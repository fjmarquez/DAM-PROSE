<?php
    require_once "DAO.php";
    require_once  "Categoria.php";

    /*Clase Data Access Object para manipular la clase Categoria en una base de datos MySQL*/
    class CategoriaDAO extends DAO
    {
        const SCHEMA="ProyectoFranciscoManuel";
        const NAME_TABLE="Categories";

        /*
         * Recuperar un registro de categoria por ID y devolver un objeto Categoria.
         */

        public function recuperarCategoria($IDCategory){

            //Abrimos la conexión
            $this->openConection();

            //Preparamos la consulta
            $stmt=$this->conexion->prepare(
                "SELECT Category FROM ".self::SCHEMA.".".self::NAME_TABLE.
                " WHERE ID = ?");

            //Añadimos los datos
            $stmt->bind_param('s', $IDCategory);

            //Ejecutamos la consulta y recogemos el resultado
            $stmt->execute();

            $result = $stmt->get_result();

            if($result->num_rows > 0)
            {
                $category = new Categoria($IDCategory, $result->fetch_assoc()["Category"]);
            }
            else
            {
                $category = false;
            }

            //Cerramos la conexión
            $this->closeConection();

            //Devolvemos el resultado
            return $category;
        }

        /*
        *   Devuelve todos los productos que estan registrados en la base de datos
        */

        public function obtenerTodasLasCategorias(){
            //Abrimos la conexion con la BD
            $this->openConection();
            //Definimos la consulta SQL
            $stmt = $this->conexion->prepare(
                "SELECT ID, Category FROM ". self::SCHEMA.".".self::NAME_TABLE
            );
            //Ejecutamos la consulta SQL
            $stmt->execute();
            //Recibimos los datos de la consulta
            $result = $stmt->get_result();
            //Parseamos los datos recibidos como un array de categorias
            $categories = $this->obtenerArrayCategorias($result); //TODO
            //Cerramos la conexion
            $this->closeConection();
            //Devolvemos el array de Categorias
            return $categories;
        }

        /*
        *   Recibe un array de datos obtenidos en una consulta SQL y devuelve un array de Categorias
        */

        private function obtenerArrayCategorias($result){
            //Definimos el array de productos
            $categories = array();

            //Iteramos los resultados obtenidos en una consulta a la BD
            for ($i=0;$i<$result->num_rows;$i++){
                //Obtenemos el registro
                $row = $result->fetch_assoc();
                //var_dump($row);
                //Creamos el objeto categoria y seteamos los valores

                $category = new Categoria($row["ID"],
                    $row["Category"]);
                //var_dump($product);
                //Guardamos el objeto category en el array
                $categories[$i] = $category;
                //var_dump($products);
            }
            return $categories;
        }
    }