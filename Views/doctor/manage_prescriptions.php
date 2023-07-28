<?php
    require_once("./includes/prescriptionController.php");
    $prescription_id = "";
    $prescription = null;
    $prescriptions = null;
    $update = "";
    $error = "";
    if(isset($_GET['id'])){
        $prescription_id = $_GET['id'];
        if(isset($_POST['update'])){
          $symptoms = $_POST['symptoms'];
          $drug_id = $_POST['drug_id'];
          $patient_id = $_POST['patient_id'];
          $doctor_id = $_SESSION['id'];
          $pharmacy_id = $_POST['pharmacy_id'];
          $frequency = $_POST['frequency'];
          $res = $updatePrescription(true, $prescription_id, $symptoms, $drug_id, $patient_id, $doctor_id, $pharmacy_id, $frequency );
          if($res['error']){
              echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
          }else{
            $justUpdated = true;
          }
        }
        $res = $getPrescription(true, $prescription_id);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(!$res['data']){
            $error = "No prescription found with ID of '".$prescription_id."'";
        }else{
            $prescription = $res['data'];
        }
    }else{
        if(isset($_GET['del'])){
            $prescription_id = $_GET['del'];
                $res = $deletePrescription($prescription_id);
                if($res['error']){
                    echo "<script>alert(".$res['message'].")</script>";
                }else{
                    $update = "(Prescription has been deleted)";
                }
        }
        if(isset($_POST['create'])){
            $symptoms = $_POST['symptoms'];
          $drug_id = $_POST['drug_id'];
          $patient_id = $_POST['patient_id'];
          $doctor_id = $_SESSION['id'];
          $pharmacy_id = $_POST['pharmacy_id'];
          $frequency = $_POST['frequency'];
          $res = $addPrescription($symptoms, $drug_id, $patient_id, $doctor_id, $pharmacy_id, $frequency );
          if($res['error']){
              echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
          }else{
            $justUpdated = true;
                $justUpdated = true;
                echo "<script>alert('Prescription has been added')</script>";
                echo "<script>window.location = './dashboard.php?view=manage-prescriptions'</script>";
            }
        }
        $res = $getAllPrescriptions(true, 0);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(count($res['data']) === 0){
            $error = "No prescriptions found";
        }else{
            $prescriptions = $res['data'];
        }
    }
?>
<div class="title-div">
    <h2 class="title">
        Prescriptions Manager <span><?php echo $update ?></span>
        <hr class="form-title-line" />
    </h2>
</div>
<div class="error-message <?php if(!$error) echo "closed"?>" id="error-container">
    <?php echo $error ?>    
</div>
<div class="content">
    <?php if(isset($_GET['id']) && $prescription){
            include("./Views/doctor/manage_prescriptions/edit_prescription.php");
          }elseif(isset($_GET['action']) && $_GET['action'] == 'create'){
            include("./Views/doctor/manage_prescriptions/add_prescription.php");
          }else{
            include("./Views/doctor/manage_prescriptions/default.php");
          } ?>
</div>




