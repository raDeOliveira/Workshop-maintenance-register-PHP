<?php


class Brand
{
    private $idBrand;
    private $name;

    /**
     * @return mixed
     */
    public function getIdBrand()
    {
        return $this->idBrand;
    }

    /**
     * @param mixed $idBrand
     */
    public function setIdBrand($idBrand)
    {
        $this->idBrand = $idBrand;
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