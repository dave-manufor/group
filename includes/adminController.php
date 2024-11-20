<?php
require_once("config.php");
require_once("utilityFunctions.php");
require_once("fileController.php");


$isAdminExists = function($useSSN, $identifier) use($db){
    $sql = "";
    if($useSSN){
        $sql = "SELECT * FROM admins WHERE admin_ssn = ".$identifier.";";
    }else{
        $sql = "SELECT * FROM admins WHERE admin_email = '".$identifier."';";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);

    return($count>0);
};

$addAdmin = function($fname, $lname, $ssn, $email, $password, $phone, $profile_image) use($db, $isValidEmail, $isAdminExists, $addProfileImage){
    $res = [];
    if(!$isValidEmail($email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." is invalid";
    }elseif($isAdminExists(false, $email)){
        $res['error'] = true;
        $res['response'] = "The email address ".$email." already exists";
    }elseif($isAdminExists(true, $ssn)){
        $res['error'] = true;
        $res['response'] = "The ssn".$ssn." already exists";
    }else{
        $profile_location = $addProfileImage($ssn, $profile_image);
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $sql = "INSERT INTO admins(admin_fname,admin_lname,admin_ssn,admin_email,admin_password,admin_mobile, admin_image) VALUES ('$fname', '$lname', '$ssn', '$email', '$hashed_password', '$phone', '$profile_location')";

        if($db->query($sql)){
            $res['error'] = false;
            $res['response'] = "Admin has been created";
        }else{
            $res['error'] = true;
            $res['response'] = "Error: ".$db->error;
        }
    }
    return $res;
};

$getAdmin = function($useId, $identifier) use($db){
     $column = ($useId) ? "admin_id" : "admin_ssn";
     $sql = "SELECT * FROM admins WHERE ".$column."=".$identifier.";";
     $res = [];
     $admin = null;
     try{
        $result = $db->query($sql);
        $admin = $result->fetch_assoc();
        $res['error'] = false;
        $res['message'] = "Found admin";
        $res['data'] = $admin;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$getAllAdmins = function() use($db){

    $sql = "SELECT * FROM admins;";
    $res = [];
    $admins = [];
    try{
       $result = $db->query($sql);
       while($admin = $result->fetch_assoc()){
           $admins[$admin['admin_id']] = $admin;
       }
       $res['error'] = false;
       $res['message'] = "Query executed successfully";
       $res['data'] = $admins;
   }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();

    }finally{
       return $res;
    }
};

$updateAdmin = function($useId, $identifier, $fname, $lname, $ssn, $email, $password, $phone, $profile_image) use($db, $updateProfileImage){
    $column = ($useId) ? "admin_id" : "admin_ssn";
    $profile_location = $updateProfileImage($ssn, $profile_image);
    $sql = "UPDATE admins SET admin_fname = '$fname', admin_lname = '$lname', admin_ssn = $ssn, admin_email = '$email', admin_password = '$password', admin_mobile = '$phone'".(($profile_location) ? ", admin_image = '$profile_location'" : "")." WHERE $column = '$identifier';";
    $res = [];
    try{
        if($db->query($sql)){
            $res['error'] = false;
            $res['message'] = "Admin Updated";
        }else{
            $res['error'] = true;
            $res['message'] = "Admin not updated";
        }
    }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();
    }finally{
        return $res;
    }

};

$deleteAdmin = function($useId, $identifier) use($db, $getAdmin, $deleteProfileImage){
    $admin_ssn = ($getAdmin($useId, $identifier))['data']['admin_ssn'];
    $column = ($useId) ? "admin_id" : "admin_ssn";
     $sql = "DELETE FROM admins WHERE ".$column."=".$identifier.";";
     $res = [];
     try{
        if($db->query($sql) && $db->affected_rows > 0){
            $deleteProfileImage($admin_ssn);
            $res['error'] = false;
            $res['message'] = "Administrator deleted successful";
        }else{
            $res['error'] = true;
            $res['message'] = "Failed to delete administrator";
        }
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
}
?>