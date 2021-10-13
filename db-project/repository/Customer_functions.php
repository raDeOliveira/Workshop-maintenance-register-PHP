<?php

include 'model/Customer.php';

function getAllCustomers (){

    $query = "select * from customer";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //var_dump($row);

        $customer = new Customer();
        $customer->setIdCustomer($row["ID_CUSTOMER"]);
        $customer->setCustomerName($row["CUSTOMER_NAME"]);
        $customer->setCustomerContact($row["CUSTOMER_CONTACT"]);
        $customer->setIdAddress($row["ID_ADDRESS"]);

        $listResults[] = $customer;
    }

    oci_close($conn);

    return $listResults;
}

function getCustomerById($id){

    $query = "select * from customer WHERE customer.id_customer = " . $id;

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //var_dump($row);

        $customer = new Customer();
        $customer->setIdCustomer($row["ID_CUSTOMER"]);
        $customer->setCustomerName($row["CUSTOMER_NAME"]);
        $customer->setCustomerContact($row["CUSTOMER_CONTACT"]);
        $customer->setIdAddress($row["ID_ADDRESS"]);
    }

    oci_close($conn);

    return $customer;
}

/*
function addCustomer($customer){

    $customer = new Customer();

    $query = "insert into customer";
    $query+= " (customer_name, customer_contact, id_address)" ;
    $query+= " VALUES" ;
    $query+= $customer->getName() .",".$customer->getId() ;

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //var_dump($row);
        $customer = new Customer();
        $customer->setId($row["ID_CUSTOMER"]);
        $customer->setName($row["CUSTOMER_NAME"]);
    }

    oci_close($conn);

    return $customer;
}
*/