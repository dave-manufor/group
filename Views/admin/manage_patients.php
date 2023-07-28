<?php
    require_once("./includes/patientController.php");
    $patient_id = "";
    $patient = null;
    $patients = null;
    $update = "";
    $error = "";
    if(isset($_GET['id'])){
        $patient_id = $_GET['id'];
        if(isset($_POST['update'])){
          $fname = $_POST['first-name'];
          $lname = $_POST['last-name'];
          $ssn = $_POST['ssn'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $phone = $_POST['phone'];
          $address = $_POST['address'];
          $weight = $_POST['weight'];
          $height = $_POST['height'];
          $age = $_POST['age'];
          $blood_group = $_POST['blood-group'];
          if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
              $profile_image = $_FILES['profile-image'];
            }else{
              $profile_image = null;
            }
          $res = $updatePatient(true, $patient_id, $fname, $lname, $ssn, $email, $password, $phone, $address, $weight, $height, $age, $blood_group,$profile_image);
          if($res['error']){
              echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
          }else{
            $justUpdated = true;
          }
        }
        $res = $getPatient(true, $patient_id);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(!$res['data']){
            $error = "No patient found with ID of '".$patient_id."'";
        }else{
            $patient = $res['data'];
        }
    }else{
        if(isset($_GET['del'])){
            $patient_id = $_GET['del'];
            $res = $deletePatient(true, $patient_id);
            if($res['error']){
                echo "<script>alert(".$res['message'].")</script>";
            }else{
                $update = "(Patient has been deleted)";
            }
        }
        if(isset($_POST['create'])){
            $fname = $_POST['first-name'];
            $lname = $_POST['last-name'];
            $ssn = $_POST['ssn'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $address = $_POST['address'];
            $weight = $_POST['weight'];
            $height = $_POST['height'];
            $age = $_POST['age'];
            $blood_group = $_POST['blood-group'];
            if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
                $profile_image = $_FILES['profile-image'];
                }else{
                $profile_image = null;
                }
            $res = $addPatient($fname, $lname, $ssn, $email, $password, $phone, $address, $weight, $height, $age, $blood_group,$profile_image);
            if($res['error']){
                echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
            }else{
                $justUpdated = true;
                echo "<script>alert('Patient has been added')</script>";
                echo "<script>window.location = './dashboard.php?view=manage-patients'</script>";
            }
        }
        $res = $getAllPatients();
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(count($res['data']) === 0){
            $error = "No patients found";
        }else{
            $patients = $res['data'];
        }
    }
?>
<div class="title-div">
    <h2 class="title">
        Patients Manager <span><?php echo $update ?></span>
        <hr class="form-title-line" />
    </h2>
</div>
<div class="error-message <?php if(!$error) echo "closed"?> id="error-container">
    <?php echo $error ?>    
</div>
<div class="content">
    <?php if(isset($_GET['id']) && $patient){
            include("./Views/admin/manage_patients/edit_patient.php");
          }elseif(isset($_GET['action']) && $_GET['action'] == 'create'){
            include("./Views/admin/manage_patients/add_patient.php");
          }else{
            include("./Views/admin/manage_patients/default.php");
          } ?>
</div>




