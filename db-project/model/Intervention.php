<?php

class Intervention {
    private $idIntervention;
    private $idCustomer;
    private $idVehicle;
    private $idLabourService;
    private $idPaymentType;
    private $notes;
    private $plateNumber;

    /**
     * @return mixed
     */
    public function getIdIntervention()
    {
        return $this->idIntervention;
    }

    /**
     * @param mixed $idIntervention
     */
    public function setIdIntervention($idIntervention)
    {
        $this->idIntervention = $idIntervention;
    }

    /**
     * @return mixed
     */
    public function getIdCustomer()
    {
        return $this->idCustomer;
    }

    /**
     * @param mixed $idCustomer
     */
    public function setIdCustomer($idCustomer)
    {
        $this->idCustomer = $idCustomer;
    }

    /**
     * @return mixed
     */
    public function getIdVehicle()
    {
        return $this->idVehicle;
    }

    /**
     * @param mixed $idVehicle
     */
    public function setIdVehicle($idVehicle)
    {
        $this->idVehicle = $idVehicle;
    }

    /**
     * @return mixed
     */
    public function getIdLabourService()
    {
        return $this->idLabourService;
    }

    /**
     * @param mixed $idLabourService
     */
    public function setIdLabourService($idLabourService)
    {
        $this->idLabourService = $idLabourService;
    }

    /**
     * @return mixed
     */
    public function getIdPaymentType()
    {
        return $this->idPaymentType;
    }

    /**
     * @param mixed $idPaymentType
     */
    public function setIdPaymentType($idPaymentType)
    {
        $this->idPaymentType = $idPaymentType;
    }

    /**
     * @return mixed
     */
    public function getNotes()
    {
        return $this->notes;
    }

    /**
     * @param mixed $notes
     */
    public function setNotes($notes)
    {
        $this->notes = $notes;
    }

    /**
     * @return mixed
     */
    public function getPlateNumber()
    {
        return $this->plateNumber;
    }

    /**
     * @param mixed $plateNumber
     */
    public function setPlateNumber($plateNumber)
    {
        $this->plateNumber = $plateNumber;
    }



}