<?php
class product
{
    // Declaración de  propiedades
	
    private $price;
	private $name;
	private $brand;
	private $description;
	private $valoracion;
    
    //setters
    
    public function setPrice($price){
    	$this -> price = $price;
    }
    
    public function setName($name){
    	$this -> name = $name;
    }
    
    public function setBrand($brand){
    	$this -> brand = $brand;
    }
    
    public function setDescription($description){
    	$this -> description = $description;
    }
    
    public function setValoracion($valoracion){
    	$this -> valoracion = $valoracion;
    }
    
    //getters
    
    public function getPrice(){
    	return $this -> price;
    }
    
    public function getName(){
    	return $this -> name;
    }
    
    public function getBrand(){
    	return $this -> brand;
    }
    
    public function getDescription(){
    	return $this -> description;
    }
    
    public function getValoracion(){
    	$this -> valoracion;
    }

}


$prueba = new product();
$prueba -> setName("p1");
echo ($prueba -> getName());
?>
