<?php
    require_once("./includes/doctorController.php");
    $doctor_id = "";
    $doctor = null;
    $doctors = null;
    $update = "";
    $error = "";
    if(isset($_GET['id'])){
        $doctor_id = $_GET['id'];
        if(isset($_POST['update'])){
            $fname = $_POST['first-name'];
            $lname = $_POST['last-name'];
            $ssn = $_POST['ssn'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $speciality = $_POST['speciality'];
            $years_of_experience = $_POST['years-of-experience'];
            $opening_time = $_POST['opening-time'];
            $closing_time = $_POST['closing-time'];
            if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
                $profile_image = $_FILES['profile-image'];
              }else{
                $profile_image = null;
              }
            $res = $updateDoctor(true, $doctor_id, $fname, $lname, $ssn, $email, $password, $phone, $speciality, $years_of_experience, $opening_time, $closing_time,$profile_image);
            if($res['error']){
                echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
            }else{
               $justUpdated = true;
            }
        }
        $res = $getDoctor(true, $doctor_id);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(!$res['data']){
            $error = "No doctor found with ID of '".$doctor_id."'";
        }else{
            $doctor = $res['data'];
        }
    }else{
        if(isset($_GET['del'])){
            $doctor_id = $_GET['del'];
            $res = $deleteDoctor(true, $doctor_id);
            if($res['error']){
                echo "<script>alert(".$res['message'].")</script>";
            }else{
                $update = "(Doctor has been deleted)";
            }
        }
        if(isset($_POST['create'])){
            $fname = $_POST['first-name'];
            $lname = $_POST['last-name'];
            $ssn = $_POST['ssn'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $speciality = $_POST['speciality'];
            $years_of_experience = $_POST['years-of-experience'];
            $opening_time = $_POST['opening-time'];
            $closing_time = $_POST['closing-time'];
            if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
                $profile_image = $_FILES['profile-image'];
              }else{
                $profile_image = null;
              }
            $res = $addDoctor($fname, $lname, $ssn, $email, $password, $phone, $speciality, $years_of_experience, $opening_time, $closing_time,$profile_image);
            if($res['error']){
                echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
            }else{
               $justUpdated = true;
               echo "<script>alert('Doctor has been added')</script>";
                echo "<script>window.location = './dashboard.php?view=manage-doctors'</script>";
            }
        }
        $res = $getAllDoctors();
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(count($res['data']) === 0){
            $error = "No doctors found";
        }else{
            $doctors = $res['data'];
        }
    }
?>
<div class="title-div">
    <h2 class="title">
        Doctors Manager <span><?php echo $update ?></span>
        <hr class="form-title-line" />
    </h2>
</div>
<div class="error-message <?php if(!$error) echo "closed"?> id="error-container">
    <?php echo $error ?>    
</div>
<div class="content">
    <?php if(isset($_GET['id']) && $doctor){
            include("./Views/admin/manage_doctors/edit_doctor.php");
          }elseif(isset($_GET['action']) && $_GET['action'] == 'create'){
            include("./Views/admin/manage_doctors/add_doctor.php");
          }else{
            include("./Views/admin/manage_doctors/default.php");
          } ?>
</div>




