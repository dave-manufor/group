<form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <img class="profile-preview" id="profile-preview" src="<?php echo $pharmacy['pharmacy_image']?>"/>
                <fieldset class="profile-tab" id="fieldset" disabled>
                    <div class="field full-field">
                        <label for="profile-picture">Logo</label>
                        <input type="file" id="profile-picture" name="profile-image" accept="image/*"/>
                    </div>
                    <div class="field full-field">
                        <label for="name">Pharmacy Name</label>
                        <input type="text" id="name" name="name" placeholder="Example Hospital Ltd" autocapitalize="word" value="<?php echo $pharmacy['pharmacy_name']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="street">Street</label>
                        <input type="text" id="street" name="street" placeholder="No. 24, Some Street" autocapitalize="word" value="<?php echo $pharmacy['pharmacy_street']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="Kilimani" autocapitalize="word" value="<?php echo $pharmacy['pharmacy_city']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="Nairobi" autocapitalize="word" value="<?php echo $pharmacy['pharmacy_state']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="zipcode">Zipcode</label>
                        <input type="number" id="zipcode" name="zipcode" placeholder="00100" autocapitalize="word" value="<?php echo $pharmacy['pharmacy_zipcode']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" placeholder="Doe" autocapitalize="word" value="<?php echo $pharmacy['pharmacy_country']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone"  name="phone" placeholder="0111461098" autocapitalize="word" value="<?php echo $pharmacy['pharmacy_mobile']?>" required/>
                    </div>
                    <div class="field full-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="johndoe@example.com"
                            autocapitalize="word" value="<?php echo $pharmacy['pharmacy_email']?>"
                            required
                        />
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
                <a href="./dashboard.php?view=manage-pharmacies&id=<?php echo $pharmacy['pharmacy_id']?>"><button id="cancel-btn" class="button-danger hidden">Cancel</button></a>
                </div>
            </form>
            <div class="button-group" id="edit-group">
                <button id="edit-btn" name="edit" class="edit-btn button-primary">Edit</button>
                <a href="./dashboard.php?view=manage-pharmacies"><button name="edit">Go Back</button></a>
            </div>