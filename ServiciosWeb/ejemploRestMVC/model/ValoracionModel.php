<?php
/*
 * Nombre de la clase: Valoracion
 *
 * Propiedades Básicas:
 *
 *      - user -> User, Consultable
 *      - product -> Product, Consultable
 *      - rating -> double, Consultable y Modificable
 *      - review -> string, Consultable y Modificable
 *
 * Propiedades Derivadas: No hay
 *
 * Propiedades Compartidas: No hay
 *
 * Métodos Añadidos: No hay
 */
class ValoracionModel implements JsonSerializable{
    private $User;
    private $Product;
    private $Rating;
    private $Review;

    function __construct($User, $Product, $Rating, $Review)
    {
        $this -> User = $User;
        $this -> Product = $Product;
        $this -> Rating = $Rating;
        $this -> Review = $Review;
    }

    public function getUser()
    {
        return $this->User;
    }

    public function setUser($User)
    {
        $this->User = $User;

        return $this;
    }

    public function getProduct()
    {
        return $this->Product;
    }

    public function setProduct($Product)
    {
        $this->Product = $Product;

        return $this;
    }

    public function getRating()
    {
        return $this->Rating;
    }

    public function setRating($Rating)
    {
        $this->Rating = $Rating;

        return $this;
    }

    public function getReview()
    {
        return $this->Review;
    }

    public function setReview($Review)
    {
        $this->Review = $Review;

        return $this;
    }

    public function resourcesID($id, $typeOfResource){
        return "http://localhost/prose/ServiciosWeb/ejemploRestMVC/index/".$typeOfResource."/".$id;
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
            'User' => $this->User,
            'Product' => $this->resourcesID($this->Product, "producto"),
            'Rating' => $this->resourcesID($this->Rating, "valoracion"),
            'Review' => $this->Review
        );
    }

    public function __sleep(){
        return array('User' , 'Product' , 'Rating', 'Review');
    }
}



?>
