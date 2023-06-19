<?php
require_once("config.php");
require_once("utilityFunctions.php");


$isPatientExists = function($useSSN, $identifier) use($db){
    $sql = "";
    if($useSSN){
        $sql = "SELECT * FROM patients WHERE patient_ssn = ".$identifier.";";
    }else{
        $sql = "SELECT * FROM patients WHERE patient_email = '".$identifier."';";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);

    return($count>0);
};

$addPatient = function($fname, $lname, $ssn, $email, $password, $phone, $address, $weight, $height, $age, $blood_group) use($db, $isValidEmail, $isPatientExists){
    $res = [];
    if(!$isValidEmail($email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." is invalid";
    }elseif($isPatientExists(false, $email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." already exists";
    }elseif($isPatientExists(true, $ssn)){
        $res['error'] = true;
        $res['response'] = "The ssn".$ssn." already exists";
    }else{
        $sql = "INSERT INTO patients(patient_fname,patient_lname,patient_ssn,patient_email,patient_password,patient_mobile,patient_address,patient_weight,patient_height,patient_age,patient_blood_group) VALUES ('$fname', '$lname', '$ssn', '$email', '$password', '$phone', '$address', '$weight', '$height', '$age', '$blood_group')";

        if($db->query($sql)){
            $res['error'] = false;
            $res['response'] = "Patient has been created";
        }else{
            $res['error'] = true;
            $res['response'] = "Error: ".$db->error;
        }
    }
    return $res;
};

?>