<?php

// Valid constant names
CONST USERNAME = "raso";
CONST PASSWORD = "raso";
CONST DATA_BASE = "XE";

function makeConnection(){

    $conn = oci_connect(USERNAME, PASSWORD, DATA_BASE);

    // Check data_base

    return $conn;
}


