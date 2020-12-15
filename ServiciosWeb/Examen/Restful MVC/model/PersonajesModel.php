<?php


class PersonajesModel implements JsonSerializable
{
    private $ID;
    private $Libro;
    private $Nombre;
    private $Edad;




    function jsonSerialize()
    {
        return array(
            'id' => $this->ID,
            'libro' => $this->Libro,
            'nombre' => $this->Nombre,
            'edad' => $this->Edad
        );
    }


    //Getters

    public function getId()
    {
        return $this->ID;
    }

    public function getLibro()
    {
        return $this->Libro;
    }
    
    public function getNombre()
    {
        return $this->Nombre;
    }

    public function getEdad()
    {
        return $this->Edad;
    }

    //SETTERS

    public function setID($ID)
    {
        $this->ID = $ID;
    }
    
    public function setLibro($Libro)
    {
        $this->Libro = $Libro;
    }

    public function setNombre($Nombre)
    {
        $this->Nombre = $Nombre;
    }

    public function setEdad($Edad)
    {
        $this->Edad = $Edad;
    }

}