<?php
require_once "DAO.php";
require_once "Person.php";
class PersonDAO extends DAO
{

    const SCHEMA="servicioprose";
    const NAME_TABLE="personas";

    public function getPersons()
    {

        $this->openConection();

        $sql = "SELECT ID, NAME, SURNAME, AGE FROM ".self::SCHEMA.".".self::NAME_TABLE;

        $stmt=$this->conexion->prepare($sql);

        $stmt->execute();

        $result = $stmt->get_result();

        $persons = $this->getArrayOfPerson($result);

        $this->closeConection();


        return $persons;
    }

    public function getPersonWithId($id)
    {
        $this->openConection();

        $sql = "SELECT ID, NAME, SURNAME, AGE FROM ".self::SCHEMA.".".self::NAME_TABLE." WHERE ID=".$id;

        $stmt=$this->conexion->prepare($sql);

        $stmt->execute();

        $result = $stmt->get_result();

        if($result->num_rows > 0)
            {
                //Obtenemos el registro
                $row = $result->fetch_assoc();

                $person = new Person();

                $person->setIdPerson($id);
                $person->setName($row["NAME"]);
                $person->setSurname($row["SURNAME"]);
                $person->setAge($row["AGE"]);

            }
            else
            {
                $person = false;
            }

            return $person;
    }

    public function getArrayOfPerson($result){
        $persons = array();

        for($i=0;$i<$result->num_rows;$i++){
            $row = $result->fetch_assoc();

            $person = new Person();

            $person->setIdPerson($row['ID']);
            $person->setName($row["NAME"]);
            $person->setSurname($row["SURNAME"]);
            $person->setAge($row["AGE"]);

            $persons[$i] = $person;
        }
        return $persons;
    }

}