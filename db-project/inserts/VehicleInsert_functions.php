<?php

function saveVehicle($idModel, $idFuelType){

    $query = "insert into vehicle (id_brand_model, id_fuel_type) values (".$idModel.", ".$idFuelType.") RETURNING ID_VEHICLE INTO :ID";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);

    //$id = null;
    OCIBindByName($stid,":ID",$idVehicle);
    $result = oci_execute($stid);

    oci_close($conn);

    if ($result != true){
        return -1;
    }

    return $idVehicle;

}
