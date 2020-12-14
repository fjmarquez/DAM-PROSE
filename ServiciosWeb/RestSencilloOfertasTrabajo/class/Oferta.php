<?php

//Para poder utilizar json_encode, la clase debe implementar JsonSerializable
class Oferta implements JsonSerializable
{
    private $idOferta;
    private $oferta;
    private $sector;
    private $salario;


    /**
     * @return int
     */
    public function getidOferta()
    {
        return $this->idOferta;
    }

    /**
     * @param int $idOferta
     */
    public function setidOferta($idOferta)
    {
        $this->idOferta = $idOferta;
    }

    /**
     * @return string
     */
    public function getoferta()
    {
        return $this->oferta;
    }

    /**
     * @param string $oferta
     */
    public function setoferta($oferta)
    {
        $this->oferta = $oferta;
    }

    /**
     * @return string
     */
    public function getsector()
    {
        return $this->sector;
    }

    /**
     * @param string $sector
     */
    public function setsector($sector)
    {
        $this->sector = $sector;
    }

    /**
     * @return int
     */
    public function getsalario()
    {
        return $this->salario;
    }

    /**
     * @param int $salario
     */
    public function setsalario($salario)
    {
        $this->salario = $salario;
    }


    public function jsonSerialize()
    {

            return array(
                'id' => $this->idOferta,
                'oferta' => $this->oferta,
                'sector' => $this->sector,
                'salario' => $this->salario,
            );
    }
}
