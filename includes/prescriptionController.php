<?php
require_once("config.php");
require_once("utilityFunctions.php");
require_once("fileController.php");
require_once("drugController.php");


$addPrescription = function($symptoms, $drug_id, $patient_id, $doctor_id, $pharmacy_id, $frequency) use($db){
    $res = [];
    $sql = "INSERT INTO prescriptions(symptoms, drug_id, patient_id, doctor_id, pharmacy_id, frequency_hours) VALUES ('$symptoms', $drug_id, $patient_id, $doctor_id, $pharmacy_id, $frequency)";
    if($db->query($sql)){
        $res['error'] = false;
        $res['response'] = "Prescription has been Added";
    }else{
        $res['error'] = true;
        $res['response'] = "Error: ".$db->error;
    }
    return $res;
};

$getPrescription = function($detials, $identifier) use($db){
     if($detials){
         $sql = "SELECT p.prescription_id, p.symptoms, p.frequency_hours, p.drug_dispensed, p.created_on, 
                    d.drug_id, d.drug_name, d.drug_image, d.price,
                    pa.patient_id, pa.patient_fname, pa.patient_lname, pa.patient_image,
                    dt.doctor_id, dt.doctor_fname, dt.doctor_lname, dt.doctor_image,
                    ph.pharmacy_id, ph.pharmacy_name, ph.pharmacy_image
                    FROM prescriptions p
                    INNER JOIN drugs d
                    on p.drug_id = d.drug_id
                    INNER JOIN patients pa
                    on p.patient_id = pa.patient_id 
                    INNER JOIN doctors dt
                    on p.doctor_id = dt.doctor_id 
                    INNER JOIN pharmacies ph
                    on p.pharmacy_id = ph.pharmacy_id
                    WHERE p.prescription_id = $identifier;";
    }else{
        $sql = "SELECT * FROM prescriptions WHERE prescription_id = ".$identifier.";";
     }
     $res = [];
     $prescription = null;
     try{
        $result = $db->query($sql);
        $prescription = $result->fetch_assoc();
        $res['error'] = false;
        $res['message'] = "Query successful";
        $res['data'] = $prescription;
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();
     }finally{
        return $res;
     }
};

$getAllPrescriptions = function($details, $search_flag, $identifier = null) use($db){
    try{
        $search_condition = "";
        switch($search_flag){
            case 0:
                $search_condition = "";
                break; 
            case 1:
                $search_condition = "WHERE p.doctor_id = ".$identifier;
                break; 
            case 2:
                $search_condition = "WHERE p.drug_id = ".$identifier;
                break; 
            case 3:
                $search_condition = "WHERE p.patient_id = ".$identifier;
                break; 
            case 4:
                $search_condition = "WHERE p.pharmacy_id = ".$identifier;
                break;
            default:
                throw new Error("Invalid Flag");
        }
        if($details){
            $sql = "SELECT p.prescription_id, p.symptoms, p.frequency_hours, p.drug_dispensed, p.created_on, 
                    d.drug_id, d.drug_name, d.drug_image, d.price,
                    pa.patient_id, pa.patient_fname, pa.patient_lname, pa.patient_image,
                    dt.doctor_id, dt.doctor_fname, dt.doctor_lname, dt.doctor_image,
                    ph.pharmacy_id, ph.pharmacy_name, ph.pharmacy_image
                    FROM prescriptions p
                    INNER JOIN drugs d
                    on p.drug_id = d.drug_id
                    INNER JOIN patients pa
                    on p.patient_id = pa.patient_id 
                    INNER JOIN doctors dt
                    on p.doctor_id = dt.doctor_id 
                    INNER JOIN pharmacies ph
                    on p.pharmacy_id = ph.pharmacy_id
                    ".$search_condition.";";
        }else{
            $sql = "SELECT * FROM prescriptions ".$search_condition.";";
        }
        $res = [];
        $prescriptions = [];
        if($result = $db->query($sql)){
            while($prescription = $result->fetch_assoc()){
                $prescriptions[$prescription['prescription_id']] = $prescription;
            }
            $res['error'] = false;
            $res['message'] = "Query executed successfully";
            $res['data'] = $prescriptions;
        }else{
            $res['error'] = true;
            $res['message'] = $db->error;
        }
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
};

$updatePrescription = function($id, $symptoms, $drug_id, $patient_id, $doctor_id, $pharmacy_id, $frequency) use($db){
    $sql = "UPDATE prescriptions SET symptoms = '$symptoms', drug_id = $drug_id, patient_id = $patient_id, doctor_id = $doctor_id, pharmacy_id = $pharmacy_id, frequency_hours = $frequency WHERE prescription_id = $id;";
    $res = [];
    try{
        if($db->query($sql)){
            $res['error'] = false;
            $res['message'] = "Prescription Updated";
        }else{
            $res['error'] = true;
            $res['message'] = "Prescription not updated";
        }
    }catch(Exception $error){
        $res['error'] = true;
        $res['message'] = $error->getMessage();
    }finally{
        return $res;
    }

};

$handlePrescription = function($prescription_id) use($db, $dispenseDrug, $getPrescription){
    $response = [];
    try{
    $res = $getPrescription(false, $prescription_id);
    if($res['error']) throw new Exception($res['message']);
    $prescription = $res['data'];
    $res = $dispenseDrug($prescription['drug_id'], $prescription['patient_id']);
    if($res['error']) throw new Exception($res['message']);
    $dispensed = true;
    $sql = "UPDATE prescriptions SET drug_dispensed = $dispensed WHERE prescription_id = $prescription_id";
    if($db->query($sql)){
        $response['error'] = false;
        $response['message'] = "Query handles successfully";
    }else{
        throw new Exception($db->error);
    }
    }catch(Exception $error){
        $response['error'] = true;
        $response['message'] = $error->getMessage();
    }finally{
        return $response;
    }
};

$deletePrescription = function($identifier) use($db){
    $sql = "DELETE FROM prescriptions WHERE prescription_id = $identifier;";
    $res = [];
    try{
        if($db->query($sql) && $db->affected_rows > 0){
            $res['error'] = false;
            $res['message'] = "Prescriptions deleted successful";
        }else{
            $res['error'] = true;
            $res['message'] = "Failed to delete prescriptions";
        }
    }catch(Exception $error){
         $res['error'] = true;
         $res['message'] = $error->getMessage();

     }finally{
        return $res;
     }
}

?>