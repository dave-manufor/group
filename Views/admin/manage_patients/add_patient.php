<form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <img class="profile-preview" id="profile-preview" src=""/>
                <fieldset class="profile-tab" id="fieldset" >
                    <div class="field half-field">
                        <label for="first-name">First Name</label>
                        <input type="text" id="first-name" name="first-name" placeholder="John"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="last-name">Last Name</label>
                        <input type="text" id="last-name" name="last-name" placeholder="Doe"  required/>
                    </div>
                    <div class="field full-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="johndoe@example.com"
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone"  name="phone" placeholder="0111461098"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="ssn">Social Security Number</label>
                        <input type="number" id="ssn" name="ssn" placeholder="A10266640" required/>
                    </div>
                    <div class="field half-field">
                        <label for="age">Age</label>
                        <input type="number" id="age" name="age" placeholder="24"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="height">Height (cm)</label>
                        <input
                            type="number"
                            id="height"
                            name="height"
                            step="0.01"
                            placeholder="156.24"
                            required
                        />
                    </div>
                    <div class="field half-field">
                        <label for="blood-group">Blood Group</label>
                        <select name="blood-group" name="blood-group" id="blood-group"required>
                            <option value="" disabled>Select a blood group</option>
                            <option value="A+">A+</option>
                            <option value="A-">A-</option>
                            <option value="B+">B+</option>
                            <option value="B-">B-</option>
                            <option value="AB+">AB+</option>
                            <option value="AB-">AB-</option>
                            <option value="O+">O+</option>
                            <option value="O-">O-</option>
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
                            required
                        />
                    </div>
                    <div class="field full-field">
                        <label for="profile-picture">Profile Picture</label>
                        <input type="file" id="profile-picture" name="profile-image" accept="image/*"/>
                    </div>
                    <div class="field full-field">
                        <label for="password">Password</label>
                        <div class="pass-field">
                            <input type="password" id="password" name="password" required/>
                            <img
                            id="password-view-btn"
                            src="./Resources/images/close-eye.png"
                            alt="closed-eye-icon"
                            />
                    </div>
                    </div>
                </fieldset>
                <div class="button-group">
                <button type="submit" name="create" id="create-btn" class="button-primary">Create Patient</button>
                <a href="./dashboard.php?view=manage-patients"><button id="cancel-btn" class="button-danger">Cancel</button></a>
                </div>
            </form>