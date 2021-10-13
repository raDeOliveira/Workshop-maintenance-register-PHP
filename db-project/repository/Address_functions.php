<?php
include 'model/Address.php';

function getAllAddressesByCustomer ($idCustomer){

    $query = "select * from address WHERE id_address = " . $idCustomer ;

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //var_dump($row);

        $customer = new Address();
        $customer->setIdAddress($row["ID_ADDRESS"]);
        $customer->setCustomerAddress($row["CUSTOMER_ADDRESS"]);
        $customer->setCustomerCity($row["CUSTOMER_CITY"]);
        $customer->setCustomerDoorNum($row["CUSTOMER_DOOR_NUM"]);
        $customer->setCustomerZipCode($row["CUSTOMER_ZIPCODE"]);

        $listResults[] = array
        (
            'idAddress' => $row["ID_ADDRESS"],
            'address' => $row["CUSTOMER_ADDRESS"],
            'cit' => $row["CUSTOMER_CITY"],
            'doorNum' => $row["CUSTOMER_DOOR_NUM"],
            'zipCode' => $row["CUSTOMER_ZIPCODE"]
        );
    }

    oci_close($conn);

    return $listResults;
}
