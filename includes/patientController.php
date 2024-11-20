<?php
require_once("config.php");
require_once("utilityFunctions.php");
require_once("fileController.php");


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

$addPatient = function($fname, $lname, $ssn, $email, $password, $phone, $address, $weight, $height, $age, $blood_group, $profile_image) use($db, $isValidEmail, $isPatientExists, $addProfileImage){
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
        $profile_location = $addProfileImage($ssn, $profile_image);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO patients(patient_fname,patient_lname,patient_ssn,patient_email,patient_password,patient_mobile,patient_address,patient_weight,patient_height,patient_age,patient_blood_group,patient_image) VALUES ('$fname', '$lname', '$ssn', '$email', '$hashed_password', '$phone', '$address', '$weight', '$height', '$age', '$blood_group', '$profile_location')";

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

$getPatient = function($useId, $identifier) use($db){
     $column = ($useId) ? "patient_id" : "patient_ssn";
     $sql = "SELECT * FROM patients WHERE ".$column."=".$identifier.";";
     $res = [];
     $patient = null;
     try{
        $result = $db->query($sql);
        $patient = $result->fetch_assoc();
        $res['error'] = false;
        $res['message'] = "Query successful";
        $res['data'] = $patient;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$getAllPatients = function() use($db){

     $sql = "SELECT * FROM patients;";
     $res = [];
     $patients = [];
     try{
        $result = $db->query($sql);
        while($patient = $result->fetch_assoc()){
            $patients[$patient['patient_id']] = $patient;
        }
        $res['error'] = false;
        $res['message'] = "Query executed successfully";
        $res['data'] = $patients;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$updatePatient = function($useId, $identifier, $fname, $lname, $ssn, $email, $password, $phone, $address, $weight, $height, $age, $blood_group, $profile_image) use($db, $updateProfileImage){
    $column = ($useId) ? "patient_id" : "patient_ssn";
    $profile_location = $updateProfileImage($ssn, $profile_image);
    $sql = "UPDATE patients SET patient_fname = '$fname', patient_lname = '$lname', patient_ssn = $ssn, patient_email = '$email', patient_password = '$password', patient_mobile = '$phone', patient_address = '$address', patient_weight = $weight, patient_height = $height, patient_age = $age, patient_blood_group = '$blood_group'".(($profile_location) ? ", patient_image = '$profile_location'" : "")."WHERE $column = '$identifier';";
    $res = [];
    try{
        if($db->query($sql)){
            $res['error'] = false;
            $res['message'] = "Patient Updated";
        }else{
            $res['error'] = true;
            $res['message'] = "Patient not updated";
        }
    }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();
    }finally{
        return $res;
    }

};

$deletePatient = function($useId, $identifier) use($db, $getPatient, $deleteProfileImage){
    $patient_ssn = ($getPatient($useId, $identifier))['data']['patient_ssn'];
    $column = ($useId) ? "patient_id" : "patient_ssn";
    $sql = "DELETE FROM patients WHERE ".$column."=".$identifier.";";
    $res = [];
    try{
        if($db->query($sql) && $db->affected_rows > 0){
            $deleteProfileImage($patient_ssn);
            $res['error'] = false;
            $res['message'] = "Patient deleted successful";
        }else{
            $res['error'] = true;
            $res['message'] = "Failed to delete patient";
        }
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$updateLastLogin = function($id) use($db){
    $now = (new DateTime())->format('Y-m-d H:i:s');
    $sql = "UPDATE patients SET last_login = '$now' WHERE patient_id = '$id'";
    try{
        $db->query(($sql));
    }catch(Exception $error){
        // Do nothing
    }
};



?>