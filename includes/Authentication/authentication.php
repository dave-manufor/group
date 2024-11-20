<?php
session_start();
require_once('./../config.php');
require_once('./../utilityFunctions.php');
require_once('./../patientController.php');

    if(isset($_POST['login'])){
        $user_table = ['patient' => 'patients', 'admin' => 'admins', 'pharmacy' => 'pharmacies', 'doctor' => 'doctors'];
        $user_username_column = ['patient' => 'patient_email', 'admin' => 'admin_email', 'pharmacy' => 'pharmacy_email', 'doctor' => 'doctor_email'];
        $user_password_column = ['patient' => 'patient_password', 'admin' => 'admin_password', 'pharmacy' => 'pharmacy_password', 'doctor' => 'doctor_password'];
        $user_name = ['patient' => 'patient_fname', 'admin' => 'admin_fname', 'pharmacy' => 'pharmacy_name', 'doctor' => 'doctor_fname'];
        $user_id_column = ['patient' => 'patient_id', 'admin' => 'admin_id', 'pharmacy' => 'pharmacy_id', 'doctor' => 'doctor_id'];
        $user_profile_column = ['patient' => 'patient_image', 'admin' => 'admin_image', 'pharmacy' => 'pharmacy_image', 'doctor' => 'doctor_image'];
        $res = [];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $account_type = $_POST['account-type'];
        if(!$isValidEmail($email)){
            $res['error'] = true;
            $res['message'] = "Invalid email address";
        }else if(!$user_table[$account_type]){
            $res['error'] = true;
            $res['message'] = "Invalid account type";
        }else{
            $email = $escape_strip_string($email);
            $password = $escape_strip_string($password);
            $sql = "SELECT * FROM ".$user_table[$account_type]." WHERE ".$user_username_column[$account_type]." = '".$email;
            $result = $db->query($sql);
            $count = mysqli_num_rows($result);
            if($count > 0 && password_verify($password, $result->fetch_assoc()[$user_password_column[$account_type]])){
                // Successful Login
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row[$user_id_column[$account_type]];
                $_SESSION['email'] = $row[$user_username_column[$account_type]];
                $_SESSION['name'] = $row[$user_name[$account_type]];
                $_SESSION['user-level'] = $account_type;
                $_SESSION['profile-url'] = $row[$user_profile_column[$account_type]];
                // Update Last Login
                if($account_type == 'patient'){
                    $updateLastLogin($_SESSION['id']);
                }

                $res['error'] = false;
                $res['message'] = "Login Succesful";
                $res['url'] = "dashboard.php";
            }else{
                $res['error'] = true;
                $res['message'] = "Username or Password is incorrect<br>(Ensure you select the right user type)";
            }
        }

        echo (json_encode($res));

    }
?>