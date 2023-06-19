<?php
session_start();
require_once('./../config.php');
require_once('./../utilityFunctions.php');

    if(isset($_POST['login'])){
        $user_table = ['patient' => 'patients', 'admin' => 'admins', 'pharmacy' => 'pharmacies'];
        $user_username_column = ['patient' => 'patient_email', 'admin' => 'admin_email', 'pharmacy' => 'pharmacy_email'];
        $user_password_column = ['patient' => 'patient_password', 'admin' => 'admin_password', 'pharmacy' => 'pharmacy_password'];
        $user_first_name_column = ['patient' => 'patient_fname', 'admin' => 'admin_fname', 'pharmacy' => 'pharmacy_name'];
        $user_id_column = ['patient' => 'patient_id', 'admin' => 'admin_id', 'pharmacy' => 'pharmacy_id'];
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
            $sql = "SELECT * FROM ".$user_table[$account_type]." WHERE ".$user_username_column[$account_type]." = '".$email."' AND ".$user_password_column[$account_type]." = '".$password."';";
            $result = $db->query($sql);
            $count = mysqli_num_rows($result);
            if($count > 0){
                // Successful Login
                $row = $result->fetch_assoc();
                $_SESSION['id'] = $row[$user_id_column[$account_type]];
                $_SESSION['email'] = $row[$user_username_column[$account_type]];
                $_SESSION['name'] = $row[$user_first_name_column[$account_type]];
                $_SESSION['user-level'] = $account_type;

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