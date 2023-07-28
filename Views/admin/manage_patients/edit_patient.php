<form action="" method="post" id="profile-form">
                <!-- FORM TAB 1 -->
                <fieldset class="profile-tab" id="fieldset" disabled>
                    <div class="field half-field">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" placeholder="John" value="<?php echo $patient['patient_fname']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" placeholder="Doe" value="<?php echo $patient['patient_lname']?>" required/>
                    </div>
                    <div class="field full-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="johndoe@example.com"
                            value="<?php echo $patient['patient_email']?>"
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone"  name="phone" placeholder="0111461098" value="<?php echo $patient['patient_mobile']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="ssn">Social Security Number</label>
                        <input type="number" id="ssn" name="ssn" placeholder="A10266640" value="<?php echo $patient['patient_ssn']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" placeholder="24" value="<?php echo $patient['patient_age']?>" required/>
                    </div>
                    <div class="field half-field">
                        <label for="height">Height (cm)</label>
                        <input
                            type="number"
                            id="height"
                            name="height"
                            step="0.01"
                            placeholder="156.24"
                            value="<?php echo $patient['patient_height']?>" 
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="blood-group">Blood Group</label>
                        <select name="blood-group" name="blood-group" id="blood-group"required>
                            <option value="" disabled>Select a blood group</option>
                            <option value="A+" <?php echo ($patient['patient_blood_group'] == "A+") ? "selected='selected'" : ""?>>A+</option>
                            <option value="A-" <?php echo ($patient['patient_blood_group'] == "A-") ? "selected='selected'" : ""?>>A-</option>
                            <option value="B+" <?php echo ($patient['patient_blood_group'] == "B+") ? "selected='selected'" : ""?>>B+</option>
                            <option value="B-" <?php echo ($patient['patient_blood_group'] == "B-") ? "selected='selected'" : ""?>>B-</option>
                            <option value="AB+" <?php echo ($patient['patient_blood_group'] == "AB+") ? "selected='selected'" : ""?>>AB+</option>
                            <option value="AB-" <?php echo ($patient['patient_blood_group'] == "AB-") ? "selected='selected'" : ""?>>AB-</option>
                            <option value="O+" <?php echo ($patient['patient_blood_group'] == "O+") ? "selected='selected'" : ""?>>O+</option>
                            <option value="O-" <?php echo ($patient['patient_blood_group'] == "O-") ? "selected='selected'" : ""?>>O-</option>
                        </select>
                    </div>
                    <div class="field half-field">
                        <label for="weight">Weight (kg)</label>
                        <input
                            type="number"
                            id="weight"
                            name="weight"
                            step="0.01"
                            placeholder="125.38"
                            value="<?php echo $patient['patient_weight']?>" 
                            required
                        />
                    </div>
                    <div class="field full-field">
                        <label for="address">Address</label>
                        <input
                            type="text"
                            id="address"
                            name="address"
                            placeholder="486 College Avenue, Fort Dodge, IA 50501"
                            value="<?php echo $patient['patient_address']?>" 
                            required
                        />
                    </div>
                    <div class="field full-field">
                        <label for="password">Password</label>
                        <div class="pass-field">
                            <input type="password" id="password" name="password" value="<?php echo $patient['patient_password']?>" required/>
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
                <a href="./dashboard.php?view=manage_patients"><button id="cancel-btn" class="button-danger hidden">Cancel</button></a>
                </div>
            </form>
            <div class="button-group" id="edit-group">
                <button id="edit-btn" name="edit" class="button-primary edit-btn">Edit</button>
                <a href="./dashboard.php?view=manage-patients"><button name="edit">Go Back</button></a>
            </div>