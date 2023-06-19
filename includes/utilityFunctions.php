<?php
    require_once("config.php");


    $isValidEmail = function($email){
        return filter_var($email, FILTER_VALIDATE_EMAIL) !== false;
    };

    $escape_strip_string = function($string) use($db){
        $string = stripcslashes($string);
        return mysqli_real_escape_string($db, $string);
    }

?>