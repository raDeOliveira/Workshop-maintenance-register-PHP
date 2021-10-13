<?php


class Model
{

    private $idBrandModel;
    private $model;

    /**
     * @return mixed
     */
    public function getIdBrandModel()
    {
        return $this->idBrandModel;
    }

    /**
     * @param mixed $idBrandModel
     */
    public function setIdBrandModel($idBrandModel)
    {
        $this->idBrandModel = $idBrandModel;
    }

    /**
     * @return mixed
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param mixed $model
     */
    public function setModel($model)
    {
        $this->model = $model;
    }



}