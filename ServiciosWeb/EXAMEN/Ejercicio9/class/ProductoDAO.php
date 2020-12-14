<?php

    require_once "DAO.php";
    require_once "Producto.php";
    require_once "CategoriaDAO.php";

    /*Clase Data Access Object para manipular la clase Usuario en una base de datos MySQL*/
    class ProductoDAO extends DAO{

        const SCHEMA="ProyectoFranciscoManuel";
        const NAME_TABLE="Products";

        /*
        *   Devuelve todos los productos que estan registrados en la base de datos
        */

        public function obtenerTodosLosProductos(){
            //Abrimos la conexion con la BD
            $this->openConection();
            //Definimos la consulta SQL
            $stmt = $this->conexion->prepare(
                "SELECT ID, Name, Stock, Discount, Prime, Price, Short_Description, Long_Description, Image, IDCategory FROM ". self::SCHEMA.".".self::NAME_TABLE
            );
            //Ejecutamos la consulta SQL
            $stmt->execute();
            //Recibimos los datos de la consulta
            $result = $stmt->get_result();
            //Parseamos los datos recibidos como un array de productos
            $products = $this->obtenerArrayProductos($result);
            //Cerramos la conexion
            $this->closeConection();
            //Devolvemos el array de Productos
            return $products;
        }

        /*
        *   Devuelve el producto cuyo ID sea igual al que pasamos a la funcion por parametros
        */

        public function obtenerProductoPorID($ID){
            //Abrimos la conexion
            $this->openConection();

            //Instanciamos un objeto CategoriaDAO
            $categoriaDAO = new CategoriaDAO();

            //Definimos la consulta SQL
            $stmt = $this->conexion->prepare(
                "SELECT Name, Stock, Discount, Prime, Price, Short_Description, Long_Description, Image, IDCategory FROM ". self::SCHEMA.".".self::NAME_TABLE.
                " WHERE ID = ?"
            );
            //Especificamos los parametros necesarios para la consulta
            $stmt->bind_param('i', $ID);
            //Ejecutamos la consulta SQL
            $stmt->execute();
            //Recibimos los datos de la consulta
            $result = $stmt->get_result();

            //Recuperamos el registro en un objeto Producto
            if($result->num_rows > 0)
            {
                //Obtenemos el registro
                $row = $result->fetch_assoc();

                $category = $categoriaDAO->recuperarCategoria($row['IDCategory']);

                $product = new Producto($ID,
                    $row["Name"],
                    $row["Stock"],
                    $row["Discount"],
                    $row["Prime"],
                    $row["Price"],
                    $row["Short_Description"],
                    $row["Long_Description"],
                    $row["Image"],
                    $category);
            }
            else
            {
                $product = false;
            }

            //Cerramos la conexion
            $this->closeConection();
            //Devolvemos el array con el Producto
            return $product;
        }

        /*
        *   Devuelve los productos pertenecientes a una categoria especificada mediante parametros
        */

        public function obtenerProductoPorCategoria($IDCategory){
            //Abrimos la conexion
            $this->openConection();
            //Definimos la consulta SQL
            $stmt = $this->conexion->prepare(
                "SELECT ID, Name, Stock, Discount, Prime, Price, Short_Description, Long_Description, Image, IDCategory FROM ". self::SCHEMA.".".self::NAME_TABLE.
                " WHERE IDCategory = ?"
            );
            //Especificamos los parametros necesarios para la consulta
            $stmt->bind_param('i', $IDCategory);
            //Ejecutamos la consulta SQL
            $stmt->execute();
            //Recibimos los datos de la consulta
            $result = $stmt->get_result();
            //Parseamos los datos recibidos como un array de productos
            $products = $this->obtenerArrayProductos($result);
            //Cerramos la conexion
            $this->closeConection();
            //Devolvemos el array con los productos
            return $products;
        }

        /*
        *   Devuelve los productos asociados al nombre pasado por parámetros
        */

        public function obtenerProductosPorNombre($nombreProducto){
            //Abrimos la conexion
            $this->openConection();
            //Definimos la consulta SQL
            $stmt = $this->conexion->prepare(
                "SELECT ID, Name, Stock, Discount, Prime, Price, Short_Description, Long_Description, Image, IDCategory FROM ". self::SCHEMA.".".self::NAME_TABLE.
                " WHERE Name LIKE '%".$nombreProducto."%'"
            );

            //Ejecutamos la consulta SQL
            $stmt->execute();
            //Recibimos los datos de la consulta
            $result = $stmt->get_result();
            //Parseamos los datos recibidos como un array de productos
            $products = $this->obtenerArrayProductos($result);
            //Cerramos la conexion
            $this->closeConection();
            //Devolvemos el array con los productos
            return $products;
        }

        /*
        *   Inserta un nuevo producto en la base de datos
        */

        public function insertarNuevoProducto($producto){
            //Abrimos la conexion
            $this->openConection();
            //Definimos la sentencia SQL
            $sql = 
            "INSERT INTO ".self::SCHEMA.".".self::NAME_TABLE.
            "(Name, Stock, Discount, Prime, Price,
             Short_Description, Long_Description, Image, IDCategory) 
             VALUES ('".$producto->getName()."', ".
             $producto->getStock().", ".$producto->getDiscount().", ".
             $producto->getPrime().", ".$producto->getPrice().", '".
             $producto->getShortDescription()."', '".$producto->getLongDescription()."', '".
             $producto->getImage()."', ".
             $producto->getCategory()->getID().")";
            //Preparamos la conexion y la consulta
            $stmt = $this->conexion->prepare($sql);
            //Realizamos el INSERT
            $stmt->execute();
            //Cerramos la conexion
            $this->closeConection();
            
        }

        /*
        *   Edita un producto existente con los nuevos valores indicados
        */

        public function editarProducto($product){
            //Abrimos la conexion
            $this->openConection();
            //Definimos la sentencia SQL
            $sql = "UPDATE ".self::SCHEMA.".".self::NAME_TABLE.
            " SET Name = '".$product->getName().
            "', Stock = ".$product->getStock().", Discount = ".$product->getDiscount().", Prime = ".
            $product->getPrime().", Price = ".$product->getPrice().", Short_Description = ''"
            .$product->getShortDescription().", Long_Description = '".$product->getLongDescription()."'
            , Image = '".$product->getImage()."', IDCategory = ".$product->getCategory()->getID().
            " WHERE ID = ".$product->getID();
            echo $product->getPrime();
            echo gettype($product->getPrime());
            //echo $sql;
            //Preparamos la conexion y la consulta
            $stmt = $this->conexion->prepare($sql);
            //Realizamos el UPDATE
            $stmt->execute();
            //Cerramos la conexion
            $this->closeConection();
            
        }

        /*
        *   Elimina un producto existente a partir del ID pasado por parámetros
        */

        public function eliminarProducto($IDProducto){
            //Abrimos la conexion
            $this->openConection();
            //Definimos la sentencia SQL
            $sql = "DELETE FROM ".self::SCHEMA.".".self::NAME_TABLE." WHERE ID = ".$IDProducto;
            //echo $sql;
            //Preparamos la conexion y la consulta
            $stmt = $this->conexion->prepare($sql);
            //Realizamos el UPDATE
            $stmt->execute();
            //Cerramos la conexion
            $this->closeConection();

        }


        /*
        *   Recibe un array de datos obtenidos en una consulta SQL y devuelve un array de Productos
        */

        private function obtenerArrayProductos($result){
            //Definimos el array de productos
            $products = array();

            //Instanciamos un objeto CategoriaDAO para recuperar la categoría
            $categoriaDAO = new CategoriaDAO();

            //Iteramos los resultados obtenidos en una consulta a la BD
            for ($i=0;$i<$result->num_rows;$i++){
                //Obtenemos el registro
                $row = $result->fetch_assoc();
                //var_dump($row);
                //Creamos el objeto producto y seteamos los valores

                $category = $categoriaDAO->recuperarCategoria($row['IDCategory']);

                $product = new Producto($row["ID"],
                                        $row["Name"],
                                        $row["Stock"],
                                        $row["Discount"],
                                        $row["Prime"],
                                        $row["Price"],
                                        $row["Short_Description"],
                                        $row["Long_Description"],
                                        $row["Image"],
                                        $category);
                //var_dump($product);
                //Guardamos el objeto product en el array
                $products[$i] = $product;
                //var_dump($products);
            }
            return $products;
        }
    

    }

    
?>