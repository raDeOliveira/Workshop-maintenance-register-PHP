<?php
include 'model/FuelType.php';

function getAllFuelTypes (){

    $query = "select * from fuel_type";
    //print "QUERY: " . $query;

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        var_dump($row);

        $obj = new FuelType();
        $obj->setIdFuelType($row["ID_FUEL_TYPE"]);
        $obj->setName($row["NAME"]);

        $listResults[] = $obj;
    }

    oci_close($conn);

    return $listResults;
}

//function getAllFuelTypesById($id){
//
//    $query = "select * from fuel_type WHERE fuel_type.id_fuel_type = " . $id;
//
//    $conn = makeConnection();
//    $stid = oci_parse($conn, $query);
//    oci_execute($stid);
//
//    // output data of each row
//    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
//        //var_dump($row);
//
//        $obj = new FuelType();
//        $obj->setIdFuelType($row["ID_FUEL_TYPE"]);
//        $obj->setName($row["NAME"]);
//    }
//
//    oci_close($conn);
//
//    return $obj;
//}
