<form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <img class="profile-preview" id="profile-preview" src=""/>
                <fieldset class="profile-tab" id="fieldset" >
                    <div class="field full-field">
                        <label for="profile-picture">Profile Picture</label>
                        <input type="file" id="profile-picture" name="profile-image" accept="image/*"/>
                    </div>
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
                        <input type="number" id="ssn" name="ssn" placeholder="A10266640"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="years-of-experience">Years of Experience</label>
                        <input type="number" id="years-of-experience" name="years-of-experience" placeholder="24"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="speciality">Speciality</label>
                        <input type="text" id="speciality" name="speciality" placeholder="Optician"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="opening-time">Opening Time</label>
                        <input
                            type="time"
                            id="opening-time"
                            name="opening-time"
                            placeholder="08:00"      
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
                            required
                        />
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
                <button type="submit" name="create" id="create-btn" class="button-primary">Create Doctor</button>
                <a href="./dashboard.php?view=manage-doctors"><button id="cancel-btn" class="button-danger">Cancel</button></a>
                </div>
            </form>