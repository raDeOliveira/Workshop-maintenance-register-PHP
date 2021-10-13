<?php
include 'model/Intervention.php';
include 'inserts/VehicleInsert_functions.php';
include 'inserts/InterventionPartInsert_functions.php';

function prepareIntervention($intervention, $idModel, $idFuelType, $dtIntervention, $lstParts){

    // funcao para inserir gravar o veiculo com o idbrand, idFuelType
    $idVehicle = saveVehicle($idModel, $idFuelType);
    if ($idVehicle == -1){
        return false;
    }
    $intervention->setIdVehicle($idVehicle);

    $idIntervention = saveIntervention($intervention);
    if ($idIntervention == -1){
        return false;
    }
    $intervention->setIdIntervention($idIntervention);

    // save the relationships with parts used
    $rst = saveInterventionPart($idIntervention, $lstParts);
    if($rst != true){
        return false;
    }

    // funcao para gravar a bill (dtBill, idIntervention)
    $result = saveBill($idIntervention, $dtIntervention);
    if($result != true){
        return false;
    }
    return true;

}

function saveIntervention($intervention){

    $conn = makeConnection();

    $query = "insert into intervention 
            (id_customer, id_vehicle, id_labour_service, id_payment_type, notes, plate_number) 
    values 
            (:customer, :idVehicle, :idLabourService, :idPayment, :notes, :numPlate) RETURNING ID_INTERVENTION INTO :ID";

//    var_dump($query);

    $stid = oci_parse($conn, $query);

    $customer = $intervention->getIdCustomer();
    $idVehicle = $intervention->getIdVehicle();
    $idLabourService = $intervention->getIdLabourService();
    $idPayment = $intervention->getIdPaymentType();
    $notes = $intervention->getNotes();
    $numPlate = $intervention->getPlateNumber();

    OCIBindByName($stid,":customer",$customer);
    OCIBindByName($stid,":idVehicle",$idVehicle);
    OCIBindByName($stid,":idLabourService",$idLabourService);
    OCIBindByName($stid,":idPayment",$idPayment);
    OCIBindByName($stid,":notes",$notes);
    OCIBindByName($stid,":numPlate",$numPlate);
    OCIBindByName($stid,":ID",$idIntervention);
    $result = oci_execute($stid);

    oci_close($conn);

    if ($result != true){
        return -1;
    }

    return $idIntervention;
}

function saveBill($idIntervention, $dtIntervention){

    $query = "insert into bill 
            (date_bill, id_intervention ) 
    values 
            (to_date(:dtIntervention, 'YYYY-MM-DD'), :idIntervention)";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);

    OCIBindByName($stid,":dtIntervention",$dtIntervention);

    OCIBindByName($stid,":idIntervention",$idIntervention);
    $result = oci_execute($stid);

    oci_close($conn);

    if ($result != true){
        return false;
    }

    return true;
}

function search($filter, $filterResult){

    $conn = makeConnection();

    $query = "
select c.customer_name, c.customer_contact, b.name, p.part_name from intervention i 
left join customer c on c.id_customer = i.id_customer
left join vehicle v on v.id_vehicle = i.id_vehicle
left join brand_model bm on bm.id_brand_model = v.id_brand_model
left join brand b on b.id_brand = bm.id_brand
left join intervention_part ip on ip.id_intervention = i.id_intervention
left join part p on p.id_part = ip.id_part
    ";

    if($filter == "filter-name"){
        $query .= " where upper(c.customer_name) like upper('%" . $filterResult ."%')";
    }

    if($filter == "filter-brand"){
        $query .= " where  upper(b.name) like upper('%" . $filterResult . "%')";
    }

    if($filter == "filter-part"){
      $query .= " where  upper(p.part_name) like upper('%" . $filterResult . "%')";
    }

//    echo "\nQUERY: " .$query;

    $stid = oci_parse($conn, $query);
    oci_execute($stid);

    $interventionResult = array();

    // output data of each row
    while($row = oci_fetch_array($stid, OCI_ASSOC+OCI_RETURN_NULLS)) {
        //print_r($row);
        $interventionResult[] = $row;
    }

    oci_close($conn);

    return $interventionResult;

}


