<?php
    require_once("./includes/pharmacyController.php");
    $id = $_SESSION['id'];
    $justUpdated = false;
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
        $res = $updatePharmacy(true, $id, $name, $street, $city, $state, $zipcode, $country, $opening_time, $closing_time, $email, $password, $phone, $profile_image);
        if($res['error']){
            echo "<script>alert('Something went wrong!\n".$res['message']."')</script>";
        }else{
           $justUpdated = true;
        }
    }
    $res = $getPharmacy(true, $id);
    $pharmacy = null;
    if($res['error']){
        echo "<script>alert('Something went wrong\n".$res['message']."')</script>";
    }else{
        $pharmacy = $res['data'];
        $_SESSION['profile-url'] = $pharmacy['pharmacy_image'];
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
                <img class="profile-preview" id="profile-preview" src="<?php echo $pharmacy['pharmacy_image']?>"/>
                <fieldset class="profile-tab" id="fieldset" disabled>
                    <div class="field full-field">
                        <label for="profile-picture">Logo</label>
                        <input type="file" id="profile-picture" name="profile-image" accept="image/*"/>
                    </div>
                    <div class="field half-field">
                        <label for="first-name">Pharmacy Name</label>
                        <input type="text" id="name" name="name" autocapitalize="word" placeholder="Example Hospital Ltd." value="<?php echo $pharmacy['pharmacy_name']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="street">Street</label>
                        <input type="text" id="street" name="street" autocapitalize="word" placeholder="2A, Some Street" value="<?php echo $pharmacy['pharmacy_street']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" autocapitalize="word" placeholder="Kilimani" value="<?php echo $pharmacy['pharmacy_city']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" autocapitalize="word" placeholder="Nairobi" value="<?php echo $pharmacy['pharmacy_state']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="zipcode">Zip Code</label>
                        <input type="number" id="zipcode" name="zipcode" placeholder="100001" value="<?php echo $pharmacy['pharmacy_zipcode']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" autocapitalize="word" placeholder="Kenya" value="<?php echo $pharmacy['pharmacy_country']?>" required/>
                    </div>
                    <div class="field full-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="johndoe@example.com"
                            value="<?php echo $pharmacy['pharmacy_email']?>"
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone"  name="phone" placeholder="0111461098" value="<?php echo $pharmacy['pharmacy_mobile']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="opening-time">Opening Time</label>
                        <input
                            type="time"
                            id="opening-time"
                            name="opening-time"
                            placeholder="08:00"
                            value="<?php echo $pharmacy['opening_time']?>" 
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="closing-time">Closing Time</label>
                        <input
                            type="time"
                            id="closing-time"
                            name="closing-time"
                            placeholder="08:00"
                            value="<?php echo $pharmacy['closing_time']?>" 
                            required
                        />
                    </div>
                    <div class="field full-field">
                        <label for="password">Password</label>
                        <div class="pass-field">
                            <input type="password" id="password" name="password" value="<?php echo $pharmacy['pharmacy_password']?>" required/>
                            <img
                            id="password-view-btn"
                            src="./Resources/images/close-eye.png"
                            alt="closed-eye-icon"
                            />
                    </div>
                    </div>
                </fieldset>
                <div class="button-group">
                <button type="submit" name="update" id="update-btn" class="hidden button-primary">Update</button>
                <a href="./dashboard.php?view=account-profile"><button id="cancel-btn" class="button-danger hidden">Cancel</button></a>
                </div>
            </form>
            <div class="button-group" id="edit-group">
                <button id="edit-btn" name="edit" class="edit-btn button-primary">Edit</button>
            </div>

            <?php } ?>