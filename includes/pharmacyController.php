<?php
require_once("config.php");
require_once("utilityFunctions.php");
require_once("fileController.php");


$isPharmacyExists = function($useName, $identifier) use($db){
    $sql = "";
    if($useName){
        $sql = "SELECT * FROM pharmacies WHERE pharmacy_name = '".$identifier."';";
    }else{
        $sql = "SELECT * FROM pharmacies WHERE pharmacy_email = '".$identifier."';";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);

    return($count>0);
};

$addPharmacy = function($name, $street, $city, $state, $zipcode, $country, $opening_time, $closing_time, $email, $password, $pharmacy_mobile, $pharmacy_image) use($db, $isValidEmail, $isPharmacyExists, $addProfileImage){
    $res = [];
    if(!$isValidEmail($email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." is invalid";
    }elseif($isPharmacyExists(false, $email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." already exists";
    }elseif($isPharmacyExists(true, $name)){
        $res['error'] = true;
        $res['response'] = "The name".$name." already exists";
    }else{
        $profile_location = $addProfileImage($email, $pharmacy_image);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO pharmacies(pharmacy_name, pharmacy_street, pharmacy_city, pharmacy_state, pharmacy_zipcode, pharmacy_country, opening_time, closing_time, pharmacy_email, pharmacy_password, pharmacy_mobile, pharmacy_image) VALUES ('$name', '$street', '$city', '$state', '$zipcode', '$country', '$opening_time', '$closing_time', '$email', '$hashed_password', '$pharmacy_mobile', '$profile_location')";

        if($db->query($sql)){
            $res['error'] = false;
            $res['response'] = "Pharmacy has been created";
        }else{
            $res['error'] = true;
            $res['response'] = "Error: ".$db->error;
        }
    }
    return $res;
};

$getPharmacy = function($useId, $identifier) use($db){
     $column = ($useId) ? "pharmacy_id" : "pharmacy_name";
     $sql = "SELECT * FROM pharmacies WHERE ".$column."=".$identifier.";";
     $res = [];
     $pharmacy = null;
     try{
        $result = $db->query($sql);
        $pharmacy = $result->fetch_assoc();
        $res['error'] = false;
        $res['message'] = "Query successful";
        $res['data'] = $pharmacy;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$getAllPharmacies = function() use($db){

     $sql = "SELECT * FROM pharmacies;";
     $res = [];
     $pharmacies = [];
     try{
        $result = $db->query($sql);
        while($pharmacy = $result->fetch_assoc()){
            $pharmacies[$pharmacy['pharmacy_id']] = $pharmacy;
        }
        $res['error'] = false;
        $res['message'] = "Query executed successfully";
        $res['data'] = $pharmacies;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$updatePharmacy = function($useId, $identifier, $name, $street, $city, $state, $zipcode, $country, $opening_time, $closing_time, $email, $password, $pharmacy_mobile, $pharmacy_image) use($db, $updateProfileImage){
    $column = ($useId) ? "pharmacy_id" : "pharmacy_name";
    $profile_location = $updateProfileImage($email, $pharmacy_image);
    $sql = "UPDATE pharmacies SET pharmacy_name = '$name', pharmacy_street = '$street', pharmacy_city = '$city', pharmacy_state = '$state', pharmacy_zipcode = '$zipcode', pharmacy_country = '$country', pharmacy_email = '$email', pharmacy_password = '$password', pharmacy_mobile = '$pharmacy_mobile', opening_time = '$opening_time', closing_time = '$closing_time'".(($profile_location) ? ", pharmacy_image = '$profile_location'" : "")."WHERE $column = '$identifier';";
    $res = [];
    try{
        if($db->query($sql)){
            $res['error'] = false;
            $res['message'] = "Pharmacy Updated";
        }else{
            $res['error'] = true;
            $res['message'] = "Pharmacy not updated";
        }
    }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();
    }finally{
        return $res;
    }

};

$deletePharmacy = function($useId, $identifier) use($db, $getPharmacy, $deleteProfileImage){
    $pharmacy_email = ($getPharmacy($useId, $identifier))['data']['pharmacy_email'];
    $column = ($useId) ? "pharmacy_id" : "pharmacy_name";
     $sql = "DELETE FROM pharmacies WHERE ".$column."=".$identifier.";";
     $res = [];
     try{
        if($db->query($sql) && $db->affected_rows > 0){
            $deleteProfileImage($pharmacy_email);
            $res['error'] = false;
            $res['message'] = "Pharmacy deleted successful";
        }else{
            $res['error'] = true;
            $res['message'] = "Failed to delete pharmacy";
        }
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
}



?>