<?php
    require_once("./includes/config.php");
    require_once("./includes/utilityFunctions.php");
    require_once("./includes/patientController.php");

    $res = [];

    if(!empty($_POST['email'])){
        $email = $_POST['email'];
        if(!$isValidEmail($email)){
            $res['error'] = true;
            $res['message'] = $email." is not a valid email address";
        }elseif($isPatientExists(false, $email)){
            $res['error'] = true;
            $res['message'] = "The email '".$email."' already exists";
        }else{
            $res['error'] = false;
            $res['message'] = "Email available";
        }
    }elseif(!empty($_POST['ssn'])){
        $ssn = $_POST['ssn'];
        if($isPatientExists(true, $ssn)){
            $res['error'] = true;
            $res['message'] = "The SSN '".$ssn."' already exists";
        }else{
            $res['error'] = false;
            $res['message'] = "SSN available";
        }
    }else{
        $res['error'] = true;
        $res['message'] = "You must specify either 'email' or 'ssn'";
    }

    echo(json_encode($res));
?>