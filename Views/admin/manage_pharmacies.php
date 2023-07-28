<?php
    require_once("./includes/pharmacyController.php");
    $pharmacy_id = "";
    $pharmacy = null;
    $pharmacies = null;
    $update = "";
    $error = "";
    if(isset($_GET['id'])){
        $pharmacy_id = $_GET['id'];
        if(isset($_POST['update'])){
            $name = $_POST['name'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipcode = $_POST['zipcode'];
            $country = $_POST['country'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $opening_time = $_POST['opening-time'];
            $closing_time = $_POST['closing-time'];
            if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
                $profile_image = $_FILES['profile-image'];
              }else{
                $profile_image = null;
              }
            $res = $updatePharmacy(true, $pharmacy_id, $name, $street, $city, $state, $zipcode, $country, $opening_time, $closing_time, $email, $password, $phone, $profile_image);
            if($res['error']){
                echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
            }else{
               $justUpdated = true;
            }
        }
        $res = $getPharmacy(true, $pharmacy_id);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(!$res['data']){
            $error = "No pharmacy found with ID of '".$pharmacy_id."'";
        }else{
            $pharmacy = $res['data'];
        }
    }else{
        if(isset($_GET['del'])){
            $pharmacy_id = $_GET['del'];
            $res = $deletePharmacy(true, $pharmacy_id);
            if($res['error']){
                echo "<script>alert(".$res['message'].")</script>";
            }else{
                $update = "(Pharmacy has been deleted)";
            }
        }
        if(isset($_POST['create'])){
            $name = $_POST['name'];
            $street = $_POST['street'];
            $city = $_POST['city'];
            $state = $_POST['state'];
            $zipcode = $_POST['zipcode'];
            $country = $_POST['country'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            $opening_time = $_POST['opening-time'];
            $closing_time = $_POST['closing-time'];
            if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
                $profile_image = $_FILES['profile-image'];
              }else{
                $profile_image = null;
              }
            $res = $addPharmacy($name, $street, $city, $state, $zipcode, $country, $opening_time, $closing_time, $email, $password, $phone, $profile_image);
            if($res['error']){
                echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
            }else{
               $justUpdated = true;
               echo "<script>alert('Pharmacy has been added')</script>";
                echo "<script>window.location = './dashboard.php?view=manage-pharmacies'</script>";
            }
        }
        $res = $getAllPharmacies();
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(count($res['data']) === 0){
            $error = "No pharmacies found";
        }else{
            $pharmacies = $res['data'];
        }
    }
?>
<div class="title-div">
    <h2 class="title">
        Pharmacies Manager <span><?php echo $update ?></span>
        <hr class="form-title-line" />
    </h2>
</div>
<div class="error-message <?php if(!$error) echo "closed"?> id="error-container">
    <?php echo $error ?>    
</div>
<div class="content">
    <?php if(isset($_GET['id']) && $pharmacy){
            include("./Views/admin/manage_pharmacies/edit_pharmacy.php");
          }elseif(isset($_GET['action']) && $_GET['action'] == 'create'){
            include("./Views/admin/manage_pharmacies/add_pharmacy.php");
          }else{
            include("./Views/admin/manage_pharmacies/default.php");
          } ?>
</div>




