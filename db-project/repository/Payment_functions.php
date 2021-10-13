<?php
include 'model/Payment.php';

function getPayment (){

    $query = "select * from payment_type";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        var_dump($row);

        $obj = new Payment();
        $obj->setIdPaymentType($row["ID_PAYMENT_TYPE"]);
        $obj->setPaymentType($row["PAYMENT_TYPE"]);

        $listResults[] = $obj;

    }

    oci_close($conn);

    return $listResults;
}

//function getModelById($id){
//
//    $query = "select * from brand_model WHERE brand.id_brand = " . $id;
//
//    $conn = makeConnection();
//    $stid = oci_parse($conn, $query);
//    oci_execute($stid);
//
//    // output data of each row
//    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
//        //var_dump($row);
//
//        $obj = new Brand();
//        $obj->setIdBrand($row["ID_BRAND"]);
//        $obj->setName($row["NAME"]);
//    }
//
//    oci_close($conn);
//
//    return $obj;
//}
