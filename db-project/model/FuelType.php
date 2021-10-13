<?php


class FuelType
{

    private $idFuelType;
    private $name;

    /**
     * @return mixed
     */
    public function getIdFuelType()
    {
        return $this->idFuelType;
    }

    /**
     * @param mixed $idFuelType
     */
    public function setIdFuelType($idFuelType)
    {
        $this->idFuelType = $idFuelType;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }



}