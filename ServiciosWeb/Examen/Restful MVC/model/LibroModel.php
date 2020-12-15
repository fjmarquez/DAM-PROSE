<?php


class LibroModel implements JsonSerializable
{
    private $titulo;
    private $codigo;
    private $numpag;
    private $personajes;

    public function __construct($cod,$tit,$pag)
    {
        $this->codigo=$cod;
        $this->titulo=$tit;
        $this->numpag=$pag;
    }

    public function resourcesID($id, $typeOfResource){
        return "http://localhost/prose/Restful%20MVC/index/".$typeOfResource."/".$id;
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
            'titulo' => $this->titulo,
            'codigo' => $this->codigo,
            'numpag' => $this->numpag,
            'personajes' => array_map(function (PersonajesModel $personaje) {return $this->resourcesID($personaje->getId(), "personaje");}, $this->personajes)
        );
    }

    public function __sleep(){
        return array('titulo' , 'codigo' , 'numpag' );
    }


    /**
     * @return mixed
     */
    public function getTitulo()
    {
        return $this->titulo;
    }

    /**
     * @param mixed $titulo
     */
    public function setTitulo($titulo)
    {
        $this->titulo = $titulo;
    }

    /**
     * @return mixed
     */
    public function getCodigo()
    {
        return $this->codigo;
    }

    /**
     * @param mixed $codigo
     */
    public function setCodigo($codigo)
    {
        $this->codigo = $codigo;
    }

    /**
     * @return mixed
     */
    public function getNumpag()
    {
        return $this->numpag;
    }

    /**
     * @param mixed $numpag
     */
    public function setNumpag($numpag)
    {
        $this->numpag = $numpag;
    }

        /**
     * @return mixed
     */
    public function getPersonajes()
    {
        return $this->personajes;
    }

    /**
     * @param mixed $numpag
     */
    public function setPersonajes($personajes)
    {
        $this->personajes = $personajes;
    }

}