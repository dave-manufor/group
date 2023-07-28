<?php
require_once("config.php");
require_once("utilityFunctions.php");
require_once("fileController.php");


$isDrugExists = function($useId, $identifier) use($db){
    $sql = "";
    if($useId){
        $sql = "SELECT * FROM drugs WHERE drug_id = ".$identifier.";";
    }else{
        $sql = "SELECT * FROM drugs WHERE drug_name = '".$identifier."';";
    }
    $result = $db->query($sql);
    $count = mysqli_num_rows($result);

    return($count>0);
};

$addDrug = function($name, $quantity, $price, $drug_image) use($db, $isDrugExists, $addDrugImage){
    $res = [];
    if($isDrugExists(false, $name)){
        $res['error'] = true;
        $res['response'] = "The drug ".$name." already exists";
    }else{
        $image_location = $addDrugImage($name, $drug_image);
        $sql = "INSERT INTO drugs(drug_name, quantity, price, drug_image) VALUES ('$name', $quantity, $price, '$image_location')";
        if($db->query($sql)){
            $res['error'] = false;
            $res['response'] = "Drug has been created";
        }else{
            $res['error'] = true;
            $res['response'] = "Error: ".$db->error;
        }
    }
    return $res;
};

$getDrug = function($useId, $identifier) use($db){
     $column = ($useId) ? "drug_id" : "drug_name";
     $sql = "SELECT * FROM drugs WHERE ".$column."=".$identifier.";";
     $res = [];
     $drug = null;
     try{
        $result = $db->query($sql);
        $drug = $result->fetch_assoc();
        $res['error'] = false;
        $res['message'] = "Query successful";
        $res['data'] = $drug;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$getAllDrugs = function() use($db){

     $sql = "SELECT * FROM drugs;";
     $res = [];
     $drugs = [];
     try{
        $result = $db->query($sql);
        while($drug = $result->fetch_assoc()){
            $drugs[$drug['drug_id']] = $drug;
        }
        $res['error'] = false;
        $res['message'] = "Query executed successfully";
        $res['data'] = $drugs;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$updateDrug = function($useId, $identifier, $name, $quantity, $price, $drug_image) use($db, $updateDrugImage){
    $column = ($useId) ? "drug_id" : "drug_name";
    $image_location = $updateDrugImage($name, $drug_image);
    $sql = "UPDATE drugs SET drug_name = '$name', quantity = $quantity, price = $price".(($image_location) ? ", drug_image = '$image_location'" : "")." WHERE $column = '$identifier';";
    $res = [];
    try{
        if($db->query($sql)){
            $res['error'] = false;
            $res['message'] = "Drug Updated";
        }else{
            $res['error'] = true;
            $res['message'] = "Drug not updated";
        }
    }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();
    }finally{
        return $res;
    }

};

$dispenseDrug = function($drug_id, $patient_id) use($db, $getDrug){
    $res = [];
    try{
        $drug = ($getDrug(true, $drug_id))['data'];
        $quantity_left = $drug['quantity'];
        if($quantity_left > 0){
            $sql = "INSERT INTO dispenses(drug_id, patient_id) VALUES ($drug_id, $patient_id);";
            if($db->query($sql)){
                $quantity_left -= $quantity_left;
                $sql = "UPDATE drugs SET quantity = $quantity_left WHERE drug_id = $drug_id;";
                if($db->query($sql)){
                    $res['error'] = false;
                    $res['response'] = "Drug has been Dispensed";
                }else{
                    $res['error'] = true;
                    $res['response'] = "Error: ".$db->error;
                }
            }else{
                $res['error'] = true;
                $res['response'] = "Error: ".$db->error;
            }
        }else{
            $res['error'] = true;
            $res['message'] = "There are not enough drugs to dispense";
        }
    }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();
    }finally{
        return $res;
    }

};

$deleteDrug = function($useId, $identifier) use($db, $getDrug, $deleteDrugImage){
    $drug = ($getDrug($useId, $identifier));
    if($drug){
        $drug_name = $drug['data']['drug_name'];
    }else{
        $drug_name = null;
    }
    $column = ($useId) ? "drug_id" : "drug_name";
    $sql = "DELETE FROM drugs WHERE ".$column."=".$identifier.";";
    $res = [];
    try{
        if($db->query($sql) && $db->affected_rows > 0){
            $deleteDrugImage($drug_name);
            $res['error'] = false;
            $res['message'] = "Drug deleted successful";
        }else{
            $res['error'] = true;
            $res['message'] = "Failed to delete drug";
        }
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
}



?>