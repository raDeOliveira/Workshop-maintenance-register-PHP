<?php
include 'model/LabourService.php';

function getAllServices (){

    $query = "select * from labour_service";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        var_dump($row);

        $obj = new LabourService();
        $obj->setIdService($row["ID_SERVICE"]);
        $obj->setService($row["SERVICE"]);
        $obj->setPrice($row["PRICE"]);

        $listResults[] = $obj;

    }

    oci_close($conn);

    return $listResults;
}
