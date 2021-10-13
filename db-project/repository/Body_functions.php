<?php
include 'model/Body.php';

function getAllBodyParts (){

    $query = "select * from part where part.id_category = 3";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        var_dump($row);

        $obj = new Body();
        $obj->setIdPart($row["ID_PART"]);
        $obj->setIdCategory($row["ID_CATEGORY"]);
        $obj->setPartName($row["PART_NAME"]);

        $listResults[] = $obj;
    }

    oci_close($conn);

    return $listResults;
}

//function getBrandById($id){
//
//    $query = "select * from brand WHERE brand.id_brand = " . $id;
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
