<?php
include 'model/Model.php';

function getAllModelsByBrand ($idBrand){

    $query = "select * from brand_model WHERE id_brand = " . $idBrand ;

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $listResults = Array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //var_dump($row);

        $obj = new Model();
        $obj->setIdBrandModel($row["ID_BRAND_MODEL"]);
        $obj->setModel($row["MODEL"]);

        $listResults[] = array
            (
                'idModel' => $row["ID_BRAND_MODEL"],
                'model' => $row["MODEL"]
            );

    }

    oci_close($conn);

    return $listResults;
}
