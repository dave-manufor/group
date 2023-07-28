<?php
    require_once("./includes/adminController.php");
    $admin_id = "";
    $admin = null;
    $admins = null;
    $update = "";
    $error = "";
    if(isset($_GET['id'])){
        $admin_id = $_GET['id'];
        if(isset($_POST['update'])){
          $fname = $_POST['first-name'];
          $lname = $_POST['last-name'];
          $ssn = $_POST['ssn'];
          $email = $_POST['email'];
          $password = $_POST['password'];
          $phone = $_POST['phone'];
          if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
              $profile_image = $_FILES['profile-image'];
            }else{
              $profile_image = null;
            }
          $res = $updateAdmin(true, $admin_id, $fname, $lname, $ssn, $email, $password, $phone, $profile_image);
          if($res['error']){
              echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
          }else{
            $justUpdated = true;
          }
        }
        $res = $getAdmin(true, $admin_id);
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(!$res['data']){
            $error = "No admin found with ID of '".$admin_id."'";
        }else{
            $admin = $res['data'];
        }
    }else{
        if(isset($_GET['del'])){
            $admin_id = $_GET['del'];
            if($admin_id == $_SESSION['id']){
                $error = "You do not have permission to delete your own account";
            }else{
                $res = $deleteAdmin(true, $admin_id);
                if($res['error']){
                    echo "<script>alert(".$res['message'].")</script>";
                }else{
                    $update = "(Admin has been deleted)";
                }
            }
        }
        if(isset($_POST['create'])){
            $fname = $_POST['first-name'];
            $lname = $_POST['last-name'];
            $ssn = $_POST['ssn'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $phone = $_POST['phone'];
            if(isset($_FILES['profile-image']) && $_FILES['profile-image']['name']){
                $profile_image = $_FILES['profile-image'];
                }else{
                $profile_image = null;
                }
            $res = $addAdmin($fname, $lname, $ssn, $email, $password, $phone,$profile_image);
            if($res['error']){
                echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
            }else{
                $justUpdated = true;
                echo "<script>alert('Admin has been added')</script>";
                echo "<script>window.location = './dashboard.php?view=manage-admins'</script>";
            }
        }
        $res = $getAllAdmins();
        if($res['error']){
            $error = "Something went wrong<br>".$res['message'];
        }elseif(count($res['data']) === 0){
            $error = "No admins found";
        }else{
            $admins = $res['data'];
        }
    }
?>
<div class="title-div">
    <h2 class="title">
        Administrators Manager <span><?php echo $update ?></span>
        <hr class="form-title-line" />
    </h2>
</div>
<div class="error-message <?php if(!$error) echo "closed"?>" id="error-container">
    <?php echo $error ?>    
</div>
<div class="content">
    <?php if(isset($_GET['id']) && $admin){
            include("./Views/admin/manage_admins/edit_admin.php");
          }elseif(isset($_GET['action']) && $_GET['action'] == 'create'){
            include("./Views/admin/manage_admins/add_admin.php");
          }else{
            include("./Views/admin/manage_admins/default.php");
          } ?>
</div>




