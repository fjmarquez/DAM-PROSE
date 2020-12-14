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
class ProductoModel implements JsonSerializable
{

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



    /**
     * Specify data which should be serialized to JSON
     * @link http://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */

    //Needed if the properties of the class are private.
    //Otherwise json_encode will encode blank objects
    function jsonSerialize()
    {
        return array(
            'ID' => $_SERVER['HTTP_HOST'].'/APIRestTiendaOnline/index.php/Product/'.$this->ID,
            'Nombre' => $this->Name,
            'Stock' => $this->Stock,
            'Discount' => $this->Discount,
            'Prime' => $this->Prime,
            'Price' => $this->Price,
            'Short_Description' => $this->ShortDescription,
            'Long_Description' => $this->LongDescription,
            'Image' => $this->Image,
            'Category' => $_SERVER['HTTP_HOST'].'/APIRestTinedaOnline/Category/'.$this->Category,
            'Rating' => array_map(function (RatingModel $rating) {return $rating->resourceID();}, $this->Ratings)
        );
    }

    public function __sleep(){
        return array('ID' , 'Nombre' , 'Stock', 'Discount', 'Prime', 'Price', 'Short_Description', 'Long_Description', 'Image', 'IDCategory' );
    }

}