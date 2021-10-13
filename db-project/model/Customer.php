<?php

class Customer{

    private $idCustomer;
    private $customerName;
    private $customerContact;
    private $idAddress;

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
    public function getCustomerName()
    {
        return $this->customerName;
    }

    /**
     * @param mixed $customerName
     */
    public function setCustomerName($customerName)
    {
        $this->customerName = $customerName;
    }

    /**
     * @return mixed
     */
    public function getCustomerContact()
    {
        return $this->customerContact;
    }

    /**
     * @param mixed $customerContact
     */
    public function setCustomerContact($customerContact)
    {
        $this->customerContact = $customerContact;
    }

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



}