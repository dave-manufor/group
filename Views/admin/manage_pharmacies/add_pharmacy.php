<form action="" method="post" id="profile-form" enctype="multipart/form-data">
                <!-- FORM TAB 1 -->
                <img class="profile-preview" id="profile-preview" />
                <fieldset class="profile-tab" id="fieldset">
                    <div class="field full-field">
                        <label for="profile-picture">Logo</label>
                        <input type="file" id="profile-picture" name="profile-image" accept="image/*"/>
                    </div>
                    <div class="field full-field">
                        <label for="name">Pharmacy Name</label>
                        <input type="text" id="name" name="name" placeholder="Example Hospital Ltd" autocapitalize="word"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="street">Street</label>
                        <input type="text" id="street" name="street" placeholder="No. 24, Some Street" autocapitalize="word"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" placeholder="Kilimani" autocapitalize="word"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="state">State</label>
                        <input type="text" id="state" name="state" placeholder="Nairobi" autocapitalize="word"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="zipcode">Zipcode</label>
                        <input type="number" id="zipcode" name="zipcode" placeholder="00100" autocapitalize="word"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="country">Country</label>
                        <input type="text" id="country" name="country" placeholder="Doe" autocapitalize="word"  required/>
                    </div>
                    <div class="field half-field">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone"  name="phone" placeholder="0111461098" autocapitalize="word"  required/>
                    </div>
                    <div class="field full-field">
                        <label for="email">Email</label>
                        <input
                            type="email"
                            id="email"
                            name="email"
                            placeholder="johndoe@example.com"
                            autocapitalize="word" 
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
                            <input type="password" id="password" name="password"  required/>
                            <img
                            id="password-view-btn"
                            src="./Resources/images/close-eye.png"
                            alt="closed-eye-icon"
                            />
                    </div>
                    </div>
                </fieldset>
                <div class="button-group">
                <button type="submit" name="create" id="create-btn" class="button-primary">Create Pharmacy</button>
                <a href="./dashboard.php?view=manage-pharmacies"><button id="cancel-btn" class="button-danger">Cancel</button></a>
                </div>
            </form>