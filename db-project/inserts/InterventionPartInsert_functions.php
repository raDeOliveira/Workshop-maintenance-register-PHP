<?php

function saveInterventionPart($idIntervention, $lstParts ){

    $query = "insert into intervention_part 
    (id_intervention, id_part) 
    values 
           (:idIntervention, :idPart)";

    $conn = makeConnection();
    $stid = oci_parse($conn, $query);

    foreach ($lstParts as &$part) {
        OCIBindByName($stid,":idIntervention",$idIntervention);
        OCIBindByName($stid,":idPart",$part);
        $result = oci_execute($stid);
    }

    oci_close($conn);

    if ($result != true){
        return false;
    }
    return $result;
}

function saveTheIntervention($intervention ){

    print $intervention->getNotes();

}