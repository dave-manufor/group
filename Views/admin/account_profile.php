<?php
    require_once("./includes/adminController.php");
    $id = $_SESSION['id'];
    $justUpdated = false;
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
        $res = $updateAdmin(true, $id, $fname, $lname, $ssn, $email, $password, $phone,$profile_image);
        if($res['error']){
            echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
        }else{
           $justUpdated = true;
        }
    }
    $res = $getAdmin(true, $id);
    $admin = null;
    if($res['error']){
        echo "<script>alert('Something went wrong\n".$res['message']."')</script>";
    }else{
        $admin = $res['data'];
        $_SESSION['profile-url'] = $admin['admin_image'];
?>

        <div class="title-div">
          <h2 class="title">
            Account Profile <span><?php echo ($justUpdated) ? "(successfully updated)" : ""?></span>
            <hr class="title-line" />
          </h2>
        </div>
        <div class="error-message closed" id="error-container">
        </div>
            <!-- REVERT -->
            <form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <img class="profile-preview" id="profile-preview" src="<?php echo $admin['admin_image']?>"/>
                <fieldset class="profile-tab" id="fieldset" disabled>
                    <div class="field half-field">
                        <label for="profile-picture">Profile Picture / Logo</label>
                        <input type="file" id="profile-picture" name="profile-image" accept="image/*"/>
                    </div>
                    <div class="field half-field">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" placeholder="John" value="<?php echo $admin['admin_fname']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" placeholder="Doe" value="<?php echo $admin['admin_lname']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="johndoe@example.com"
                            value="<?php echo $admin['admin_email']?>"
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone"  name="phone" placeholder="0111461098" value="<?php echo $admin['admin_mobile']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="ssn">Social Security Number</label>
                        <input type="number" id="ssn" name="ssn" placeholder="A10266640" value="<?php echo $admin['admin_ssn']?>" required/>
                    </div>
                    <div class="field full-field">
                        <label for="password">Password</label>
                        <div class="pass-field">
                            <input type="password" id="password" name="password" value="<?php echo $admin['admin_password']?>" required/>
                            <img
                            id="password-view-btn"
                            src="./Resources/images/close-eye.png"
                            alt="closed-eye-icon"
                            />
                    </div>
                    </div>
                </fieldset>
                <div class="button-group">
                <button type="submit" name="update" id="update-btn" class="button-primary hidden">Update</button>
                <a href="./dashboard.php?view=account-profile"><button id="cancel-btn" class="danger-btn hidden">Cancel</button></a>
                </div>
            </form>
            <div class="button-group" id="edit-group">
                <button id="edit-btn" name="edit" class="button-primary edit-btn">Edit</button>
            </div>

            <?php } ?>