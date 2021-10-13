<?php


class Address
{

    private $idAddress;
    private $customerAddress;
    private $customerCity;
    private $customerDoorNum;
    private $customerZipCode;

    /**
     * @return mixed
     */
    public function getIdAddress()
    {
        return $this->idAddress;
    }

    /**
     * @param mixed $idAddress
     */
    public function setIdAddress($idAddress)
    {
        $this->idAddress = $idAddress;
    }

    /**
     * @return mixed
     */
    public function getCustomerAddress()
    {
        return $this->customerAddress;
    }

    /**
     * @param mixed $customerAddress
     */
    public function setCustomerAddress($customerAddress)
    {
        $this->customerAddress = $customerAddress;
    }

    /**
     * @return mixed
     */
    public function getCustomerCity()
    {
        return $this->customerCity;
    }

    /**
     * @param mixed $customerCity
     */
    public function setCustomerCity($customerCity)
    {
        $this->customerCity = $customerCity;
    }

    /**
     * @return mixed
     */
    public function getCustomerDoorNum()
    {
        return $this->customerDoorNum;
    }

    /**
     * @param mixed $customerDoorNum
     */
    public function setCustomerDoorNum($customerDoorNum)
    {
        $this->customerDoorNum = $customerDoorNum;
    }

    /**
     * @return mixed
     */
    public function getCustomerZipCode()
    {
        return $this->customerZipCode;
    }

    /**
     * @param mixed $customerZipCode
     */
    public function setCustomerZipCode($customerZipCode)
    {
        $this->customerZipCode = $customerZipCode;
    }





}