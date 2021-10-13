<?php


class Payment
{

    private $idPaymentType;
    private $paymentType;

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
    public function getPaymentType()
    {
        return $this->paymentType;
    }

    /**
     * @param mixed $paymentType
     */
    public function setPaymentType($paymentType)
    {
        $this->paymentType = $paymentType;
    }



}