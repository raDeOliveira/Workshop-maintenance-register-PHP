<?php

//include php function files
include 'data_base/db_connection.php';
include 'repository/Customer_functions.php';
include 'repository/Brand_functions.php';
include 'repository/Model_functions.php';
include 'repository/FuelType_functions.php';
include 'repository/Mechanic_functions.php';
include 'repository/Brakes_functions.php';
include 'repository/Body_functions.php';
include 'repository/Intervention_functions.php';
include 'repository/LabourService_functions.php';
include 'repository/Payment_functions.php';
include 'repository/Address_functions.php';

//GET method
if (isset($_GET["idBrand"])) {
    $idBrand = $_GET["idBrand"];
    $modelResult = getAllModelsByBrand($idBrand);
    return print json_encode($modelResult);
}

if (isset($_GET["idCustomer"])) {
    $idCustomer = $_GET["idCustomer"];
    $addressResult = getAllAddressesByCustomer($idCustomer);
    return print json_encode($addressResult);
}

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

    prepareIntervention($intervention, $idModel, $idFuelType, $dtIntervention, $lstParts);

    }

?>


<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <title>AUTO - BISCA</title>
</head>

<body>
<div class="container">
    <form class="intervention-form" id="intervention-form" name="intervention-form" action = "results.php" method="post" >
<!--    <form class="intervention-form" id="intervention-form" name="intervention-form" action = "index.php" method="post" >-->
        <br>
        <fieldset>
            <!--//intervention date -->
            <h1><legend>Intervention</legend></h1>
            <label>Intervention date: <input type="date" id="dt-intervention" name="dt-intervention"></label>
            <br><br>

            <!--//customer -->
            <fieldset>
                <h1><legend>Customer</legend></h1>
                <label>Name:</label>
                <select name="select-customer" id="select-customer" onchange="getAddressesByCustomer()">
                    <option value="-1">Select option</option>
                    <?php
                    $listCustomers = getAllCustomers();
                    foreach($listCustomers as $customer){
                    ?>
                    <option value="<?php echo $customer->getIdCustomer() ?>"><?php echo $customer->getCustomerName() ?></option>
                    <?php } ?>
                </select>

                <fieldset>
                    <label for="select-address">Address: <span id="select-address" name="select-address"></span> </label>
                </fieldset>

                <fieldset>
                    <label for="select-city">City: <span id="select-city" name="select-city"></span> </label>
                </fieldset>
                <fieldset>
                    <label for="select-doorNum">Doornumber: <span id="select-doorNum" name="select-doorNum"></span> </label>
                </fieldset>
                <fieldset>
                    <label for="select-zipCode">Zip code: <span id="select-zipCode" name="select-zipCode"></span> </label>
                </fieldset>

            </fieldset>
            <br>

            <!-- //vehicle data -->
            <fieldset>
                <h1><legend>Vehicle data</legend></h1>
                <label>Brand:</label>
                <select name="select-brand" id="select-brand" onchange="getModelsByBrand()">
                    <option value="-1">Select option</option>
                    <?php
                        $lstBrands = getAllBrands();
                        foreach($lstBrands as $brand){
                    ?>
                        <option value="<?php echo $brand->getIdBrand(); ?>"> <?php echo $brand->getName() ?></option>
                    <?php } ?>
                </select>

                <!-- //vehicle model -->
                <label>Model:</label>
                <select name="select-model" id="select-model">
                    <option value="-1">Select option</option>
                </select>

                <!-- //vehicle fuel -->
                <label for="Fuel-type">Fuel Type: </label>
                <select name="select-fuel-type" id="select-fuel-type">
                    <option value="-1">Select option</option>
                    <?php
                        $lstFuelTypeModels = getAllFuelTypes();
                        foreach($lstFuelTypeModels as $fuelType){
                    ?>
                        <option value="<?php echo $fuelType->getIdFuelType(); ?>"> <?php echo $fuelType->getName() ?></option>
                    <?php } ?>
                </select>

                <!-- //vehicle plate -->
                <label>Plate number:</label>
                <input type="text" id="num-plate" name="num-plate">
            </fieldset>
            <br>

            <!--  //Services  -->
            <fieldset>
                <h1><legend>Services:</legend></h1>
                <label for="service">Service: </label>
                <select name="select-services" id="select-services" onchange="setPrice()">
                    <option value="-1">Select option</option>
                    <?php
                    $lstServices = getAllServices();
                    foreach($lstServices as $service){
                    ?>
                        <option value="<?php echo $service->getIdService(); ?>"><?php echo $service->getService()?></option>
                    <?php } ?>
                </select>
                <label for="price">Cost per hour: <span id="price" name="price"></span> </label>
            </fieldset>
            <br>

            <!-- //parts data -->
            <fieldset>
                <h1><legend>Used parts:</legend></h1>
                <label for="mechanic-parts">Mechanic:</label>
                <select name="select-mechanic" id="select-mechanic" >
                    <option value="-1">Select option</option>
                    <?php
                    $lstMechanic = getAllMechanicParts();
                    foreach($lstMechanic as $mechanic){
                        ?>
                        <option value="<?php echo $mechanic->getIdPart(); ?>"> <?php echo $mechanic->getPartName() ?></option>
                    <?php } ?>
                </select>

                <label for="brakes">Brakes: </label>
                <select id="select-brakes" name="select-brakes" >
                    <option value="-1">Select option</option>
                    <?php
                    $lstBrakeParts = getAllBrakeParts();
                    foreach($lstBrakeParts as $part){
                        ?>
                        <option value="<?php echo $part->getIdPart(); ?>"> <?php echo $part->getPartName() ?></option>
                    <?php } ?>
                </select>

                <label for="body">Body: </label>
                <select id="select-body" name="select-body" >
                    <option value="-1">Select option</option>
                    <?php
                    $lstBodyParts = getAllBodyParts();
                    foreach($lstBodyParts as $part){
                        ?>
                        <option value="<?php echo $part->getIdPart(); ?>"> <?php echo $part->getPartName() ?></option>
                    <?php } ?>
                </select>
            </fieldset>
            <br>

            <!--  //Payment  -->
            <fieldset>
                <h1><legend>Payment:</legend></h1>
                <label for="payment-type">Payment type: </label>
                <select name="select-payment" id="select-payment" >
                    <option value="-1">Select option</option>
                    <?php
                    $lstPayment = getPayment();
                    foreach($lstPayment as $payment){
                        ?>
                        <option value="<?php echo $payment->getIdPaymentType(); ?>"> <?php echo $payment->getPaymentType() ?></option>
                    <?php } ?>
                </select>
                <br><br>

                <!-- //notes -->
                <label>Notes:</label>
                <br>
                <textarea class="notes" id="notes" name="notes" rows="4" cols="90"></textarea>
            </fieldset>
            <br>
            <button class="button" type="submit" id="btn-save" value="save" >Save</button>
            <button type="btn" href="results.php" id="result-data" >Search interventions</button>
<!--            <button><a type="button" href="" id="btn-download" onclick="saveFile()">Export file</a></button>-->
        </fieldset>
    </form>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>


<script>
    function getModelsByBrand(){

        //get the brand models and print them
        var idBrand = document.getElementById("select-brand");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {

                let listModels = JSON.parse(this.responseText);
                console.log("listModels: ", listModels);

                var modelSelect = document.getElementById("select-model");
                modelSelect.length = 0; //empty array
                for (var i = 0; i < listModels.length; i++){

                    var option = document.createElement("option");
                    option.text = listModels[i].model;
                    option.value = listModels[i].idModel;

                    modelSelect.appendChild(option);

                }
            }
        }
        xmlhttp.open("GET", "index.php?idBrand=" + idBrand.value, true);
        xmlhttp.send();
    }

    function getAddressesByCustomer(){

        var idCustomer = document.getElementById("select-customer");
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState === 4 && this.status === 200) {

                let listAddress = JSON.parse(this.responseText);
                console.log("listAddresses: ", listAddress);

                var addressSelect = document.getElementById("select-address");
                var citySelect = document.getElementById("select-city");
                var doorNumSelect = document.getElementById("select-doorNum");
                var zipCodeSelect = document.getElementById("select-zipCode");
                //addressSelect.length = 0; //empty array
                for (var i = 0; i < listAddress.length; i++){
                    var option = document.createElement("option");
                    var option2 = document.createElement("option");
                    var option3 = document.createElement("option");
                    var option4 = document.createElement("option");
                    option.text = listAddress[i].address;
                    option2.text = listAddress[i].cit;
                    option3.text = listAddress[i].doorNum;
                    option4.text = listAddress[i].zipCode;
                    document.getElementById("select-address").innerText = addressSelect.appendChild(option).text;
                    document.getElementById("select-city").innerText = citySelect.appendChild(option2).text;
                    document.getElementById("select-doorNum").innerText = doorNumSelect.appendChild(option3).text;
                    document.getElementById("select-zipCode").innerText = zipCodeSelect.appendChild(option4).text;
                }
            }
        }
        xmlhttp.open("GET", "index.php?idCustomer=" + idCustomer.value, true);
        xmlhttp.send();
    }

    function setPrice(){

        var idService = document.getElementById('select-services').value;
        <?php foreach($lstServices as $service){ ?>
            if (<?php echo $service->getIdService(); ?> == idService){
                console.log("found");
                document.getElementById('price').innerText = <?php echo $service->getPrice() ?>  + "€";
            }
        <?php } ?>
    }
</script>

<script>
    //export file data
    let saveFile = () => {
        const name = document.getElementById('select-customer');
        const brand = document.getElementById('select-brand');
        const address = document.getElementById('select-address');
        const model = document.getElementById('select-model');
        const fuel = document.getElementById('select-fuel-type');
        const service = document.getElementById('select-services');
        const mec = document.getElementById('select-mechanic');
        const brake = document.getElementById('select-brakes');
        const body = document.getElementById('select-body');
        const payment = document.getElementById('select-payment');

        let data =
            '\r Name: ' + name.value +
            '\r Brand: ' + brand.value +
            '\r Address: ' + address.value +
            '\r Model: ' + model.value +
            '\r Fuel type: ' + fuel.value +
            '\r Service: ' + service.value +
            '\r Mec part: ' + mec.value +
            '\r Brake part: ' + brake.value +
            '\r Body part: ' + body.value +
            '\r Payment type: ' + payment.value;

        // Convert the text to BLOB.
        const textToBLOB = new Blob([data], { type: 'text/plain' });
        const sFileName = 'formData.txt';

        let newLink = document.createElement("a");
        newLink.download = sFileName;

        if (window.webkitURL != null) {
            newLink.href = window.webkitURL.createObjectURL(textToBLOB);
        }
        else {
            newLink.href = window.URL.createObjectURL(textToBLOB);
            newLink.style.display = "none";
            document.body.appendChild(newLink);
        }
        newLink.click();
    }
</script>

</body>
</html>