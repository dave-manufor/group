<?php
require_once("config.php");
require_once("utilityFunctions.php");
require_once("fileController.php");


$isDoctorExists = function($useSSN, $identifier) use($db){
    $sql = "";
    if($useSSN){
        $sql = "SELECT * FROM doctors WHERE doctor_ssn = ".$identifier.";";
    }else{
        $sql = "SELECT * FROM doctors WHERE doctor_email = '".$identifier."';";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);

    return($count>0);
};

$addDoctor = function($fname, $lname, $ssn, $email, $password, $phone, $speciality, $years_of_experience, $opening_time, $closing_time, $profile_image) use($db, $isValidEmail, $isDoctorExists, $addProfileImage){
    $res = [];
    if(!$isValidEmail($email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." is invalid";
    }elseif($isDoctorExists(false, $email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." already exists";
    }elseif($isDoctorExists(true, $ssn)){
        $res['error'] = true;
        $res['response'] = "The ssn".$ssn." already exists";
    }else{
        $profile_location = $addProfileImage($ssn, $profile_image);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO doctors(doctor_fname,doctor_lname,doctor_ssn,doctor_email,doctor_password,doctor_mobile, speciality, years_of_experience, opening_time, closing_time, doctor_image) VALUES ('$fname', '$lname', $ssn, '$email', '$hashed_password', '$phone', '$speciality', $years_of_experience, '$opening_time', '$closing_time', '$profile_location')";

        if($db->query($sql)){
            $res['error'] = false;
            $res['response'] = "Doctor has been created";
        }else{
            $res['error'] = true;
            $res['response'] = "Error: ".$db->error;
        }
    }
    return $res;
};

$getDoctor = function($useId, $identifier) use($db){
     $column = ($useId) ? "doctor_id" : "doctor_ssn";
     $sql = "SELECT * FROM doctors WHERE ".$column."=".$identifier.";";
     $res = [];
     $doctor = null;
     try{
        $result = $db->query($sql);
        $doctor = $result->fetch_assoc();
        $res['error'] = false;
        $res['message'] = "Query successful";
        $res['data'] = $doctor;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$getAllDoctors = function() use($db){

     $sql = "SELECT * FROM doctors;";
     $res = [];
     $doctors = [];
     try{
        $result = $db->query($sql);
        while($doctor = $result->fetch_assoc()){
            $doctors[$doctor['doctor_id']] = $doctor;
        }
        $res['error'] = false;
        $res['message'] = "Query executed successfully";
        $res['data'] = $doctors;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$updateDoctor = function($useId, $identifier, $fname, $lname, $ssn, $email, $password, $phone, $speciality, $years_of_experience, $opening_time, $closing_time, $profile_image) use($db, $updateProfileImage){
    $column = ($useId) ? "doctor_id" : "doctor_ssn";
    $profile_location = $updateProfileImage($ssn, $profile_image);
    $sql = "UPDATE doctors SET doctor_fname = '$fname', doctor_lname = '$lname', doctor_ssn = $ssn, doctor_email = '$email', doctor_password = '$password', doctor_mobile = '$phone', speciality = '$speciality', years_of_experience = $years_of_experience, opening_time = '$opening_time', closing_time = '$closing_time'".(($profile_location) ? ", doctor_image = '$profile_location'" : "")."WHERE $column = '$identifier';";
    $res = [];
    try{
        if($db->query($sql)){
            $res['error'] = false;
            $res['message'] = "Doctor Updated";
        }else{
            $res['error'] = true;
            $res['message'] = "Doctor not updated";
        }
    }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();
    }finally{
        return $res;
    }

};

$deleteDoctor = function($useId, $identifier) use($db, $getDoctor, $deleteProfileImage){
    $doctor_ssn = ($getDoctor($useId, $identifier))['data']['admin_ssn'];
    $column = ($useId) ? "doctor_id" : "doctor_ssn";
    $sql = "DELETE FROM doctors WHERE ".$column."=".$identifier.";";
    $res = [];
    try{
        if($db->query($sql) && $db->affected_rows > 0){
            $deleteProfileImage($doctor_ssn);
            $res['error'] = false;
            $res['message'] = "Doctor deleted successful";
        }else{
            $res['error'] = true;
            $res['message'] = "Failed to delete doctor";
        }
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
}



?>