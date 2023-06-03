<?php
include_once("dbConnection.php");

$addPatient = function($fname, $lname, $ssn, $email, $password, $phone, $address, $weight, $height, $age, $blood_group) use($mysqli){
    $sql = "INSERT INTO patients(patient_fname,patient_lname,patient_ssn,patient_email,patient_password,patient_mobile,patient_address,patient_weight,patient_height,patient_age,patient_blood_group) VALUES ('$fname', '$lname', '$ssn', '$email', '$password', '$phone', '$address', '$weight', '$height', '$age', '$blood_group')";

    $res = $mysqli->query($sql);

    return $res; 
};
?>