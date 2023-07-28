<form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <img class="profile-preview" id="profile-preview" src="<?php echo $doctor['doctor_image']?>"/>
                <fieldset class="profile-tab" id="fieldset" disabled>
                    <div class="field full-field">
                        <label for="profile-picture">Profile Picture</label>
                        <input type="file" id="profile-picture" name="profile-image" accept="image/*"/>
                    </div>
                    <div class="field half-field">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" placeholder="John" value="<?php echo $doctor['doctor_fname']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" placeholder="Doe" value="<?php echo $doctor['doctor_lname']?>" required/>
                    </div>
                    <div class="field full-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="johndoe@example.com"
                            value="<?php echo $doctor['doctor_email']?>"
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone"  name="phone" placeholder="0111461098" value="<?php echo $doctor['doctor_mobile']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="ssn">Social Security Number</label>
                        <input type="number" id="ssn" name="ssn" placeholder="A10266640" value="<?php echo $doctor['doctor_ssn']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="years-of-experience">Years of Experience</label>
                        <input type="number" id="years-of-experience" name="years-of-experience" placeholder="24" value="<?php echo $doctor['years_of_experience']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="speciality">Speciality</label>
                        <input type="text" id="speciality" name="speciality" placeholder="Optician" value="<?php echo $doctor['speciality']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="opening-time">Opening Time</label>
                        <input
                            type="time"
                            id="opening-time"
                            name="opening-time"
                            placeholder="08:00"
                            value="<?php echo $doctor['opening_time']?>" 
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
                            value="<?php echo $doctor['closing_time']?>" 
                            required
                        />
                    </div>
                    <div class="field full-field">
                        <label for="password">Password</label>
                        <div class="pass-field">
                            <input type="password" id="password" name="password" value="<?php echo $doctor['doctor_password']?>" required/>
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
                <a href="./dashboard.php?view=manage-doctors"><button name="edit">Go Back</button></a>
            </div>