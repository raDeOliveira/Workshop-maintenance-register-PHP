<?php

include 'data_base/db_connection.php';
include 'repository/Intervention_functions.php';

echo "<h2 style='text-align: center; text-decoration: underline'>Intervention data:</h2><br><br>";

$myInterventionSearch = null;

if (isset($_POST["dt-intervention"])) {

    $idModel            = $_POST["select-model"];
    $idFuelType         = $_POST["select-fuel-type"];
    $numPlate           = ($_POST["num-plate"] == '' ) ? "99-00-99" : $_POST["num-plate"];
    $customer           = $_POST["select-customer"];
    $idMec              = $_POST["select-mechanic"];
    $idBrake            = $_POST["select-brakes"];
    $idBody             = $_POST["select-body"];
    $idPayment          = $_POST["select-payment"];
    $notes              = $_POST["notes"];
    $idLabourService    = $_POST["select-services"];
    $dtIntervention     = $_POST["dt-intervention"];

    $intervention = new Intervention();
    $intervention->setIdCustomer($customer);
    $intervention->setPlateNumber($numPlate);
    $intervention->setIdPaymentType($idPayment);
    $intervention->setIdLabourService($idLabourService);
    $intervention->setNotes($notes);

    $lstParts = array(
        $idMec, $idBrake, $idBody
    );

    $myResult = prepareIntervention($intervention, $idModel, $idFuelType, $dtIntervention, $lstParts);

    if ($myResult){
        echo "<p>".$customer."</p>";
    }

}

if (isset($_POST['search'])) {

    $filter   = (isset($_POST['filter'])     ? $_POST['filter']     : "-1") ;
    $filterResult   = (isset($_POST['filter-result'])   ? $_POST['filter-result']     : "-1") ;

    $myInterventionSearch = search($filter, $filterResult);

    //print_r($myInterventionSearch);

}

?>

<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>Intervention data</title>
</head>
<body>

<div class="container">
<h1>Filter by intervention</h1>
<h4>select an option to find</h4>

<form action="" method="post">
    <label for="">Name</label>
    <input type="radio" value="filter-name" name="filter" id="filter-name">

    <label for="">Brand</label>
    <input type="radio" value="filter-brand" name="filter" id="filter-brand">

    <label for="">Parts</label>
    <input type="radio" value="filter-part" name="filter" id="filter-part">

    <input type="text" name="filter-result">

    <button type="submit" value="submit" name="search">Pesquisar</button>
</form>
    <form action="index.php">
        <input type="submit" value="Return to intervention" />
    </form>

    <table>
        <table class="table">
            <tr>
                <th>Name</th>
                <th>Contact</th>
                <th>Brand</th>
                <th>Part</th>
            </tr>
        <?php
            foreach ($myInterventionSearch as $intervention) {
        ?>
            <tr>
                <td><?php echo $intervention['CUSTOMER_NAME'];?></td>
                <td><?php echo $intervention['CUSTOMER_CONTACT'];?></td>
                <td><?php echo $intervention['NAME'];?></td>
                <td><?php echo $intervention['PART_NAME'];?></td>
            </tr>

        <?php } ?>
    </table>
        <hr>
        <hr>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>