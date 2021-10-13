<?php


class Mechanic
{

    private $idPart;
    private $idCategory;
    private $partName;

    /**
     * @return mixed
     */
    public function getIdPart()
    {
        return $this->idPart;
    }

    /**
     * @param mixed $idPart
     */
    public function setIdPart($idPart)
    {
        $this->idPart = $idPart;
    }

    /**
     * @return mixed
     */
    public function getIdCategory()
    {
        return $this->idCategory;
    }

    /**
     * @param mixed $idCategory
     */
    public function setIdCategory($idCategory)
    {
        $this->idCategory = $idCategory;
    }

    /**
     * @return mixed
     */
    public function getPartName()
    {
        return $this->partName;
    }

    /**
     * @param mixed $partName
     */
    public function setPartName($partName)
    {
        $this->partName = $partName;
    }

}