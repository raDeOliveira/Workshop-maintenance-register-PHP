<?php
include 'model/Brand.php';

function getAllBrands (){

    $query = "select * from brand";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        var_dump($row);

        $obj = new Brand();
        $obj->setIdBrand($row["ID_BRAND"]);
        $obj->setName($row["NAME"]);

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
