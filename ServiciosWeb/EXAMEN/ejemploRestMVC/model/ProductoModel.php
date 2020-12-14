<?php

    /*
     * Nombre de la clase: Producto
     *
     * Propiedades Básicas:
     *
     *      - ID -> int, Consultable
     *      - Name -> String, Consultable y Modificable
     *      - Stock -> int, Consultable y Modificable
     *      - Discount -> double, Consultable y Modificable
     *      - Prime -> boolean, Consultable y Modificable
     *      - Price -> int, Consultable y Modificable
     *      - ShortDescription -> String, Consultable y Modificable
     *      - LongDescription -> String, Consultable y Modificable
     *      - Image -> String, Consultable y Modificable
     *      - Category -> Category, Consultable y Modificable
     *
     * Propiedades Derivadas: No hay
     *
     * Propiedades Compartidas: No hay
     *
     * Métodos Añadidos: No hay
     */

class ProductoModel implements JsonSerializable{
    //Declaracion de los atributos de la clase
    private $ID;
    private $Name;
    private $Stock;
    private $Discount;
    private $Prime;
    private $Price;
    private $ShortDescription;
    private $LongDescription;
    private $Image;
    private $Category;
    private $Ratings;

    //Constructor
    function __construct($ID, $Name, $Stock, $Discount, $Prime, $Price, $ShortDescription, $LongDescription, $Image, $IDCategory) {
       $this -> ID = $ID;
       $this -> Name = $Name;
       $this -> Stock = $Stock;
       $this -> Discount = $Discount;
       $this -> Prime = $Prime;
       $this -> Price = $Price;
       $this -> ShortDescription = $ShortDescription;
       $this -> LongDescription = $LongDescription;
       $this -> Image = $Image;
       $this -> Category = $IDCategory;
   }

   public function resourcesID($id, $typeOfResource){
       return "http://localhost/prose/ServiciosWeb/ejemploRestMVC/index/".$typeOfResource."/".$id;
   }

   public function jsonSerialize()
   {
       return [
            "id" => $this->resourcesID($this->getID(), "producto"),
            "name" => $this-> Name,
            "stock" => $this-> Stock,
            "discount" => $this-> Discount,
            "prime" => $this-> Prime,
            "price" => $this-> Price,
            "shortDescription" => $this-> ShortDescription,
            "longDescription" => $this-> LongDescription,
            "image" => $this-> Image,
            "category" => $this->resourcesID($this->Category, "categoria"),
            

       ];
   }
   
    //Declaración de las propiedades de la clase
   
    public function getID()
    {
        return $this->ID;
    }

    public function setID($ID)
    {
        $this->ID = $ID;

        return $this;
    }

    public function getName()
    {
        return $this->Name;
    }

    public function setName($Name)
    {
        $this->Name = $Name;

        return $this;
    }

    public function getStock()
    {
        return $this->Stock;
    }

    public function setStock($Stock)
    {
        $this->Stock = $Stock;

        return $this;
    }

    public function getDiscount()
    {
        return $this->Discount;
    }

    public function setDiscount($Discount)
    {
        $this->Discount = $Discount;

        return $this;
    }

    public function getPrime()
    {
        return $this->Prime;
    }

    public function setPrime($Prime)
    {
        $this->Prime = $Prime;

        return $this;
    }

    public function getPrice()
    {
        return $this->Price;
    }

    public function setPrice($Price)
    {
        $this->Price = $Price;

        return $this;
    }

    public function getShortDescription()
    {
        return $this->ShortDescription;
    }

    public function setShortDescription($ShortDescription)
    {
        $this->ShortDescription = $ShortDescription;

        return $this;
    }

    public function getLongDescription()
    {
        return $this->LongDescription;
    }

    public function setLongDescription($LongDescription)
    {
        $this->LongDescription = $LongDescription;

        return $this;
    }

    public function getImage()
    {
        return $this->Image;
    }

    public function setImage($Image)
    {
        $this->Image = $Image;

        return $this;
    }

    public function getCategory(){
        return $this->Category;
    }

    public function setCategory($Category)
    {
        $this->Category = $Category;

        return $this;
    }

    public function getRatings(){
        return $this->Ratings;
    }

    public function setRatings($Ratings)
    {
        $this->Ratings = $Ratings;

        return $this;
    }
}

?>
